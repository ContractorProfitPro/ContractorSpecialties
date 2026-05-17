<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        $this->gitProvider = env('PLOI_GIT_PROVIDER') ?: 'github';
        $this->templateRepo = env('PLOI_TEMPLATE_REPO') ?: 'ContractorProfitPro/contractor-blueprint';
    }

    public function createTenantSite($contractor)
    {
        if (!$this->apiToken || !$this->serverId) {
            throw new Exception('Ploi API keys are missing from the Command Center .env file.');
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

        // 2. Install the Git Repository FIRST (Into a perfectly clean, untouched folder)
        $repoResponse = Http::withToken($this->apiToken)
            ->acceptJson()
            ->asJson() 
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/repository", [
                'provider' => $this->gitProvider,
                'name' => $this->templateRepo, 
                'repository' => $this->templateRepo, 
                'branch' => 'main',
            ]);

        if ($repoResponse->failed()) {
             Log::error('Git Install Failed for ' . $domain . ': ' . $repoResponse->body());
        }

        // --- THE GHOST WORKER ---
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

        dispatch(function () use ($apiToken, $baseUrl, $serverId, $siteId, $envContent, $domain) {
            
            // Wait 12 seconds for Git to completely finish unpacking
            sleep(12);

            // 3. Inject Environment Variables
            Http::withToken($apiToken)
                ->acceptJson()
                ->patch("{$baseUrl}/servers/{$serverId}/sites/{$siteId}/env", [
                    'content' => $envContent
                ]);

            // 4. Delete the generic index.html NOW that Git is done
            Http::withToken($apiToken)
                ->acceptJson()
                ->post("{$baseUrl}/servers/{$serverId}/sites/{$siteId}/commands", [
                    'command' => 'rm index.html', 
                    'user' => 'ploi'
                ]);

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