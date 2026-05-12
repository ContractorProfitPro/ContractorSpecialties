<?php

use Illuminate\Support\Facades\Route;

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

// Programmatic SEO: Individual Automated Profiles
Route::get('/pro/{slug}', function ($slug) {
    // We will wire this to the database later, using 'sc_' or standard prefix
    return view('directory.profile', ['slug' => $slug]);
})->name('directory.profile');

// 3. Contractor Onboarding (Frictionless Entry)
// Landing page to sell contractors on the free profile
Route::get('/join', function () {
    return view('onboarding.join'); 
})->name('onboarding.join');

// Endpoint to handle the Magic Link generation
Route::post('/join/magic-link', function () {
    // Logic will go here to generate the token and fire the email
    return back()->with('status', 'Magic link sent!');
})->name('onboarding.magic');