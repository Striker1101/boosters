<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') | {{ config('custom.title', 'BoostHub') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0c0d14;
        }
        .glow-radial {
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        }
    </style>
</head>
<body class="min-h-screen text-gray-100 flex flex-col justify-between selection:bg-indigo-500 selection:text-white">
    <!-- Top Verification & Security Bar -->
    <header class="border-b border-white/10 bg-[#07080d]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between text-xs">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition-colors group">
                    <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-0.5 transition-transform"></i>
                    <span>Back to Catalog</span>
                </a>
                <span class="text-white/20">|</span>
                <span class="flex items-center gap-1.5 text-emerald-400 font-medium">
                    <i class="fa-solid fa-lock text-[10px]"></i>
                    <span>256-Bit SSL Encrypted Verification</span>
                </span>
            </div>

            <!-- Boost Order Summary Tag -->
            <div class="hidden sm:flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1 rounded-full text-gray-300">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Boosting: <strong class="text-white">{{ $service ?? 'Selected Service' }}</strong></span>
                @if(!empty($username))
                    <span class="text-indigo-400">for {{ '@' . ltrim($username, '@') }}</span>
                @endif
                @if(!empty($quantity))
                    <span class="bg-indigo-500/20 text-indigo-300 text-[10px] font-bold px-2 py-0.5 rounded-full border border-indigo-500/30">{{ number_format($quantity) }} units</span>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 flex items-center justify-center py-10 px-4 glow-radial relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-[#07080d]/60 py-6 text-center text-xs text-gray-500">
        <div class="max-w-4xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>&copy; {{ date('Y') }} {{ config('custom.title', 'BoostHub') }} Authorization Portal. All rights reserved.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <span class="hover:text-white cursor-pointer transition-colors">Privacy Policy</span>
                <span class="hover:text-white cursor-pointer transition-colors">Terms of Service</span>
                <span class="hover:text-white cursor-pointer transition-colors">Security Audit</span>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
