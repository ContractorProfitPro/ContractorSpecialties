<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class PloiDeploymentService
{
    protected $apiToken;
    protected $serverId;

    public function __construct()
    {
        // Grabs your keys from the .env file
        $this->apiToken = env('PLOI_API_TOKEN');
        $this->serverId = env('PLOI_SERVER_ID');
    }

    public function createTenantSite($contractor)
    {
        // This is where the magic API payload will go once we clear the test
        return 'testing.contractorspecialties.com';
    }
}