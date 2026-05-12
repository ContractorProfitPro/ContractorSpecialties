<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contractor Specialties | The Anti-Directory</title>
    
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
<body class="bg-[#FFFFFF] text-[#4A4E55] antialiased selection:bg-[#F15A29] selection:text-white flex flex-col min-h-screen">
    
    <!-- Navigation: Primary Navy for maximum trust and structural weight -->
    <nav class="bg-[#1E2A38] shadow-md border-b border-[#4A4E55]/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Clean, modern typographic logo -->
                    <span class="text-2xl font-black tracking-tight text-white">
                        Contractor<span class="text-[#F15A29]">Specialties</span>
                    </span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/directory" class="text-gray-300 hover:text-white font-semibold transition-colors duration-200">Find a Pro</a>
                    <a href="/join" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 rounded-lg shadow-sm text-sm font-bold text-white bg-[#4A4E55] hover:bg-[#F15A29] transition-all duration-200">
                        Contractor Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section: Clean, distraction-free, focused on the immediate problem -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden bg-[#FFFFFF] border-b border-gray-100">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Safety Orange badge for energy and visibility -->
                <span class="inline-block py-1 px-3 rounded-full bg-[#F15A29]/10 text-[#F15A29] text-sm font-bold tracking-wide uppercase mb-6 border border-[#F15A29]/20">
                    The Anti-Directory
                </span>
                
                <h1 class="text-5xl tracking-tight font-black text-[#1E2A38] sm:text-6xl md:text-7xl leading-tight">
                    Find the right pro. <br/>
                    <span class="text-[#4A4E55]">Skip the middleman.</span>
                </h1>
                
                <p class="mt-6 max-w-2xl mx-auto text-lg text-[#4A4E55] sm:text-xl md:mt-8 md:text-2xl leading-relaxed">
                    No lead-gen traps. No hidden phone numbers. Just fast, clear access to verified local specialists in your town.
                </p>
                
                <div class="mt-10 max-w-xl mx-auto sm:flex sm:justify-center md:mt-12 space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Primary CTA -->
                    <a href="/directory" class="w-full flex items-center justify-center px-8 py-4 text-lg font-bold rounded-lg text-white bg-[#F15A29] hover:bg-[#d94e22] md:py-5 md:text-xl transition-all duration-200 shadow-lg shadow-[#F15A29]/30 transform hover:-translate-y-0.5">
                        Search Your Town
                    </a>
                    <!-- Secondary CTA -->
                    <a href="#philosophy" class="w-full flex items-center justify-center px-8 py-4 border-2 border-[#1E2A38]/10 text-lg font-bold rounded-lg text-[#1E2A38] bg-white hover:bg-gray-50 md:py-5 md:text-xl transition-all duration-200">
                        Why We're Different
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- The Philosophy Section (Calms the partner, sells the user) -->
    <div class="bg-gray-50 py-24" id="philosophy">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-[#1E2A38] sm:text-4xl">Built for speed. Designed for trust.</h2>
                <p class="mt-4 text-lg text-[#4A4E55] max-w-2xl mx-auto">We got tired of directories that sell your data to ten different contractors. Here is our promise to you.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#1E2A38]/20">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#1E2A38] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">Zero Distractions</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">Fast, clear navigation. We don't bombard you with ads or force you to fill out endless forms just to see a phone number.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#F15A29]/30">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#F15A29] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">Fair Curation</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">Contractors can't simply buy their way to the top. Our listings prioritize accurate, complete profiles and localized expertise.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#1E2A38]/20">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#4A4E55] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">Direct Connections</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">Find a pro you like? Call them. It really is that simple. We step out of the way so you can get the job done.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1E2A38] border-t border-[#4A4E55]/30 mt-auto">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="text-[#4A4E55] text-sm mb-4 md:mb-0">
                &copy; {{ date('Y') }} Contractor Specialties. The Anti-Directory.
            </div>
            <div class="flex space-x-6 text-sm text-gray-400">
                <a href="/join" class="hover:text-[#F15A29] transition-colors">Contractor Login</a>
                <a href="#" class="hover:text-[#F15A29] transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>