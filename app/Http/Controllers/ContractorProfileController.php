<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PloiDeploymentService; // 1. Import our new factory engine

class ContractorProfileController extends Controller
{
    public function show($slug)
    {
        // 1. Fetch the specific contractor by their URL slug
        $profile = DB::table('sc_contractor_profiles')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->first();

        // 2. If the slug doesn't exist, throw a standard 404
        if (!$profile) {
            abort(404, 'Contractor profile not found.');
        }

        // 3. Format the data for the View
        // Decode the services JSON array (or provide a fallback if empty)
        $servicesOffered = $profile->services_offered 
            ? json_decode($profile->services_offered, true) 
            : ['Landscape Design', 'Lawn Maintenance', 'Hardscaping'];

        // Clean up the phone number for the clickable link
        $phoneFormatted = $profile->phone; 
        
        // 4. Hand the data to our dynamic Blade engine
        return view('directory.profile', [
            'business_name' => $profile->business_name,
            'primary_trade' => $profile->primary_trade,
            'specialty' => $profile->specialty,
            'phone' => $profile->phone,
            'phone_formatted' => $phoneFormatted,
            'street_address' => $profile->street_address,
            'city' => $profile->city,
            'state' => $profile->state,
            'zip' => $profile->zip,
            'year_founded' => $profile->year_founded,
            'is_licensed' => $profile->is_licensed,
            'license_number' => $profile->license_number,
            'is_insured' => $profile->is_insured,
            'warranty_offered' => $profile->warranty_offered,
            'service_radius_miles' => $profile->service_radius_miles,
            'services_offered' => $servicesOffered,
            
            // This is the magic payload that triggers the Mid-Century design
            'brand_settings' => $profile->brand_settings, 
        ]);
    }

    // --- NEW DEPLOYMENT METHOD --- //
    
    public function deploy($id, PloiDeploymentService $deploymentService)
    {
        // 1. Fetch the specific contractor by their ID
        $profile = DB::table('sc_contractor_profiles')
            ->where('id', $id)
            ->first();

        if (!$profile) {
            return back()->with('error', 'Contractor profile not found.');
        }

        // Prevent accidental double-deployments
        if ($profile->domain) {
            return back()->with('error', 'This contractor already has a live site at ' . $profile->domain);
        }

        try {
            // 2. Fire up the Factory! 
            // We pass the profile to the service, and it hands us back the live URL.
            $newDomain = $deploymentService->createTenantSite($profile);

            // 3. Save the results back to the database
            DB::table('sc_contractor_profiles')
                ->where('id', $id)
                ->update([
                    'has_standalone_site' => 1,
                    'domain' => $newDomain,
                    'updated_at' => now(),
                ]);

            // 4. Return to the UI with a success message
            return back()->with('success', "Deployment complete! Site is now live at https://{$newDomain}");

        } catch (\Exception $e) {
            // If the factory hits a snag (like the domain is already taken), display it cleanly
            return back()->with('error', 'Deployment failed: ' . $e->getMessage());
        }
    }
}