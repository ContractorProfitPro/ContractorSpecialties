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

        // 2. Install the Git Repository
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

        // 3-second pause for Git to unpack
        sleep(3);

        // 3. Inject Environment Variables
        $envContent = implode("\n", [
            'CONTRACTOR_NAME="' . addslashes($contractor->business_name) . '"',
            'CONTRACTOR_PHONE="' . addslashes($contractor->phone ?? '') . '"',
            'CONTRACTOR_EMAIL="' . addslashes($contractor->email ?? '') . '"',
            'CONTRACTOR_CITY="' . addslashes($contractor->city ?? '') . '"',
            'CONTRACTOR_STATE="' . addslashes($contractor->state ?? '') . '"',
        ]);

        $envResponse = Http::withToken($this->apiToken)
            ->acceptJson()
            ->patch("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/env", [
                'content' => $envContent
            ]);

        if ($envResponse->failed()) {
             \Log::error('Env Injection Failed for ' . $domain . ': ' . $envResponse->body());
        }

        // 4. Delete Ploi's default index.html file from the ROOT directory
        Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/commands", [
                'command' => 'rm index.html', 
                'user' => 'ploi'
            ]);

        // 5. Request the SSL (COMMENTED OUT TO PREVENT 502 TIMEOUT)
        /*
        Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/certificates", [
                'type' => 'letsencrypt'
            ]);
        */

        return $domain;
    }
}