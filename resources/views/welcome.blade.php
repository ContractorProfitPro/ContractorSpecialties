<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contractor Specialties | Find Vetted Pros</title>
    
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
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen">
    
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-2xl font-black tracking-tight text-gray-900">Contractor<span class="text-blue-600">Specialties</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/directory" class="text-gray-600 hover:text-blue-600 font-semibold transition-colors duration-200">Find a Pro</a>
                    <a href="/join" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gray-900 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all duration-200">
                        Contractor Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden bg-white">
        <!-- Subtle Background Decoration -->
        <div class="absolute inset-y-0 text-gray-50 opacity-50 z-0">
            <svg class="h-full w-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon points="0,100 100,0 100,100" />
            </svg>
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl tracking-tight font-black text-gray-900 sm:text-6xl md:text-7xl leading-tight">
                    Find Specialized Pros
                    <span class="block text-blue-600 mt-2">You Can Actually Trust.</span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-500 sm:text-xl md:mt-8 md:text-2xl">
                    Skip the generic directories. We connect homeowners directly with highly-specialized professionals for the exact job you need done right.
                </p>
                <div class="mt-10 max-w-md mx-auto sm:flex sm:justify-center md:mt-12">
                    <div class="rounded-lg shadow-lg">
                        <a href="/directory" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 md:py-5 md:text-xl md:px-12 transition-all duration-200 transform hover:-translate-y-1">
                            Browse the Directory
                        </a>
                    </div>
                    <div class="mt-4 rounded-lg shadow-sm sm:mt-0 sm:ml-4">
                        <a href="#how-it-works" class="w-full flex items-center justify-center px-8 py-4 border-2 border-gray-200 text-lg font-bold rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 md:py-5 md:text-xl md:px-12 transition-all duration-200">
                            How it works
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features -->
    <div class="bg-gray-50 py-20 border-t border-gray-100" id="how-it-works">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 text-blue-600 mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Vetted Professionals</h3>
                    <p class="mt-4 text-gray-500 leading-relaxed">Every contractor is verified to ensure they specialize in exactly what they advertise. No jacks-of-all-trades.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 text-blue-600 mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Direct Contact</h3>
                    <p class="mt-4 text-gray-500 leading-relaxed">No middleman holding your information hostage. Contact pros directly, instantly, and on your terms.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 text-blue-600 mx-auto mb-6">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">100% Free to Use</h3>
                    <p class="mt-4 text-gray-500 leading-relaxed">Homeowners never pay a dime to use our directory. Find the perfect specialist without any hidden fees.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-400 text-sm mb-4 md:mb-0">
                &copy; {{ date('Y') }} Contractor Specialties. All rights reserved.
            </div>
            <div class="flex space-x-6 text-sm text-gray-500">
                <a href="/join" class="hover:text-blue-600 transition-colors">Contractors: Join Network</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>