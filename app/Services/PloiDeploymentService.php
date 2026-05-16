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

    public function __construct()
    {
        // Grabs your master keys from the .env file
        $this->apiToken = env('PLOI_API_TOKEN');
        $this->serverId = env('PLOI_SERVER_ID');
    }

    public function createTenantSite($contractor)
    {
        // Safety check
        if (!$this->apiToken || !$this->serverId) {
            throw new Exception('Ploi API keys are missing from the Command Center .env file.');
        }

        // 1. Generate the unique subdomain (e.g., jacks-lawns.contractorspecialties.com)
        $slug = Str::slug($contractor->business_name);
        $domain = $slug . '.contractorspecialties.com';

        // 2. Ping Ploi to create the physical site on the server
        $response = Http::withToken($this->apiToken)
            ->acceptJson()
            ->post("{$this->baseUrl}/servers/{$this->serverId}/sites", [
                'root_domain' => $domain,
            ]);

        // 3. Catch any errors if Ploi's bouncer rejects the request
        if ($response->failed()) {
            throw new Exception('Ploi API Error: ' . $response->body());
        }

        // 4. Return the new domain so the Command Center database can save it!
        return $domain;
    }
}