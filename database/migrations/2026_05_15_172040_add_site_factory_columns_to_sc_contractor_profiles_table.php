<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sc_contractor_profiles', function (Blueprint $table) {
            // The JSON Brain: Holds our extracted AI Tailwind logic (colors, fonts, radii)
            $table->json('brand_settings')->nullable()->after('brand_color');
            
            // The Factory Switches: Tells the system if this profile is just a directory listing or a full deployed site
            $table->boolean('has_standalone_site')->default(false)->after('is_published');
            $table->string('standalone_domain')->nullable()->after('has_standalone_site'); // e.g., jackslawns.com
        });
    }

    public function down(): void
    {
        Schema::table('sc_contractor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'brand_settings', 
                'has_standalone_site', 
                'standalone_domain'
            ]);
        });
    }
};