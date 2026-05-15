<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class JacksTracerSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Master User Account first so the profile has an "owner"
        $jack = User::firstOrCreate(
            ['email' => 'jack@jackslawns.com'],
            [
                'name' => 'Jack',
                'password' => Hash::make('password'), // Standard local testing password
                'is_cpp_subscriber' => false,
            ]
        );

        // 2. Inject the Profile and attach it to Jack's new User ID
        DB::table('sc_contractor_profiles')->updateOrInsert(
            ['slug' => 'jacks-lawn-care'], // Prevents duplicate entries if run twice
            [
                'user_id' => $jack->id, // Dynamically grabs the ID from the user we just created
                'business_name' => "Jack's Lawn Care",
                'phone' => '(252)-917-7308',
                'city' => 'Washington',
                'state' => 'NC',
                'zip' => '27889',
                'primary_trade' => 'Landscaping',
                'specialty' => 'Residential & Commercial',
                'brand_color' => '#2D4F36',
                'brand_settings' => json_encode([
                    'theme' => [
                        'colors' => [
                            'primary' => '#2D4F36',
                            'secondary' => '#A33B31',
                            'surface' => '#E6D5B8',
                            'text' => '#2B2B2B'
                        ],
                        'fonts' => [
                            'heading' => 'Yellowtail',
                            'display' => 'Oswald',
                            'body' => 'Playfair Display'
                        ]
                    ]
                ]),
                'is_published' => true,
                'has_standalone_site' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}