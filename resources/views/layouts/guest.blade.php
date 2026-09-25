<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('custom.title', 'SMM Panel') }} - Supercharge Your Social Media</title>
    <meta name="description" content="{{ $description ?? '' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'Boosters') }}">
    <meta property="og:description" content="{{ $description ?? '' }}">
    <meta property="og:image" content="{{ $image ?? asset('logo.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="{{ $title ?? config('app.name', 'Boosters') }}">
    <meta property="twitter:description" content="{{ $description ?? '' }}">
    <meta property="twitter:image" content="{{ $image ?? asset('logo.svg') }}">

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

<body class="font-sans text-slate-100 antialiased bg-[#07070a] min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white"
      x-data="{ mobileMenuOpen: false }">

    <!-- Top Glow Line -->
    <div class="fixed top-0 left-0 right-0 z-50 h-[2px] bg-gradient-to-r from-indigo-500 via-pink-500 to-amber-400"></div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 w-full border-b border-white/10 bg-[#08080d]/85 backdrop-blur-xl transition-all duration-300">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Brand Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="relative flex items-center justify-center w-10 h-10 transition-transform duration-300 rounded-xl bg-gradient-to-br from-indigo-500/20 via-purple-500/20 to-pink-500/20 border border-white/10 group-hover:scale-105 group-hover:border-indigo-500/40 shadow-lg shadow-indigo-500/10">
                            <img src="{{ asset('logo.svg') }}" alt="logo" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-6">
                            <div class="absolute inset-0 rounded-xl bg-indigo-500/20 filter blur-sm -z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl sm:text-2xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-indigo-100 to-pink-200">
                                {{ config('custom.title', 'BoostHub') }}
                            </span>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 -mt-1 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Social Growth
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="items-center hidden space-x-1 lg:space-x-2 text-sm font-medium md:flex">
                    <a href="{{ url('/') }}"
                       class="px-3.5 py-2 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'text-white bg-white/10 shadow-sm font-semibold' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                        Home
                    </a>
                    <a href="{{ route('home') }}"
                       class="px-3.5 py-2 rounded-lg transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('home') ? 'text-white bg-white/10 shadow-sm font-semibold' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                        <span>Services & Pricing</span>
                        <span class="px-1.5 py-0.5 text-[10px] font-bold text-amber-300 bg-amber-400/10 border border-amber-400/20 rounded-md">HOT</span>
                    </a>
                    <a href="{{ url('/') }}#how-it-works"
                       class="px-3.5 py-2 text-gray-300 transition-all duration-200 rounded-lg hover:text-white hover:bg-white/5">
                        How It Works
                    </a>
                    <a href="{{ url('/') }}#features"
                       class="px-3.5 py-2 text-gray-300 transition-all duration-200 rounded-lg hover:text-white hover:bg-white/5">
                        Why Us
                    </a>
                    <a href="{{ url('/') }}#faq"
                       class="px-3.5 py-2 text-gray-300 transition-all duration-200 rounded-lg hover:text-white hover:bg-white/5">
                        FAQ
                    </a>
                </nav>

                <!-- Desktop Actions / Auth -->
                <div class="hidden items-center gap-3 sm:flex">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 rounded-full shadow-lg bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 hover:opacity-95 shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fa-solid fa-gauge-high text-xs"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2.5 text-sm font-medium text-gray-300 transition-colors rounded-lg hover:text-white hover:bg-white/5">
                            Sign In
                        </a>
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 rounded-full shadow-lg bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-400 hover:via-purple-400 hover:to-pink-400 shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] active:scale-[0.98]">
                            <span>Boost Now</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Toggle Button -->
                <div class="flex items-center gap-2 md:hidden">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-3 py-1.5 text-xs font-semibold text-white rounded-lg bg-indigo-600 hover:bg-indigo-500">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="px-3 py-1.5 text-xs font-semibold text-white rounded-lg bg-gradient-to-r from-indigo-500 to-pink-500 shadow-sm">
                            Boost
                        </a>
                    @endauth

                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="inline-flex items-center justify-center p-2.5 text-gray-300 transition-colors rounded-xl bg-white/5 border border-white/10 hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            aria-label="Toggle navigation menu"
                            :aria-expanded="mobileMenuOpen.toString()">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             @keydown.escape.window="mobileMenuOpen = false"
             x-cloak
             class="md:hidden border-b border-white/10 bg-[#0a0a0f]/98 backdrop-blur-2xl px-4 pt-3 pb-6 space-y-4">
            <nav class="flex flex-col space-y-1">
                <a href="{{ url('/') }}"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->is('/') ? 'text-white bg-white/10 font-semibold' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-house text-indigo-400 w-5"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('home') }}"
                   @click="mobileMenuOpen = false"
                   class="flex items-center justify-between px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('home') ? 'text-white bg-white/10 font-semibold' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bolt text-pink-400 w-5"></i>
                        <span>Services & Catalog</span>
                    </div>
                    <span class="px-2 py-0.5 text-xs font-bold text-amber-300 bg-amber-400/10 border border-amber-400/20 rounded-md">HOT</span>
                </a>
                <a href="{{ url('/') }}#how-it-works"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 text-gray-300 transition-colors rounded-xl text-base font-medium hover:text-white hover:bg-white/5">
                    <i class="fa-solid fa-list-check text-amber-400 w-5"></i>
                    <span>How It Works</span>
                </a>
                <a href="{{ url('/') }}#features"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 text-gray-300 transition-colors rounded-xl text-base font-medium hover:text-white hover:bg-white/5">
                    <i class="fa-solid fa-shield-halved text-emerald-400 w-5"></i>
                    <span>Why Choose Us</span>
                </a>
                <a href="{{ url('/') }}#faq"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3 text-gray-300 transition-colors rounded-xl text-base font-medium hover:text-white hover:bg-white/5">
                    <i class="fa-solid fa-circle-question text-purple-400 w-5"></i>
                    <span>FAQ</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-white/10 flex flex-col gap-2.5">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="flex items-center justify-center gap-2 w-full py-3.5 text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg shadow-indigo-600/30">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Go to Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('home') }}"
                       class="flex items-center justify-center gap-2 w-full py-3.5 text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-lg shadow-indigo-500/30 font-semibold">
                        <span>Start Boosting Now</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center w-full py-3 text-sm font-medium text-gray-300 rounded-xl bg-white/5 border border-white/10 hover:text-white hover:bg-white/10">
                        Sign In to Account
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Modern Dark Footer -->
    <footer class="relative z-10 bg-[#050508] border-t border-white/10 pt-16 pb-10 text-gray-400 overflow-hidden">
        <!-- Ambient Background Glow -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-3/4 h-64 bg-indigo-600/10 filter blur-[120px] pointer-events-none -z-10"></div>

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 mb-14 md:grid-cols-2 lg:grid-cols-4">

                <!-- Col 1: Brand Info & Social -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500/20 to-pink-500/20 border border-white/10">
                            <img src="{{ asset('logo.svg') }}" alt="logo" class="w-6 h-6">
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white">
                            {{ config('custom.title', 'BoostHub') }}
                        </span>
                    </div>

                    <p class="text-sm leading-relaxed text-gray-400">
                        {{ config('custom.title', 'BoostHub') }} is the #1 social media growth platform. We deliver genuine followers, views, likes, and engagement backed by 24/7 dedicated support.
                    </p>

                    <!-- Trust Pill Badges -->
                    <div class="flex flex-wrap gap-2 text-xs font-semibold text-gray-300">
                        <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 flex items-center gap-1.5">
                            <i class="fa-solid fa-lock text-emerald-400"></i> No Password
                        </span>
                        <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 flex items-center gap-1.5">
                            <i class="fa-solid fa-bolt text-amber-400"></i> Instant Start
                        </span>
                        <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 flex items-center gap-1.5">
                            <i class="fa-solid fa-arrows-rotate text-indigo-400"></i> 30-Day Refill
                        </span>
                    </div>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-3 pt-2">
                        <a href="{{ config('custom.fb', '#') }}" aria-label="Facebook" class="flex items-center justify-center w-9 h-9 text-gray-400 transition-all rounded-lg bg-white/5 border border-white/5 hover:text-white hover:bg-blue-600 hover:border-transparent hover:scale-110">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="{{ config('custom.ins', '#') }}" aria-label="Instagram" class="flex items-center justify-center w-9 h-9 text-gray-400 transition-all rounded-lg bg-white/5 border border-white/5 hover:text-white hover:bg-pink-600 hover:border-transparent hover:scale-110">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="{{ config('custom.twi', '#') }}" aria-label="Twitter / X" class="flex items-center justify-center w-9 h-9 text-gray-400 transition-all rounded-lg bg-white/5 border border-white/5 hover:text-white hover:bg-black hover:border-transparent hover:scale-110">
                            <i class="fa-brands fa-x-twitter text-sm"></i>
                        </a>
                        <a href="#" aria-label="TikTok" class="flex items-center justify-center w-9 h-9 text-gray-400 transition-all rounded-lg bg-white/5 border border-white/5 hover:text-white hover:bg-[#EE1D52] hover:border-transparent hover:scale-110">
                            <i class="fa-brands fa-tiktok text-sm"></i>
                        </a>
                        <a href="#" aria-label="YouTube" class="flex items-center justify-center w-9 h-9 text-gray-400 transition-all rounded-lg bg-white/5 border border-white/5 hover:text-white hover:bg-red-600 hover:border-transparent hover:scale-110">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Supported Platforms -->
                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-white uppercase">Popular Platforms</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-instagram text-pink-500 w-4 group-hover:scale-110 transition-transform"></i>
                                <span>Instagram Growth</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-tiktok text-cyan-400 w-4 group-hover:scale-110 transition-transform"></i>
                                <span>TikTok Views & Followers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-youtube text-red-500 w-4 group-hover:scale-110 transition-transform"></i>
                                <span>YouTube Subscribers & Views</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-facebook text-blue-500 w-4 group-hover:scale-110 transition-transform"></i>
                                <span>Facebook Page Likes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-x-twitter text-white w-4 group-hover:scale-110 transition-transform"></i>
                                <span>X (Twitter) Followers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-400 transition-colors hover:text-indigo-400 group">
                                <i class="fa-brands fa-spotify text-emerald-400 w-4 group-hover:scale-110 transition-transform"></i>
                                <span>Spotify Plays & Followers</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Quick Navigation -->
                <div>
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-white uppercase">Navigation</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/') }}" class="text-gray-400 transition-colors hover:text-indigo-400">Home</a></li>
                        <li><a href="{{ route('home') }}" class="text-gray-400 transition-colors hover:text-indigo-400">Services & Pricing</a></li>
                        <li><a href="{{ url('/') }}#how-it-works" class="text-gray-400 transition-colors hover:text-indigo-400">How It Works</a></li>
                        <li><a href="{{ url('/') }}#features" class="text-gray-400 transition-colors hover:text-indigo-400">Why Choose Us</a></li>
                        <li><a href="{{ url('/') }}#faq" class="text-gray-400 transition-colors hover:text-indigo-400">Frequently Asked Questions</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 transition-colors hover:text-indigo-400">Sign In to Account</a></li>
                    </ul>
                </div>

                <!-- Col 4: Support & Security -->
                <div class="space-y-4">
                    <h4 class="mb-5 text-xs font-bold tracking-widest text-white uppercase">Support & Guarantee</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Need assistance with an order or have questions? Our support team is online 24/7.
                    </p>

                    <div class="space-y-2.5 text-sm">
                        @if(config('custom.email'))
                            <a href="mailto:{{ config('custom.email') }}" class="flex items-center gap-2.5 text-gray-300 hover:text-indigo-400 transition-colors">
                                <i class="fa-regular fa-envelope text-indigo-400"></i>
                                <span class="break-all">{{ config('custom.email') }}</span>
                            </a>
                        @endif
                        <div class="flex items-center gap-2.5 text-gray-300">
                            <i class="fa-regular fa-clock text-amber-400"></i>
                            <span>{{ config('custom.open_time', '24/7 Customer Support') }}</span>
                        </div>
                    </div>

                    <!-- Security Badge -->
                    <div class="p-3 rounded-xl bg-white/5 border border-white/10 flex items-center gap-3 mt-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-shield-check"></i>
                        </div>
                        <div class="text-xs">
                            <p class="font-semibold text-white">SSL 256-Bit Protection</p>
                            <p class="text-gray-400">Confidential & Guaranteed</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Sub-Footer -->
            <div class="flex flex-col items-center justify-between gap-4 pt-8 text-xs text-gray-500 border-t border-white/5 md:flex-row">
                <p>&copy; {{ date('Y') }} {{ config('custom.title', 'BoostHub') }}. All rights reserved.</p>
                <div class="flex flex-wrap items-center gap-6">
                    <span class="text-gray-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i> Safe Checkout
                    </span>
                    <a href="{{ url('/') }}#faq" class="transition-colors hover:text-white">Help & FAQ</a>
                    <a href="{{ route('home') }}" class="transition-colors hover:text-white">Services</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
