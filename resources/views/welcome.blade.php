<x-guest-layout>

    <!-- Background Ambient Glows & Grid -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-tr from-indigo-600/20 via-purple-600/15 to-pink-500/10 rounded-full blur-[140px]"></div>
        <div class="absolute top-[40%] -left-32 w-96 h-96 bg-indigo-600/15 rounded-full blur-[120px]"></div>
        <div class="absolute top-[60%] -right-32 w-96 h-96 bg-pink-600/15 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <!-- ========================================================================= -->
    <!-- HERO SECTION                                                              -->
    <!-- ========================================================================= -->
    <section class="relative pt-12 pb-20 sm:pt-20 sm:pb-28 overflow-hidden">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto space-y-8">

                <!-- Trust Pill Badge -->
                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md shadow-lg shadow-indigo-500/5 hover:border-indigo-500/30 transition-all cursor-default">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs sm:text-sm font-semibold text-gray-200">
                        ⚡ #1 Rated Social Media Growth Platform • Over 2.4M+ Orders Fulfilled
                    </span>
                </div>

                <!-- Main Hero Headline -->
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white leading-[1.1]">
                    Supercharge Your <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-300 to-pink-400">
                        Social Media Growth
                    </span>
                </h1>

                <!-- Hero Subtitle -->
                <p class="text-lg sm:text-xl text-gray-300 max-w-2xl mx-auto font-normal leading-relaxed">
                    Gain authentic followers, high-retention views, likes, and genuine engagement across all major platforms. Instant automated start with <span class="text-white font-semibold underline decoration-indigo-400 decoration-2 underline-offset-4">zero password required</span>.
                </p>

                <!-- Dual Action CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a href="{{ route('home') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 text-base font-bold text-white transition-all duration-200 rounded-2xl shadow-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-400 hover:via-purple-400 hover:to-pink-400 shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-[1.02] active:scale-[0.98]">
                        <span>Explore Services & Pricing</span>
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>

                    <a href="#how-it-works"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 text-base font-semibold text-gray-300 transition-all duration-200 rounded-2xl bg-white/5 border border-white/10 hover:text-white hover:bg-white/10 hover:border-white/20">
                        <i class="fa-regular fa-circle-play text-indigo-400"></i>
                        <span>See How It Works</span>
                    </a>
                </div>

                <!-- Trust Strip -->
                <div class="pt-6 flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-xs sm:text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <div class="flex text-amber-400 text-xs">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <span class="text-gray-200 font-medium">4.9/5 from 18,500+ reviews</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i>
                        <span class="text-gray-200 font-medium">100% Safe & Compliant</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-amber-400"></i>
                        <span class="text-gray-200 font-medium">Instant Start (< 60s)</span>
                    </div>
                </div>

                <!-- Floating Supported Platform Cards Carousel -->
                <div class="pt-8">
                    <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-6">Supported Platforms</p>
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-pink-500/50 hover:bg-pink-500/10 transition-all">
                            <img src="{{ asset('images/instagram_1.png') }}" alt="Instagram" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">Instagram</span>
                        </a>

                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all">
                            <img src="{{ asset('images/tictok_1.png') }}" alt="TikTok" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">TikTok</span>
                        </a>

                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-red-500/50 hover:bg-red-500/10 transition-all">
                            <img src="{{ asset('images/youtube_1.png') }}" alt="YouTube" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">YouTube</span>
                        </a>

                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                            <img src="{{ asset('images/facebook_1.png') }}" alt="Facebook" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">Facebook</span>
                        </a>

                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-gray-400/50 hover:bg-white/10 transition-all">
                            <img src="{{ asset('images/twitter_1.png') }}" alt="X / Twitter" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">Twitter (X)</span>
                        </a>

                        <a href="{{ route('home') }}" class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/50 hover:bg-emerald-500/10 transition-all">
                            <img src="{{ asset('images/spotify_2.png') }}" alt="Spotify" class="w-6 h-6 object-contain group-hover:scale-110 transition-transform">
                            <span class="text-xs sm:text-sm font-semibold text-gray-200 group-hover:text-white">Spotify</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- METRICS / STATS STRIP                                                     -->
    <!-- ========================================================================= -->
    <section class="relative py-12 border-y border-white/5 bg-white/[0.02]">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">

                <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/10 text-center space-y-1 hover:border-indigo-500/40 transition-colors">
                    <p class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                        2.4M+
                    </p>
                    <p class="text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">
                        Orders Delivered
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/10 text-center space-y-1 hover:border-pink-500/40 transition-colors">
                    <p class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-rose-400">
                        99.8%
                    </p>
                    <p class="text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">
                        Satisfaction Rate
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/10 text-center space-y-1 hover:border-amber-500/40 transition-colors">
                    <p class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-400">
                        &lt; 60s
                    </p>
                    <p class="text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">
                        Instant Delivery Start
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.03] border border-white/10 text-center space-y-1 hover:border-emerald-500/40 transition-colors">
                    <p class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">
                        24/7
                    </p>
                    <p class="text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">
                        Live Human Support
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- HOW IT WORKS (3 SIMPLE STEPS)                                             -->
    <!-- ========================================================================= -->
    <section id="how-it-works" class="py-20 sm:py-28 relative">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Fast & Effortless</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                    How It Works in 3 Simple Steps
                </h2>
                <p class="text-base sm:text-lg text-gray-400">
                    Boost your social media presence without hassle. No technical skills or passwords required.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

                <!-- Step 1 -->
                <div class="relative p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-indigo-500/40 transition-all duration-300 group space-y-5">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 text-2xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <span class="text-4xl font-black text-white/10 group-hover:text-indigo-500/20 transition-colors">01</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">1. Select Your Service</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Choose your target platform (Instagram, TikTok, YouTube, etc.) and pick the exact boost you need: Followers, Likes, Views, or Comments.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-pink-500/40 transition-all duration-300 group space-y-5">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-pink-500/20 border border-pink-500/30 flex items-center justify-center text-pink-400 text-2xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-link"></i>
                        </div>
                        <span class="text-4xl font-black text-white/10 group-hover:text-pink-500/20 transition-colors">02</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">2. Paste Link & Quantity</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Simply paste your public username or post link and pick your quantity. We never ask for your password or credentials.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-amber-500/40 transition-all duration-300 group space-y-5">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-rocket"></i>
                        </div>
                        <span class="text-4xl font-black text-white/10 group-hover:text-amber-500/20 transition-colors">03</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">3. Watch Instant Growth</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Sit back as our automated servers immediately start processing your order in seconds. Track delivery in real time with our live dashboard.
                    </p>
                </div>

            </div>

            <!-- Jump to catalog CTA -->
            <div class="text-center mt-12">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 font-semibold text-sm group">
                    <span>Browse complete service catalog & pricing</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- POPULAR SERVICES SHOWCASE                                                 -->
    <!-- ========================================================================= -->
    <section class="py-20 bg-white/[0.01] border-y border-white/5 relative">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-pink-400">Featured Catalog</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                    Popular Services by Platform
                </h2>
                <p class="text-base sm:text-lg text-gray-400">
                    Highest quality followers and engagement at unbeatable wholesale rates.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Instagram Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-pink-500/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/instagram_1.png') }}" alt="Instagram" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Instagram</h3>
                                    <span class="text-xs text-pink-400 font-semibold">High Retention</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-emerald-400 bg-emerald-500/10 rounded-full border border-emerald-500/20">Active</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500 text-xs"></i> High-Quality Profile Followers</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500 text-xs"></i> Instant Post & Reel Likes</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500 text-xs"></i> Viral Reel Views & Impressions</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-pink-500 text-xs"></i> Custom Comments & Story Views</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-pink-600 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order Instagram Services
                    </a>
                </div>

                <!-- TikTok Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-cyan-500/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/tictok_1.png') }}" alt="TikTok" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">TikTok</h3>
                                    <span class="text-xs text-cyan-400 font-semibold">Fast Delivery</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-amber-400 bg-amber-500/10 rounded-full border border-amber-500/20">Trending</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-cyan-400 text-xs"></i> Video Views (For You Page Push)</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-cyan-400 text-xs"></i> Real Profile Followers</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-cyan-400 text-xs"></i> Video Likes & Favorites</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-cyan-400 text-xs"></i> Shares & Saves for Algorithm</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-cyan-600 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order TikTok Services
                    </a>
                </div>

                <!-- YouTube Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-red-500/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/youtube_1.png') }}" alt="YouTube" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">YouTube</h3>
                                    <span class="text-xs text-red-400 font-semibold">Monetization Ready</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-emerald-400 bg-emerald-500/10 rounded-full border border-emerald-500/20">Active</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-red-500 text-xs"></i> Channel Subscribers (Permanent)</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-red-500 text-xs"></i> High-Retention Watch Time Views</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-red-500 text-xs"></i> Shorts Views & Likes</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-red-500 text-xs"></i> Video Comments & Shares</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-red-600 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order YouTube Services
                    </a>
                </div>

                <!-- Twitter / X Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-white/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/twitter_1.png') }}" alt="X / Twitter" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Twitter (X)</h3>
                                    <span class="text-xs text-gray-400 font-semibold">Real Profiles</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-indigo-400 bg-indigo-500/10 rounded-full border border-indigo-500/20">Stable</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-gray-300 text-xs"></i> Account Followers</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-gray-300 text-xs"></i> Retweets (Reposts) & Likes</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-gray-300 text-xs"></i> Impression & Tweet Views</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-gray-300 text-xs"></i> Poll Votes & Bookmarks</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/20 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order X (Twitter) Services
                    </a>
                </div>

                <!-- Facebook Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-blue-500/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/facebook_1.png') }}" alt="Facebook" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Facebook</h3>
                                    <span class="text-xs text-blue-400 font-semibold">Page Growth</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-emerald-400 bg-emerald-500/10 rounded-full border border-emerald-500/20">Active</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500 text-xs"></i> Page Likes & Follows</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500 text-xs"></i> Post Reactions (Like, Love, Care)</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500 text-xs"></i> Video Views & Reels</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500 text-xs"></i> Group Members & Shares</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-blue-600 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order Facebook Services
                    </a>
                </div>

                <!-- Spotify Card -->
                <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-emerald-500/40 hover:bg-white/[0.05] transition-all flex flex-col justify-between space-y-6 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/spotify_2.png') }}" alt="Spotify" class="w-10 h-10 object-contain">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Spotify</h3>
                                    <span class="text-xs text-emerald-400 font-semibold">Artist Boost</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-bold text-emerald-400 bg-emerald-500/10 rounded-full border border-emerald-500/20">Active</span>
                        </div>
                        <ul class="space-y-2.5 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs"></i> Track & Album Streams</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs"></i> Monthly Listeners</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs"></i> Artist Profile Followers</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs"></i> Playlist Saves & Followers</li>
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="w-full py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-emerald-600 hover:text-white hover:border-transparent text-center text-sm font-semibold text-gray-200 transition-all">
                        Order Spotify Services
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- VALUE PILLARS / WHY CHOOSE US                                             -->
    <!-- ========================================================================= -->
    <section id="features" class="py-20 sm:py-28 relative">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Why {{ config('custom.title', 'BoostHub') }}</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                    Built for Serious Creators & Agencies
                </h2>
                <p class="text-base sm:text-lg text-gray-400">
                    We deliver the highest quality social growth services with enterprise reliability.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Feature 1 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-indigo-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">100% Real & Active Accounts</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Say goodbye to cheap bot traffic that gets wiped out. Our networks provide natural, active accounts that protect your account integrity.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-pink-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-pink-500/20 text-pink-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Zero Password Ever Needed</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Your account safety is paramount. We will never ask for your password, login credentials, or access tokens.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-amber-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-bolt-lightning"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Instant Automated Engine</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Orders are dispatched to our distributed servers within seconds. No waiting days for your campaign to start.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-emerald-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">30-Day Free Refills</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        We stand behind our quality. If your follower count experiences any drop within 30 days, we automatically refill it at zero charge.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-purple-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-shield-cat"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">256-Bit SSL Confidentiality</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Your identity and transactions are encrypted with bank-grade 256-bit SSL encryption. We never share customer data with third parties.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="p-8 rounded-3xl bg-white/[0.03] border border-white/10 hover:border-cyan-500/40 transition-colors space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">24/7 Dedicated Support</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Our expert support engineers are available 24/7 via live tickets and email to assist you with inquiries, custom limits, or bulk orders.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- INTERACTIVE FAQ ACCORDION                                                 -->
    <!-- ========================================================================= -->
    <section id="faq" class="py-20 sm:py-28 bg-white/[0.01] border-y border-white/5 relative"
             x-data="{ active: null }">
        <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="text-center space-y-4 mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Got Questions?</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                    Frequently Asked Questions
                </h2>
                <p class="text-base sm:text-lg text-gray-400">
                    Everything you need to know about our services and delivery.
                </p>
            </div>

            <div class="space-y-4">

                <!-- FAQ Item 1 -->
                <div class="rounded-2xl bg-white/[0.03] border border-white/10 overflow-hidden transition-all">
                    <button @click="active = active === 1 ? null : 1"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white hover:text-indigo-400 transition-colors">
                        <span class="text-base sm:text-lg">Is it safe to use {{ config('custom.title', 'BoostHub') }} on my accounts?</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                           :class="{ 'rotate-180 text-indigo-400': active === 1 }"></i>
                    </button>
                    <div x-show="active === 1"
                         x-collapse
                         x-cloak
                         class="px-6 pb-6 text-sm text-gray-400 leading-relaxed border-t border-white/5 pt-4">
                        Yes, 100% safe. We deliver engagement through natural, organic pacing that strictly complies with each platform's API rate limits and guidelines. We have served millions of orders since 2017 with zero account penalties.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="rounded-2xl bg-white/[0.03] border border-white/10 overflow-hidden transition-all">
                    <button @click="active = active === 2 ? null : 2"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white hover:text-indigo-400 transition-colors">
                        <span class="text-base sm:text-lg">Do you need my account password?</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                           :class="{ 'rotate-180 text-indigo-400': active === 2 }"></i>
                    </button>
                    <div x-show="active === 2"
                         x-collapse
                         x-cloak
                         class="px-6 pb-6 text-sm text-gray-400 leading-relaxed border-t border-white/5 pt-4">
                        Never! We will NEVER ask for your password or account credentials. All we need is your public account username or post URL. Please keep your profile public while your order is processing.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="rounded-2xl bg-white/[0.03] border border-white/10 overflow-hidden transition-all">
                    <button @click="active = active === 3 ? null : 3"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white hover:text-indigo-400 transition-colors">
                        <span class="text-base sm:text-lg">How quickly will my order begin?</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                           :class="{ 'rotate-180 text-indigo-400': active === 3 }"></i>
                    </button>
                    <div x-show="active === 3"
                         x-collapse
                         x-cloak
                         class="px-6 pb-6 text-sm text-gray-400 leading-relaxed border-t border-white/5 pt-4">
                        Most orders begin within 30 to 120 seconds of payment confirmation. Depending on the size of your package, delivery will stream naturally to simulate realistic organic viral momentum.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="rounded-2xl bg-white/[0.03] border border-white/10 overflow-hidden transition-all">
                    <button @click="active = active === 4 ? null : 4"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white hover:text-indigo-400 transition-colors">
                        <span class="text-base sm:text-lg">What if my followers drop over time?</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                           :class="{ 'rotate-180 text-indigo-400': active === 4 }"></i>
                    </button>
                    <div x-show="active === 4"
                         x-collapse
                         x-cloak
                         class="px-6 pb-6 text-sm text-gray-400 leading-relaxed border-t border-white/5 pt-4">
                        We offer a complimentary 30-Day Refill Guarantee on all eligible packages. If you notice any drop within 30 days of purchase, contact our support team or trigger an automated refill for instant restock.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="rounded-2xl bg-white/[0.03] border border-white/10 overflow-hidden transition-all">
                    <button @click="active = active === 5 ? null : 5"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-white hover:text-indigo-400 transition-colors">
                        <span class="text-base sm:text-lg">Can I order multiple services for different links?</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                           :class="{ 'rotate-180 text-indigo-400': active === 5 }"></i>
                    </button>
                    <div x-show="active === 5"
                         x-collapse
                         x-cloak
                         class="px-6 pb-6 text-sm text-gray-400 leading-relaxed border-t border-white/5 pt-4">
                        Yes! You can place orders for as many accounts or posts as you like. Each order is processed individually with its own dedicated tracking ID.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- FINAL CALL TO ACTION BANNER                                               -->
    <!-- ========================================================================= -->
    <section class="py-20 sm:py-28 relative overflow-hidden">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative rounded-3xl p-8 sm:p-16 overflow-hidden bg-gradient-to-r from-indigo-900/60 via-purple-900/40 to-pink-900/50 border border-white/15 backdrop-blur-xl text-center space-y-8 shadow-2xl">

                <div class="absolute -top-24 -right-24 w-96 h-96 bg-pink-500/20 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 max-w-3xl mx-auto space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-300">Ready to Go Viral?</span>
                    <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                        Start Growing Your Social Influence Today
                    </h2>
                    <p class="text-base sm:text-lg text-gray-300 leading-relaxed">
                        Join over 1,400,000 creators, artists, and brands that rely on {{ config('custom.title', 'BoostHub') }} for high-velocity social growth.
                    </p>
                </div>

                <div class="relative z-10 flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a href="{{ route('home') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-10 py-4 text-base font-bold text-white transition-all duration-200 rounded-2xl shadow-xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-400 hover:via-purple-400 hover:to-pink-400 shadow-indigo-500/30 hover:scale-[1.03] active:scale-[0.98]">
                        <span>Launch Your Boost Now</span>
                        <i class="fa-solid fa-bolt text-sm"></i>
                    </a>

                    <a href="{{ route('login') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-gray-300 transition-all duration-200 rounded-2xl bg-white/10 border border-white/15 hover:text-white hover:bg-white/20">
                        <span>Sign In</span>
                    </a>
                </div>

                <div class="relative z-10 flex flex-wrap items-center justify-center gap-6 text-xs text-gray-300 pt-4">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-400"></i> No Subscription Needed</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-400"></i> Instant Automated Start</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-400"></i> 100% Money-Back Guarantee</span>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>
