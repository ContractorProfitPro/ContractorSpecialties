<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Explicitly targeting the sc_ prefix table
        Schema::table('sc_contractor_profiles', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->string('tier')->default('Standard')->after('is_published');
            $table->string('tier_color')->default('bg-gray-100 text-gray-800 border-gray-200')->after('tier');
            $table->boolean('has_brand')->default(false)->after('tier_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_contractor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'email', 
                'tier', 
                'tier_color', 
                'has_brand'
            ]);
        });
    }
};