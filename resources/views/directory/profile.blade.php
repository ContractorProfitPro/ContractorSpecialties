@php
    // --- MOCK DATABASE / INCOMING DATA ---
    $business_name = $business_name ?? "Jack's Lawn Care";
    $primary_trade = $primary_trade ?? 'Landscaping';
    $specialty = $specialty ?? 'Residential & Commercial';
    $phone = $phone ?? '252-917-7308';
    $phone_formatted = $phone_formatted ?? '(252) 917-7308';
    $street_address = $street_address ?? '';
    $city = $city ?? 'Washington';
    $state = $state ?? 'NC';
    $zip = $zip ?? '27889';
    $year_founded = $year_founded ?? date('Y');
    $is_licensed = $is_licensed ?? true;
    $license_number = $license_number ?? '';
    $is_insured = $is_insured ?? true;
    $warranty_offered = $warranty_offered ?? false;
    $service_radius_miles = $service_radius_miles ?? 30;
    
    $services_offered = $services_offered ?? [
        'Landscape Design', 
        'Lawn Maintenance', 
        'Hardscaping', 
        'Irrigation Systems'
    ];

    // --- THE DYNAMIC STYLING ENGINE ---
    // In production, $brand_settings comes directly from the database column.
    // For this mockup, we inject Jack's Tracer Bullet payload if it exists.
    $brand_settings_json = $brand_settings ?? '{
        "theme": {
            "colors": {
                "primary": "#2D4F36",
                "secondary": "#A33B31",
                "surface": "#E6D5B8",
                "text": "#2B2B2B"
            },
            "fonts": {
                "heading": "Yellowtail",
                "display": "Oswald",
                "body": "Playfair Display"
            }
        }
    }';

    $brand = json_decode($brand_settings_json, true)['theme'] ?? [];
    
    // Extract colors with Contractor Specialties Defaults as fallbacks
    $colors = $brand['colors'] ?? [];
    $colorPrimary = $colors['primary'] ?? '#021d48'; // CS Navy Default
    $colorSecondary = $colors['secondary'] ?? '#F15A29'; // CS Orange Default
    $colorSurface = $colors['surface'] ?? '#f9fafb'; // Tailwind gray-50 Default
    $colorText = $colors['text'] ?? '#4A4E55'; // CS Text Default

    // Extract fonts with Inter as fallback
    $fonts = $brand['fonts'] ?? [];
    $fontHeading = $fonts['heading'] ?? 'Inter';
    $fontDisplay = $fonts['display'] ?? 'Inter';
    $fontBody = $fonts['body'] ?? 'Inter';

    // Build the dynamic Google Fonts URL
    $fontList = array_unique(array_filter([$fontHeading, $fontDisplay, $fontBody, 'Inter']));
    $fontQuery = implode('&family=', array_map(function($f) { 
        return str_replace(' ', '+', $f) . ':wght@400;500;600;700;800;900'; 
    }, $fontList));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $business_name }} | {{ $specialty }} in {{ $city }}, {{ $state }}</title>
    <meta name="description" content="Contact {{ $business_name }} directly. Local {{ $primary_trade }} serving a {{ $service_radius_miles }}-mile radius around {{ $city }}. Licensed, insured, and verified.">
    
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "HomeAndConstructionBusiness",
      "name": "{{ $business_name }}",
      "telephone": "{{ $phone_formatted }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $street_address }}",
        "addressLocality": "{{ $city }}",
        "addressRegion": "{{ $state }}",
        "postalCode": "{{ $zip }}"
      },
      "areaServed": {
        "@@type": "GeoCircle",
        "geoMidpoint": {
            "@@type": "GeoCoordinates",
            "latitude": "35.5465", 
            "longitude": "-77.0522"
        },
        "geoRadius": "{{ $service_radius_miles * 1609.34 }}" 
      },
      "foundingDate": "{{ $year_founded }}"
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontQuery }}&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        :root {
            --brand-primary: {{ $colorPrimary }};
            --brand-secondary: {{ $colorSecondary }};
            --brand-surface: {{ $colorSurface }};
            --brand-text: {{ $colorText }};
            
            --font-heading: '{{ $fontHeading }}', sans-serif;
            --font-display: '{{ $fontDisplay }}', sans-serif;
            --font-body: '{{ $fontBody }}', sans-serif;
        }

        body { 
            font-family: var(--font-body); 
            background-color: var(--brand-surface);
            color: var(--brand-text);
        }
        
        h1, h2, h3 { font-family: var(--font-heading); }
        .font-display { font-family: var(--font-display); }

        .brand-primary-bg { background-color: var(--brand-primary); }
        .brand-primary-text { color: var(--brand-primary); }
        .brand-secondary-bg { background-color: var(--brand-secondary); }
        .brand-secondary-text { color: var(--brand-secondary); }
        .brand-border { border-color: var(--brand-secondary); }
    </style>
</head>
<body class="antialiased pb-20">
    
    <div class="brand-primary-bg py-3 px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm shadow-md">
        <a href="/" class="text-white/80 hover:text-white flex items-center gap-2 transition-colors font-sans">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            ContractorSpecialties
        </a>
        <span class="brand-secondary-text font-bold flex items-center gap-1 font-sans">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Verified {{ $primary_trade }}
        </span>
    </div>

    <div class="bg-white/50 border-b border-gray-200 shadow-sm relative z-10">
        <div class="h-32 sm:h-48 w-full bg-black/10 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(var(--brand-primary) 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative pb-8">
            <div class="sm:flex sm:items-end sm:space-x-5">
                <div class="relative -mt-16 sm:-mt-24 flex items-center justify-center h-32 w-32 rounded-2xl ring-4 ring-white bg-white shadow-md overflow-hidden shrink-0 brand-border border-b-4">
                    <span class="text-6xl font-display brand-primary-text">{{ substr($business_name, 0, 1) }}</span>
                </div>
                
                <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <h1 class="text-4xl brand-primary-text truncate">
                            {{ $business_name }}
                        </h1>
                        <p class="text-lg font-medium opacity-80 mt-1 font-sans">
                            {{ $specialty }}
                        </p>
                    </div>
                    
                    <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="tel:{{ $phone }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg shadow-lg text-white brand-secondary-bg hover:opacity-90 transition-all transform hover:-translate-y-0.5 font-sans">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $phone_formatted }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden sm:block md:hidden mt-6 min-w-0 flex-1">
                <h1 class="text-3xl brand-primary-text truncate">
                    {{ $business_name }}
                </h1>
                <p class="text-lg font-medium opacity-80 font-sans">
                    {{ $specialty }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-2 space-y-8">
                <section class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl brand-primary-text border-b border-gray-100 pb-4 mb-4">About the Business</h2>
                    <div class="text-lg leading-relaxed opacity-90">
                        <p>{{ $about_description ?? 'We are a locally owned and operated landscaping company specializing in full landscape design and maintenance. We pride ourselves on transparent pricing, showing up on time, and leaving your property looking better than we found it.' }}</p>
                    </div>
                </section>

                <section class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl brand-primary-text border-b border-gray-100 pb-4 mb-4">Specialized Services</h2>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-sans">
                        @foreach($services_offered as $service)
                        <li class="flex items-start">
                            <svg class="h-5 w-5 brand-secondary-text mt-0.5 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-medium opacity-90">{{ $service }}</span>
                        </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="space-y-6">
                <div class="brand-primary-bg rounded-2xl p-6 text-white shadow-md border-t-4 brand-border font-sans">
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-white">
                        <svg class="h-5 w-5 brand-secondary-text" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Trust Factors
                    </h3>
                    <ul class="space-y-3 text-sm text-white/80">
                        <li class="flex items-center justify-between border-b border-white/20 pb-2">
                            <span>Licensed</span>
                            @if($is_licensed)
                                <span class="text-white font-semibold flex items-center gap-1">Yes <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></span>
                            @else
                                <span class="text-white/50">N/A</span>
                            @endif
                        </li>
                        @if($license_number)
                        <li class="flex items-center justify-between border-b border-white/20 pb-2">
                            <span>License #</span>
                            <span class="text-white font-mono text-xs">{{ $license_number }}</span>
                        </li>
                        @endif
                        <li class="flex items-center justify-between border-b border-white/20 pb-2">
                            <span>Insured</span>
                            @if($is_insured)
                                <span class="text-white font-semibold flex items-center gap-1">Yes <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></span>
                            @else
                                <span class="text-white/50">N/A</span>
                            @endif
                        </li>
                        <li class="flex items-center justify-between border-b border-white/20 pb-2">
                            <span>Warranty</span>
                            <span class="text-white font-semibold">{{ $warranty_offered ? 'Provided' : 'Varies' }}</span>
                        </li>
                        <li class="flex items-center justify-between pb-1">
                            <span>Est.</span>
                            <span class="text-white font-semibold">{{ $year_founded }}</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 font-sans">
                    <h3 class="text-lg font-bold brand-primary-text mb-4">Service Area</h3>
                    <div class="flex items-start opacity-90 text-sm">
                        <svg class="h-5 w-5 opacity-50 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>
                            Based in <strong>{{ $city }}, {{ $state }}</strong><br>
                            <span class="opacity-70 mt-1 block">Serving a {{ $service_radius_miles }}-mile radius</span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-200 sm:hidden z-50">
        <a href="tel:{{ $phone }}" class="w-full flex justify-center items-center px-4 py-3 border border-transparent text-base font-bold rounded-lg text-white brand-secondary-bg shadow-lg font-sans">
            Call Now: {{ $phone_formatted }}
        </a>
    </div>

</body>
</html>