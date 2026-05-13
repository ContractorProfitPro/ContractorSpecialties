<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update the default Users table with our business logic
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_cpp_subscriber')->default(false)->after('email');
            $table->string('stripe_customer_id')->nullable()->after('is_cpp_subscriber');
            $table->string('magic_token')->nullable()->after('password');
        });

        // 2. Create the massive, flat SEO engine table
        Schema::create('sc_contractor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Identity & Routing
            $table->string('business_name');
            $table->string('slug')->unique(); // e.g., apex-roofing-lafayette
            
            // External Links (The Trust Web)
            $table->string('website_url')->nullable();
            $table->string('google_business_url')->nullable();
            $table->json('social_links')->nullable();
            
            // Contact & Location
            $table->string('phone');
            $table->boolean('allow_messaging')->default(true); // Toggles the masked contact form
            $table->string('street_address')->nullable();
            $table->string('city');
            $table->string('state', 2);
            $table->string('zip', 20);
            $table->integer('service_radius_miles')->default(30);
            
            // The SEO Meat & Hooks
            $table->string('primary_trade');
            $table->string('specialty');
            $table->text('about_description')->nullable(); // AI-generated bio
            $table->json('services_offered')->nullable();
            $table->boolean('offers_emergency_service')->default(false); // The "Danger Button"
            
            // Trust Signals
            $table->integer('year_founded')->nullable();
            $table->boolean('is_licensed')->default(false);
            $table->boolean('is_insured')->default(false);
            $table->boolean('warranty_offered')->default(false);
            $table->string('license_number')->nullable();
            
            // Media & Cosmetics
            $table->string('brand_color')->default('#F15A29');
            $table->string('logo_path')->nullable();
            $table->string('cover_photo_path')->nullable();
            $table->json('portfolio_images')->nullable(); // Up to 6 standard-cropped images
            
            // Status
            $table->boolean('is_published')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sc_contractor_profiles');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_cpp_subscriber', 'stripe_customer_id', 'magic_token']);
        });
    }
};