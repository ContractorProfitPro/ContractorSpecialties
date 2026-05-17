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
        // Grabs your master keys from the .env file
        $this->apiToken = env('PLOI_API_TOKEN');
        $this->serverId = env('PLOI_SERVER_ID');
        $this->gitProvider = env('PLOI_GIT_PROVIDER', 'github');
        $this->templateRepo = env('PLOI_TEMPLATE_REPO');
    }

    public function createTenantSite($contractor)
    {
        // Safety check
        if (!$this->apiToken || !$this->serverId) {
            throw new Exception('Ploi API keys are missing from the Command Center .env file.');
        }

        if (!$this->templateRepo) {
            throw new Exception('Template repository is not defined in the .env file.');
        }

        // 1. Generate the unique subdomain
        $slug = Str::slug($contractor->business_name);
        $domain = $slug . '.contractorspecialties.com';

        // 2. Ping Ploi to create the physical site on the server
        $response = Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites", [
                'root_domain' => $domain,
                'web_directory' => '/public',
                'project_root' => '/',
            ]);

        // Catch any errors if Ploi's bouncer rejects the request
        if ($response->failed()) {
            throw new Exception('Ploi Site Creation Error: ' . $response->body());
        }

        // 3. Catch the specific Site ID that Ploi just created
        $siteId = $response->json('data.id');

        // 4. Request the Let's Encrypt SSL
        Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/certificates", [
                'type' => 'letsencrypt'
            ]);

        // 5. Install the Git Repository into the new site
        $repoResponse = Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites/{$siteId}/repository", [
                'provider' => $this->gitProvider,
                'repository' => $this->templateRepo,
                'branch' => 'main',
            ]);

        if ($repoResponse->failed()) {
             \Log::error('Git Install Failed for ' . $domain . ': ' . $repoResponse->body());
        }

        // 6. Inject the specific Contractor's data into the new site's .env file
        // We use addslashes to ensure any weird characters in the business name don't break the .env formatting
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

        // 7. Return the new domain so the Command Center database can save it
        return $domain;
    }
}