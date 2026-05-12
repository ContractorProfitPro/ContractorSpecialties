<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Programmatic SEO Meta Tags (Dynamic) -->
    <title>{{ $businessName ?? 'Apex Roofing & Exteriors' }} | Verified Specialist in {{ $city ?? 'Lafayette' }}, {{ $state ?? 'IN' }}</title>
    <meta name="description" content="Contact {{ $businessName ?? 'Apex Roofing & Exteriors' }} directly. Verified local specialist for {{ $specialty ?? 'Residential Roofing and Repairs' }} in {{ $city ?? 'Lafayette' }}. No middleman, no lead fees.">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Safely load Vite assets, fallback to CDN if not built -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-[#4A4E55] antialiased selection:bg-[#F15A29] selection:text-white pb-20">
    
    <!-- Minimalist Network Header (Builds trust but doesn't distract) -->
    <div class="bg-[#1E2A38] py-3 px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
        <a href="/" class="text-gray-300 hover:text-white flex items-center gap-2 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            ContractorSpecialties Network
        </a>
        <span class="text-[#F15A29] font-bold flex items-center gap-1">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Verified Pro
        </span>
    </div>

    <!-- Hero / Header Section -->
    <div class="bg-white border-b border-gray-200 shadow-sm relative z-10">
        <!-- Optional Cover Photo Area -->
        <div class="h-32 sm:h-48 w-full bg-[#4A4E55] relative overflow-hidden">
            <!-- Fallback Pattern if no cover image -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative pb-8">
            <div class="sm:flex sm:items-end sm:space-x-5">
                <!-- Avatar / Logo -->
                <div class="relative -mt-16 sm:-mt-24 flex items-center justify-center h-32 w-32 rounded-2xl ring-4 ring-white bg-white shadow-md overflow-hidden shrink-0">
                    <span class="text-4xl font-black text-[#1E2A38]">{{ substr($businessName ?? 'A', 0, 1) }}</span>
                </div>
                
                <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <h1 class="text-3xl font-black text-[#1E2A38] truncate">
                            {{ $businessName ?? 'Apex Roofing & Exteriors' }}
                        </h1>
                        <p class="text-lg font-medium text-[#4A4E55] mt-1">
                            {{ $specialty ?? 'Residential Roof Replacement & Repair' }}
                        </p>
                    </div>
                    
                    <!-- Primary CTA (Mobile + Desktop) -->
                    <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="tel:{{ $phone ?? '555-0198' }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg shadow-lg text-white bg-[#F15A29] hover:bg-[#d94e22] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F15A29] transition-all transform hover:-translate-y-0.5">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $phoneFormatted ?? '(555) 555-0198' }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden sm:block md:hidden mt-6 min-w-0 flex-1">
                <h1 class="text-2xl font-black text-[#1E2A38] truncate">
                    {{ $businessName ?? 'Apex Roofing & Exteriors' }}
                </h1>
                <p class="text-lg font-medium text-[#4A4E55]">
                    {{ $specialty ?? 'Residential Roof Replacement & Repair' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Left Column: Details -->
            <div class="md:col-span-2 space-y-8">
                <!-- About Section -->
                <section class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-[#1E2A38] border-b border-gray-100 pb-4 mb-4">About the Business</h2>
                    <div class="prose prose-blue text-[#4A4E55] leading-relaxed">
                        <p>{{ $description ?? 'We are a locally owned and operated roofing company specializing in full roof replacements and emergency leak repairs. We pride ourselves on transparent pricing, showing up on time, and leaving your property cleaner than we found it. No high-pressure sales, just honest assessments.' }}</p>
                    </div>
                </section>

                <!-- Core Services (SEO Goldmine) -->
                <section class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-[#1E2A38] border-b border-gray-100 pb-4 mb-4">Specialized Services</h2>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $services = $services ?? ['Asphalt Shingle Replacement', 'Emergency Leak Repair', 'Storm Damage Assessment', 'Gutter Installation'];
                        @endphp
                        @foreach($services as $service)
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#F15A29] mt-0.5 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-[#4A4E55] font-medium">{{ $service }}</span>
                        </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <!-- Right Column: Trust Signals & Meta -->
            <div class="space-y-6">
                <!-- Trust Card -->
                <div class="bg-[#1E2A38] rounded-2xl p-6 text-white shadow-md">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-[#F15A29]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Trust Factors
                    </h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-center justify-between border-b border-gray-600/50 pb-2">
                            <span>Licensed</span>
                            <span class="text-white font-semibold">Yes</span>
                        </li>
                        <li class="flex items-center justify-between border-b border-gray-600/50 pb-2">
                            <span>Insured</span>
                            <span class="text-white font-semibold">Yes</span>
                        </li>
                        <li class="flex items-center justify-between pb-1">
                            <span>Years in Business</span>
                            <span class="text-white font-semibold">{{ $yearsInBusiness ?? '12' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Location / Service Area -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1E2A38] mb-4">Service Area</h3>
                    <div class="flex items-start text-[#4A4E55] text-sm">
                        <svg class="h-5 w-5 text-gray-400 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>
                            Based in <strong>{{ $city ?? 'Lafayette' }}, {{ $state ?? 'IN' }}</strong><br>
                            <span class="text-gray-500 mt-1 block">Serving a {{ $radius ?? '30' }}-mile radius</span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Fixed Bottom CTA (Mobile Only) for maximum conversion -->
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-200 sm:hidden z-50">
        <a href="tel:{{ $phone ?? '555-0198' }}" class="w-full flex justify-center items-center px-4 py-3 border border-transparent text-base font-bold rounded-lg text-white bg-[#F15A29] hover:bg-[#d94e22] shadow-lg">
            Call Now: {{ $phoneFormatted ?? '(555) 555-0198' }}
        </a>
    </div>

</body>
</html>