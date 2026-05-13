<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contractor Specialties | Pro Network Access</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-[#4A4E55] antialiased flex flex-col min-h-screen selection:bg-[#F15A29] selection:text-white">

    <!-- Minimal Header -->
    <div class="w-full bg-[#021d48] py-4 px-6 shadow-md flex justify-center sm:justify-start">
        <a href="/" class="flex items-center">
            <!-- Ensure your vertical logo exists in public/images/logo.webp -->
            <img src="{{ asset('images/logo.webp') }}" alt="Contractor Specialties" class="h-12 w-auto object-contain">
        </a>
    </div>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-2xl shadow-xl border border-gray-100">
            
            <div class="text-center">
                <h2 class="text-3xl font-black text-[#021d48] tracking-tight">Claim Your Profile</h2>
                <p class="mt-3 text-sm text-[#4A4E55] leading-relaxed">
                    Enter your email to instantly access your dashboard. No passwords to remember. We'll send a secure login link directly to your inbox.
                </p>
            </div>

            <!-- Success Message Alert -->
            @if (session('status'))
                <div class="rounded-lg bg-green-50 p-4 border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Magic Link Form -->
            <form class="mt-8 space-y-6" action="{{ route('onboarding.magic') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-[#021d48]">Email address</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="focus:ring-[#F15A29] focus:border-[#F15A29] block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-3 text-[#4A4E55] bg-gray-50 hover:bg-white transition-colors" 
                            placeholder="contractor@example.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-bold text-white bg-[#F15A29] hover:bg-[#d94e22] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F15A29] transition-all transform hover:-translate-y-0.5">
                        Send Login Link
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-500">
                    Free for verified Contractor Profit Pro members. 
                </p>
            </div>
        </div>
    </main>

</body>
</html>