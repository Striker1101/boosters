<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('custom.title', 'SMM Panel') }} - Supercharge Your Social Media</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|figtree:400,500,600"
        rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('head')
</head>

<body class="font-sans text-gray-900 antialiased bg-[#f8fafc]">

    <header class="sticky top-0 z-50 w-full border-b border-gray-100 bg-white/80 backdrop-blur-md">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <div class="flex items-center gap-6 mx-8">
                    <a href="/" class="flex items-center gap-2 group">
                        <img src="{{ asset('logo.svg') }}" alt="logo"
                            class="w-8 h-8 transition-transform group-hover:scale-110">
                        <span class="text-xl font-bold tracking-tight text-gray-900">
                            {{ config('custom.title', 'SocialWick') }}
                        </span>
                    </a>
                </div>

                <nav class="items-center hidden space-x-8 text-sm font-medium md:flex">
                    <a href="/services" class="text-gray-600 transition hover:text-blue-600">Services</a>
                    <a href="/blog" class="text-gray-600 transition hover:text-blue-600">Blog</a>
                    <a href="/support" class="text-gray-600 transition hover:text-blue-600">Support</a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-full shadow-sm hover:bg-blue-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 transition hover:text-blue-600">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2 text-sm font-semibold text-white transition bg-gray-900 rounded-full shadow-md hover:bg-black">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <footer class="relative z-10 bg-[#0a0a0a] border-t border-white/5 pt-20 pb-10">
    <div class="px-6 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-12 mb-16 md:grid-cols-2 lg:grid-cols-4">

            <div class="space-y-6">
                <div class="flex items-center gap-2 logo">
                    <img src="{{ asset('logo.svg') }}" alt="logo" class="w-8 h-8">
                    <span class="text-2xl font-bold tracking-tighter text-white">
                        {{ config('custom.title') }}
                    </span>
                </div>
                <p class="text-sm leading-relaxed text-gray-400">
                    {{ config('custom.title') }} is a leading social media shop since 2017.
                    We offer premium services to quickly boost your followership and enhance your online presence with 24/7 expert support.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition-colors rounded-full bg-white/5 hover:bg-indigo-600">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition-colors rounded-full bg-white/5 hover:bg-indigo-600">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition-colors rounded-full bg-white/5 hover:bg-indigo-600">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="mb-6 text-xs font-bold tracking-widest text-white uppercase">Company</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Our Story</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Why us?</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Career</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Blog</a></li>
                    <li><a href="#" class="font-semibold text-gray-400 text-indigo-500 transition hover:text-indigo-400">Affiliates & Reseller</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-6 text-xs font-bold tracking-widest text-white uppercase">Support</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Help Center</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Contact Us</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Track your Order</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Refund Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-6 text-xs font-bold tracking-widest text-white uppercase">Services</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Instagram</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">YouTube</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Facebook</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">TikTok</a></li>
                    </ul>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Spotify</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Twitter (X)</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">LinkedIn</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-indigo-400">Twitch</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="flex flex-col items-center justify-between gap-4 pt-10 text-xs text-gray-500 border-t border-white/5 md:flex-row">
            <p>&copy; {{ date('Y') }} {{ config('custom.title') }}. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="transition hover:text-white">Privacy Policy</a>
                <a href="#" class="transition hover:text-white">Terms of Service</a>
                <a href="#" class="transition hover:text-white">Cookies</a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
