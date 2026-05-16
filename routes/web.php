<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagicLinkController;
use App\Http\Controllers\ContractorProfileController; 
use App\Http\Controllers\Admin\FactoryController; // <-- Added the Factory Command Center

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

// 5. Admin Command Center (The Site Factory)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/factory', [FactoryController::class, 'index'])->name('factory.index');
    Route::get('/factory/{id}/edit', [FactoryController::class, 'edit'])->name('factory.edit');
    Route::post('/factory/{id}', [FactoryController::class, 'update'])->name('factory.update');
});