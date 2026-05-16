<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactoryController extends Controller
{
    public function index()
    {
        $contractors = DB::table('sc_contractor_profiles')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($contractor) {
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

                $contractor->has_brand = !empty($contractor->brand_settings);
                return $contractor;
            });

        return view('admin.factory.index', compact('contractors'));
    }

    public function edit($id)
    {
        $contractor = DB::table('sc_contractor_profiles')->where('id', $id)->first();
        if (!$contractor) abort(404);

        // Decode the existing JSON so we can populate the form, or provide empty fallbacks
        $brand = json_decode($contractor->brand_settings, true)['theme'] ?? [];

        return view('admin.factory.edit', compact('contractor', 'brand'));
    }

    public function update(Request $request, $id)
    {
        // 1. Build the exact JSON structure the front-end Blade engine expects
        $payload = [
            'theme' => [
                'colors' => [
                    'primary' => $request->input('color_primary', '#021d48'),
                    'secondary' => $request->input('color_secondary', '#F15A29'),
                    'surface' => $request->input('color_surface', '#f9fafb'),
                    'text' => $request->input('color_text', '#4A4E55')
                ],
                'fonts' => [
                    'heading' => $request->input('font_heading', 'Inter'),
                    'display' => $request->input('font_display', 'Inter'),
                    'body' => $request->input('font_body', 'Inter')
                ]
            ]
        ];

        // 2. Inject it into the database
        DB::table('sc_contractor_profiles')->where('id', $id)->update([
            'brand_settings' => json_encode($payload),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.factory.index')->with('success', 'Brand payload updated successfully! Contractor is now Premium.');
    }
}