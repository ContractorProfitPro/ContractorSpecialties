<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Exception;

class PloiDeploymentService
{
    protected $apiToken;
    protected $serverId;
    protected $baseUrl = 'https://ploi.io/api';
    protected $gitProvider;
    protected $templateRepo;

    public function __construct()
    {
        $this->apiToken = env('PLOI_API_TOKEN');
        $this->serverId = env('PLOI_SERVER_ID');
        $this->gitProvider = env('PLOI_GIT_PROVIDER', 'github');
        $this->templateRepo = env('PLOI_TEMPLATE_REPO');
    }

    public function createTenantSite($contractor)
    {
        if (!$this->apiToken || !$this->serverId) {
            throw new Exception('Ploi API keys are missing from the Command Center .env file.');
        }

        if (!$this->templateRepo) {
            throw new Exception('Template repository is not defined in the .env file.');
        }

        $slug = Str::slug($contractor->business_name);
        $domain = $slug . '.contractorspecialties.com';

        // 1. Create the Physical Site
        $response = Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites", [
                'root_domain' => $domain,
                'web_directory' => '/', 
                'project_root' => '/',
            ]);

        if ($response->failed()) {
            throw new Exception('Ploi Site Creation Error: ' . $response->body());
        }

        $siteId = $response->json('data.id');

        // 2. Delete Ploi's default index.html BEFORE Git tries to pull
        Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/commands", [
                'command' => 'rm index.html', 
                'user' => 'ploi'
            ]);

        // 3. Install the Git Repository
        $repoResponse = Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/repository", [
                'provider' => $this->gitProvider,
                'name' => $this->templateRepo, 
                'branch' => 'main',
            ]);

        if ($repoResponse->failed()) {
             \Log::error('Git Install Failed for ' . $domain . ': ' . $repoResponse->body());
        }

        // --- THE MAGIC HANDOFF ---
        // We package the slow tasks into a background closure.
        $apiToken = $this->apiToken;
        $baseUrl = $this->baseUrl;
        $serverId = $this->serverId;
        
        $envContent = implode("\n", [
            'CONTRACTOR_NAME="' . addslashes($contractor->business_name) . '"',
            'CONTRACTOR_PHONE="' . addslashes($contractor->phone ?? '') . '"',
            'CONTRACTOR_EMAIL="' . addslashes($contractor->email ?? '') . '"',
            'CONTRACTOR_CITY="' . addslashes($contractor->city ?? '') . '"',
            'CONTRACTOR_STATE="' . addslashes($contractor->state ?? '') . '"',
        ]);

        // This runs AFTER your browser loads the success page, completely preventing a 502 timeout.
        dispatch(function () use ($apiToken, $baseUrl, $serverId, $siteId, $envContent, $domain) {
            
            // Give Git a massive 12-second window to completely unpack without holding up the UI.
            sleep(12);

            // 4. Inject Environment Variables
            $envResponse = Http::withToken($apiToken)
                ->acceptJson()
                ->patch("{$baseUrl}/servers/{$serverId}/sites/{$siteId}/env", [
                    'content' => $envContent
                ]);

            if ($envResponse->failed()) {
                 \Log::error('Env Injection Failed for ' . $domain . ': ' . $envResponse->body());
            }

            // 5. Request the SSL
            Http::withToken($apiToken)
                ->acceptJson()
                ->post("{$baseUrl}/servers/{$serverId}/sites/{$siteId}/certificates", [
                    'type' => 'letsencrypt'
                ]);

        })->afterResponse();

        return $domain;
    }
}