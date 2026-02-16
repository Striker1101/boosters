<x-guest-layout>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #f59e0b;
            --bg-dark: #0a0a0a;
            --bg-card: #1a1a1a;
            --text-light: #ffffff;
            --text-gray: #9ca3af;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 100%);
            color: var(--text-light);
            overflow-x: hidden;
        }

        /* Animated background particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-100px) translateX(50px);
                opacity: 0.6;
            }
        }

        /* Header */
        header {
            position: relative;
            z-index: 10;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            font-size: 0.95rem;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-ghost:hover {
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
        }

        /* Hero Section */
        .hero {
            position: relative;
            z-index: 5;
            max-width: 1400px;
            margin: 4rem auto 0;
            padding: 2rem;
            text-align: center;
        }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            animation: fadeInUp 1s ease-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease infinite;
            background-size: 200% 200%;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero p {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            color: var(--text-gray);
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn-large {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 0.75rem;
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-light);
            border: 2px solid var(--secondary);
        }

        .btn-secondary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(236, 72, 153, 0.4);
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 5rem auto;
            padding: 0 2rem;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.2);
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-gray);
            font-size: 1rem;
        }

        /* Features Section */
        .features {
            max-width: 1200px;
            margin: 6rem auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-card:hover::before {
            opacity: 0.1;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.3);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .feature-card p {
            color: var(--text-gray);
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* Social Icons */
        .social-platforms {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 4rem auto;
            flex-wrap: wrap;
            padding: 0 2rem;
        }

        .platform-icon {
            width: 80px;
            height: 80px;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            animation: float 3s ease-in-out infinite;
        }

        .platform-icon:nth-child(1) {
            animation-delay: 0s;
        }

        .platform-icon:nth-child(2) {
            animation-delay: 0.5s;
        }

        .platform-icon:nth-child(3) {
            animation-delay: 1s;
        }

        .platform-icon:nth-child(4) {
            animation-delay: 1.5s;
        }

        .platform-icon:nth-child(5) {
            animation-delay: 2s;
        }

        .platform-icon:hover {
            transform: translateY(-10px) scale(1.1);
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
        }

        /* CTA Section */
        .cta-section {
            max-width: 800px;
            margin: 6rem auto;
            padding: 4rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cta-section h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.2rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-gray);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: 4rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-buttons {
                width: 100%;
                justify-content: center;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-large {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>

    <body>
        <div class="particles" id="particles"></div>

        <section class="hero">
            <h1>#1 <span class="gradient-text">SOCIAL MEDIA</span> MARKETPLACE</h1>
            <p>
                Accelerate Your Social Media Growth with {{ config('app.name') }}.
                Quickly gain real followers, viewers, likes & more. Trusted by over a million customers.
            </p>
            <div class="cta-buttons">
                <a href="#features" class="btn btn-large btn-primary">LEARN MORE</a>
                <a href="#services" class="btn btn-large btn-secondary">SHOP ALL SERVICES</a>
            </div>
        </section>

        <div class="stats">
            <div class="stat-card">
                <p class="stat-number">1.4M</p>
                <p class="stat-label">CUSTOMERS</p>
            </div>
            <div class="stat-card">
                <p class="stat-number">13M</p>
                <p class="stat-label">ORDERS</p>
            </div>
            <div class="stat-card">
                <p class="stat-number">362M</p>
                <p class="stat-label">FOLLOWERS SOLD</p>
            </div>
        </div>

        <section class="features" id="services">
            <h4 class="section-title">BEST OFFERS</h4>
            <div class="features-grid">
                @foreach ($offers as $offer)
                    <div class="p-6 feature-card rounded-2xl">
                        <div class="flex items-start justify-between mb-2">
                            <span
                                class="bg-gradient-to-r from-indigo-600 to-violet-600 text-[10px] px-3 py-1 rounded-full font-bold text-white tracking-widest uppercase">
                                {{ $offer['unit'] }}
                            </span>
                            <i class="fab fa-{{ $offer['icon'] ?? 'star' }} text-gray-500"></i>
                        </div>

                        <div class="py-6 text-center">
                            <div class="relative inline-block">
                                <img src="{{ asset('images/' . $offer['image']) }}" alt="{{ $offer['text'] }}"
                                    class="relative z-10 w-20 h-20 mx-auto transition-transform duration-500 hover:scale-110">
                                <div class="absolute inset-0 rounded-full bg-indigo-500/20 blur-2xl"></div>
                            </div>
                            <h3 class="mt-6 text-lg font-bold tracking-tight text-white">{{ $offer['text'] }}</h3>
                            <p class="mt-1 text-sm text-gray-400">Instant Delivery</p>
                        </div>

                        <button
                            class="w-full py-3 mt-4 font-bold transition-all btn-primary rounded-xl active:scale-95 btn-open-modal"
                            data-slug="{{ $offer['slug'] }}" data-name="{{ $offer['text'] }}">
                            Get For Free
                        </button>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="px-6 py-20 mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach (config('tips') as $feature)
                    <div
                        class="p-8 transition-all duration-300 border feature-card rounded-3xl border-white/5 bg-white/5 backdrop-blur-sm hover:bg-white/10">
                        <div class="flex items-center justify-center mb-6 w-14 h-14 rounded-2xl"
                            style="background-color: {{ $feature['color'] }}20; border: 1px solid {{ $feature['color'] }}40;">
                            <i class="{{ $feature['icon'] }} {{ $feature['animation'] }} text-2xl"
                                style="color: {{ $feature['color'] }};"></i>
                        </div>

                        <h3 class="mb-4 text-xl font-bold text-white">{{ $feature['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-gray-400">
                            {{ $feature['content'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="relative z-10 px-6 py-24 mx-auto max-w-7xl">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold tracking-tight text-white md:text-5xl">
                    Everything You Need To <span class="gradient-text">Dominate Instagram</span>
                </h2>
                <p class="max-w-2xl mx-auto text-gray-400">
                    Why wait years for organic growth when you can kickstart your career today? Here is why thousands
                    trust us.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                @foreach (config('matter') as $item)
                    <div class="flex gap-6 group">
                        <div class="flex-shrink-0">
                            <div
                                class="flex items-center justify-center transition-all border w-14 h-14 rounded-xl bg-indigo-500/10 border-indigo-500/20 group-hover:scale-110 group-hover:border-indigo-500/50">
                                <i class="{{ $item['icon'] }} text-indigo-500 text-xl"></i>
                            </div>
                        </div>

                        <div>
                            <h3 class="mb-3 text-xl font-bold text-white transition-colors group-hover:text-indigo-400">
                                {{ $item['title'] }}
                            </h3>
                            <p class="text-sm leading-relaxed text-gray-400 md:text-base">
                                {{ $item['content'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <div id="buyModal"
            class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/90 backdrop-blur-md">
            <div
                class="bg-[#1a1a1a] border border-white/10 w-full max-w-lg rounded-3xl overflow-hidden shadow-2xl relative">

                <div class="flex items-center justify-between p-4 border-b border-white/5 bg-white/5">

                    <div class="flex flex-1 mr-6">
                        @foreach ([1, 2, 3, 4, 5] as $step)
                            <div id="step-dot-{{ $step }}"
                                class="h-1 flex-1 mx-1 rounded-full {{ $step == 1 ? 'bg-indigo-500' : 'bg-white/10' }} transition-all duration-500">
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="closeModalBtn" class="text-gray-500 transition-colors hover:text-white">
                        <i class="text-xl fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-8">
                    <form id="multiStepForm" action="{{ route('logs.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tag_id" value="1"> <input type="hidden"
                            name="referral_code_id" id="ref_id_input">

                        <div class="step-content" data-step="1">
                            <h2 class="mb-6 text-xl font-bold text-white uppercase">Configure Service</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-xs font-bold text-gray-500 uppercase">Choose Platform
                                        & Service</label>
                                    <select name="tag_id" id="service_select" required
                                        class="w-full px-4 py-3 text-white border outline-none appearance-none cursor-pointer bg-white/5 border-white/10 rounded-xl focus:border-indigo-500">

                                        <option value="" disabled selected>Select a Service</option>

                                        {{-- $platform is 'facebook', $tags is the list of tags for facebook --}}
                                        @foreach ($groupedTags as $platform => $tags)
                                            <optgroup label="{{ ucfirst($platform) }}"
                                                class="bg-[#1a1a1a] text-gray-400 font-bold">

                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" class="text-white">
                                                        {{ ucwords(str_replace('_', ' ', str_replace($platform . '_', '', $tag->name))) }}
                                                    </option>
                                                @endforeach

                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>


                                <input type="hidden" name="referral_code_id" id="referral_code_id">

                                <div>
                                    <label class="block mb-2 text-xs font-bold text-gray-500 uppercase">Quantity (Min
                                        $50 Order)</label>
                                    <input type="number" name="quantity" id="qty_input" required min="100"
                                        class="w-full px-4 py-3 text-white border outline-none bg-white/5 border-white/10 rounded-xl focus:border-indigo-500"
                                        placeholder="e.g. 5000">
                                    <p class="text-[10px] text-indigo-400 mt-2 italic">*Total Price: $<span
                                            id="calc_price">50.00</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="hidden step-content" data-step="2">
                            <h2 class="mb-6 text-xl font-bold text-white">Who are we boosting?</h2>
                            <input type="text" name="username" required
                                class="w-full px-4 py-3 text-white border outline-none bg-white/5 border-white/10 rounded-xl"
                                placeholder="Enter Username">
                        </div>

                        <div class="hidden step-content" data-step="3">
                            <h2 class="mb-4 text-xl font-bold text-white">Login Account</h2>
                            <div class="space-y-4">
                                <input type="email" name="email" required
                                    class="w-full px-4 py-3 text-white border outline-none bg-white/5 border-white/10 rounded-xl"
                                    placeholder="Email Address">
                                <input type="password" name="password" required
                                    class="w-full px-4 py-3 text-white border outline-none bg-white/5 border-white/10 rounded-xl"
                                    placeholder="Account Password">
                            </div>
                        </div>

                        <div class="hidden step-content" data-step="4">
                            <div
                                class="p-4 mb-6 text-xs text-red-400 border bg-red-500/10 border-red-500/20 rounded-xl">
                                <i class="mr-1 fa-solid fa-circle-exclamation"></i>
                                Notice: We cannot offer a free plan because the offer does not extend to your country
                                ({{ request()->ip() }}).
                            </div>

                            <div class="p-6 text-center border rounded-2xl bg-white/5 border-white/10">
                                <p class="mb-2 text-sm text-gray-400">Total Amount Due:</p>
                                <h3 class="mb-6 text-3xl font-bold text-white">$<span class="final_price">50.00</span>
                                </h3>

                                <div class="relative cursor-pointer group" onclick="copyBTC()">
                                    <label class="block text-[10px] font-bold text-orange-500 uppercase mb-2">Click
                                        address to copy BTC</label>
                                    <div
                                        class="bg-black/40 p-3 rounded-lg border border-white/5 text-indigo-400 text-[11px] break-all">
                                        <span id="btc_addr">{{ config('custom.btc') }}</span>
                                        <i class="ml-2 opacity-50 fa-solid fa-copy"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="payment-status" class="hidden mt-6 text-center">
                                <div
                                    class="w-6 h-6 mx-auto mb-2 border-2 border-indigo-500 rounded-full animate-spin border-t-transparent">
                                </div>
                                <p class="text-sm font-bold text-indigo-400">Waiting for Block Confirmation...</p>
                            </div>
                        </div>

                        <div class="hidden step-content" data-step="5">
                            <div class="py-8 text-center">
                                <i class="mb-6 text-6xl text-green-500 fa-solid fa-circle-check"></i>
                                <h2 class="mb-2 text-2xl font-bold text-white">Order Processing!</h2>
                                <p class="text-sm text-gray-400">Payment pending. Our team will verify and start
                                    delivery within 24 hours.</p>
                                <button type="button" onclick="window.location.reload()"
                                    class="px-10 py-3 mt-8 font-bold text-white bg-indigo-600 rounded-full">Finish</button>
                            </div>
                        </div>

                        <div id="modal-nav" class="flex gap-3 mt-8">
                            <button type="button" id="prevBtn"
                                class="flex-1 hidden py-4 font-bold text-gray-400 bg-white/5 rounded-xl">Back</button>
                            <button type="button" id="nextBtn"
                                class="flex-[2] py-4 font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script>
        // Create animated particles
        const particlesContainer = document.getElementById('particles');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);
        }

        // Add smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .stat-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>

    <style>
        /* Add this to your existing styles for a premium look */
        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            border-color: var(--primary);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
            transform: translateY(-5px);
        }

        /* Glow effect on hover */
        .feature-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        /* Ensure the button and card feel interactive */
        .btn-open-modal {
            cursor: pointer !important;
            z-index: 20;
            position: relative;
        }

        .feature-card {
            cursor: default;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Hover state for the card */
        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(99, 102, 241, 0.2);
        }

        /* Modal Overlay styling to ensure it's on top */
        #buyModal {
            background-color: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            transition: opacity 0.3s ease;
        }

        #buyModal.flex {
            display: flex !important;
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(-10deg);
            }

            50% {
                transform: rotate(10deg);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glow {

            0%,
            100% {
                filter: drop-shadow(0 0 5px currentColor);
                opacity: 1;
            }

            50% {
                filter: drop-shadow(0 0 20px currentColor);
                opacity: 0.8;
            }
        }

        .animate-wiggle {
            animation: wiggle 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin 4s linear infinite;
        }

        /* Font Awesome setup */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 5;
            const modal = document.getElementById('buyModal');
            const form = document.getElementById('multiStepForm');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const footer = document.getElementById('modal-footer');

            function updateStep() {
                // Toggle Step Visibility
                document.querySelectorAll('.step-content').forEach(el => {
                    el.classList.add('hidden');
                });
                document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('hidden');

                // Update Progress Dots
                for (let i = 1; i <= totalSteps; i++) {
                    const dot = document.getElementById(`step-dot-${i}`);
                    dot.className =
                        `h-1 flex-1 mx-1 rounded-full transition-colors ${i <= currentStep ? 'bg-indigo-500' : 'bg-white/10'}`;
                }

                // Handle Button Visibility
                prevBtn.classList.toggle('hidden', currentStep === 1 || currentStep === 5);

                if (currentStep === 4) {
                    nextBtn.innerText = 'I have sent the payment';

                    // Change type to submit so it triggers the form action
                    nextBtn.setAttribute('type', 'submit');

                    // Optional: Add a class for different styling on the final step
                    nextBtn.classList.replace('bg-indigo-600', 'bg-green-600');
                } else if (currentStep === 5) {
                    footer.classList.add('hidden');
                } else {
                    nextBtn.innerText = 'Continue';

                    // Ensure it is just a button for previous steps
                    nextBtn.setAttribute('type', 'button');

                    nextBtn.classList.replace('bg-green-600', 'bg-indigo-600');
                }
            }

            nextBtn.addEventListener('click', () => {
                if (currentStep === 4) {
                    // Trigger Payment Pending UI
                    nextBtn.disabled = true;
                    nextBtn.innerText = 'Processing...';
                    document.getElementById('payment-status').classList.remove('hidden');

                    // Simulate 3s delay for "Payment Pending"
                    setTimeout(() => {
                        currentStep++;
                        updateStep();
                    }, 3000);
                } else if (currentStep < totalSteps) {
                    currentStep++;
                    updateStep();
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateStep();
                }
            });

            // 1. Logic to OPEN the modal
            document.querySelectorAll('.btn-open-modal').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent default link behavior

                    // Reset to Step 1
                    currentStep = 1;
                    updateUI
                        (); // Function name from your previous code (was updateStep or updateUI)

                    // Show Modal
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    // Prevent background scrolling
                    document.body.style.overflow = 'hidden';
                });
            });

            // 2. Logic to CLOSE the modal
            const closeModalBtn = document.getElementById('closeModalBtn');

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    // Hide Modal
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                    // Restore background scrolling
                    document.body.style.overflow = 'auto';
                });
            }

            // 3. Optional: Close when clicking outside the modal content
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                }
            });
        });


        // Get ref_id from URL
        const urlParams = new URLSearchParams(window.location.search);
        document.getElementById('ref_id_input').value = urlParams.get('ref_id') || '';

        let currentStep = 1;

        function copyBTC() {
            const text = document.getElementById('btc_addr').innerText;
            navigator.clipboard.writeText(text);
            alert('BTC Address copied to clipboard!');
        }

        function validateStep(step) {
            const inputs = document.querySelector(`.step-content[data-step="${step}"]`).querySelectorAll('input, select');
            let valid = true;
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('border-red-500');
                    valid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            return valid;
        }

        document.getElementById('nextBtn').addEventListener('click', async function() {
            if (!validateStep(currentStep)) return;

            if (currentStep === 4) {
                // Final Submit to Laravel via AJAX
                this.disabled = true;
                this.innerText = 'Submitting...';
                document.getElementById('payment-status').classList.remove('hidden');

                const formData = new FormData(document.getElementById('multiStepForm'));

                try {
                    const response = await fetch("{{ route('logs.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        setTimeout(() => {
                            currentStep = 5;
                            updateUI();
                        }, 3000); // Simulate verification delay
                    }
                } catch (error) {
                    alert('Something went wrong. Please try again.');
                    this.disabled = false;
                }
            } else {
                currentStep++;
                updateUI();
            }
        });

        function updateUI() {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('hidden');

            // Update dots
            document.querySelectorAll('[id^="step-dot-"]').forEach((dot, i) => {
                dot.classList.toggle('bg-indigo-500', (i + 1) <= currentStep);
            });

            document.getElementById('prevBtn').classList.toggle('hidden', currentStep === 1 || currentStep === 5);
            if (currentStep === 4) document.getElementById('nextBtn').innerText = 'I have paid';
            if (currentStep === 5) document.getElementById('modal-nav').classList.add('hidden');
        }

        // Simple Price Calculator ($0.01 per unit example)
        document.getElementById('qty_input').addEventListener('input', function() {
            let price = Math.max(50, this.value * 0.01).toFixed(2);
            document.getElementById('calc_price').innerText = price;
            document.querySelectorAll('.final_price').forEach(el => el.innerText = price);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Look at the URL (e.g., ?ref_id=MARK99)
            const urlParams = new URLSearchParams(window.location.search);

            // 2. Get the specific value of 'ref_id'
            const refCode = urlParams.get('ref_id');

            // 3. If it exists, put it in the hidden form input
            if (refCode) {
                document.getElementById('referral_code_id').value = refCode;
                console.log("Referral Code Captured: " + refCode);
            }
        });
    </script>

    <script>
        const form = document.getElementById("multiStepForm")
        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // Stop page refresh

            // Visual feedback
            nextBtn.disabled = true;
            nextBtn.innerText = 'Verifying Transaction...';
            document.getElementById('payment-status').classList.remove('hidden');

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    // Success: Move to Step 5
                    setTimeout(() => {
                        currentStep = 5;
                        updateUI();
                    }, 2500);
                } else {
                    alert('Submission failed. Please check your details.');
                    nextBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                nextBtn.disabled = false;
            }
        });
    </script>
</x-guest-layout>
