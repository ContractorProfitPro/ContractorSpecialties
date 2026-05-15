<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagicLinkController;
use App\Http\Controllers\ContractorProfileController; // <-- Added our new Dynamic Engine

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Customer Front End (Lead Capture / Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. Contractor Directory (The "Trojan Horse")
// Main directory search/listing page
Route::get('/contractors', function () {
    return view('directory.index');
})->name('directory.index');

// Programmatic SEO: Individual Automated Profiles (Now wired to the database)
Route::get('/pro/{slug}', [ContractorProfileController::class, 'show'])->name('profiles.show');

// 3. Contractor Onboarding (Frictionless Entry)
// Landing page to sell contractors on the free profile
Route::get('/join', function () {
    return view('onboarding.join'); 
})->name('onboarding.join');

// Endpoint to handle the Magic Link generation
Route::post('/join/magic-link', [MagicLinkController::class, 'sendLink'])->name('onboarding.magic');

// Endpoint to verify the Magic Link token from the email
Route::get('/verify-magic-link/{token}', [MagicLinkController::class, 'verify'])->name('onboarding.verify');

// 4. Contractor Dashboard (Protected by Auth Middleware)
Route::middleware('auth')->get('/dashboard', function () {
    return 'Welcome to the Builder! Your Magic Link worked.';
})->name('dashboard');