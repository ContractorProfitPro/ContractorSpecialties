<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactoryController extends Controller
{
    public function index()
    {
        // Fetch all contractors from our flat architecture
        $contractors = DB::table('sc_contractor_profiles')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($contractor) {
                // Calculate the Revenue Tier on the fly
                if ($contractor->has_standalone_site) {
                    $contractor->tier = 'Standalone';
                    $contractor->tier_color = 'bg-green-100 text-green-800 border-green-200';
                } elseif (!empty($contractor->brand_settings)) {
                    $contractor->tier = 'Premium';
                    $contractor->tier_color = 'bg-blue-100 text-blue-800 border-blue-200';
                } else {
                    $contractor->tier = 'Free Profile';
                    $contractor->tier_color = 'bg-gray-100 text-gray-800 border-gray-200';
                }

                // Decode JSON to check brand status easily in the view
                $contractor->has_brand = !empty($contractor->brand_settings);
                
                return $contractor;
            });

        return view('admin.factory.index', [
            'contractors' => $contractors
        ]);
    }
}