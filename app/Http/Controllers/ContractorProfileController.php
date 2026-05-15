<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}