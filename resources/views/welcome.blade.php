<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contractor Specialties | Verified Local Professionals</title>
    
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
    
    <!-- 🚧 TEMP DEV/TEST NAV BAR 🚧 -->
    <div class="bg-yellow-400 text-yellow-900 px-4 py-2 text-xs sm:text-sm font-bold flex flex-wrap justify-center gap-4 sm:gap-6 border-b border-yellow-500 z-50">
        <span class="uppercase tracking-wider opacity-70 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            Dev Tools:
        </span>
        <a href="/" class="hover:text-black underline decoration-yellow-600 underline-offset-2">Home</a>
        <a href="/contractors" class="hover:text-black underline decoration-yellow-600 underline-offset-2">Directory Search</a>
        <a href="/pro/apex-roofing" class="hover:text-black underline decoration-yellow-600 underline-offset-2">Mock Profile</a>
        <a href="/join" class="hover:text-black underline decoration-yellow-600 underline-offset-2">Magic Link Join</a>
        <a href="/dashboard" class="hover:text-black underline decoration-yellow-600 underline-offset-2">Protected Dashboard</a>
    </div>
    <!-- 🚧 END DEV/TEST NAV BAR 🚧 -->

    <!-- Main Navigation -->
    <nav class="bg-[#021d48] shadow-md border-b border-[#4A4E55]/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-28"> 
                <div class="flex items-center py-2">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.webp') }}" alt="Contractor Specialties Logo" class="h-20 w-auto object-contain">
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/contractors" class="text-gray-300 hover:text-white font-semibold transition-colors duration-200">Find a Specialist</a>
                    <a href="/join" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 rounded-lg shadow-sm text-sm font-bold text-white bg-[#4A4E55] hover:bg-[#F15A29] transition-all duration-200">
                        Contractor Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden bg-[#FFFFFF] border-b border-gray-100">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-block py-1 px-3 rounded-full bg-[#1E2A38]/5 text-[#1E2A38] text-sm font-bold tracking-wide uppercase mb-6 border border-[#1E2A38]/10">
                    A Higher Standard of Service
                </span>
                
                <h1 class="text-5xl tracking-tight font-black text-[#1E2A38] sm:text-6xl md:text-7xl leading-tight">
                    The digital home for <br/>
                    <span class="text-[#F15A29]">outstanding professionals.</span>
                </h1>
                
                <p class="mt-6 max-w-2xl mx-auto text-lg text-[#4A4E55] sm:text-xl md:mt-8 md:text-2xl leading-relaxed">
                    You aren't looking at a traditional directory. This is a growing network of elite, independent contractors who prioritize honest work, direct communication, and taking proper care of your home.
                </p>
                
                <div class="mt-10 max-w-xl mx-auto sm:flex sm:justify-center md:mt-12 space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/contractors" class="w-full flex items-center justify-center px-8 py-4 text-lg font-bold rounded-lg text-white bg-[#F15A29] hover:bg-[#d94e22] md:py-5 md:text-xl transition-all duration-200 shadow-lg shadow-[#F15A29]/30 transform hover:-translate-y-0.5">
                        Browse the Network
                    </a>
                    <a href="#our-standard" class="w-full flex items-center justify-center px-8 py-4 border-2 border-[#1E2A38]/10 text-lg font-bold rounded-lg text-[#1E2A38] bg-white hover:bg-gray-50 md:py-5 md:text-xl transition-all duration-200">
                        Our Promise
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- The Philosophy Section -->
    <div class="bg-gray-50 py-24" id="our-standard">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-[#1E2A38] sm:text-4xl">Building the directory homeowners deserve.</h2>
                <p class="mt-4 text-lg text-[#4A4E55] max-w-2xl mx-auto">We are rejecting the broken lead-generation model to build something completely transparent. Here is our standard.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#1E2A38]/20">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#1E2A38] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">Verified Excellence</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">When a contractor makes their digital home here, it means they have been vetted for their specific specialty. They are reliable, highly skilled, and ready to take proper care of you.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#F15A29]/30">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#F15A29] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">Direct Connections</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">We don't stand in the middle, and we certainly don't sell your contact information. You get direct access to the business owner to ensure transparent communication from day one.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-[#1E2A38]/20">
                    <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-[#4A4E55] text-white mb-6">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1E2A38]">A Growing Movement</h3>
                    <p class="mt-4 text-[#4A4E55] leading-relaxed">What starts as a local standard is rapidly growing into a national benchmark for trust. We are elevating the industry, one outstanding professional at a time.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#021d48] border-t border-[#4A4E55]/30 mt-auto">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
                <img src="{{ asset('images/logo.webp') }}" alt="Contractor Specialties" class="h-10 w-auto mb-2">
                <div class="text-[#4A4E55] text-sm mt-2">
                    &copy; {{ date('Y') }} Contractor Specialties. The standard of excellence.
                </div>
            </div>
            <div class="flex space-x-6 text-sm text-gray-400">
                <a href="/join" class="hover:text-[#F15A29] transition-colors">Contractors: Join the Network</a>
                <a href="#" class="hover:text-[#F15A29] transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>