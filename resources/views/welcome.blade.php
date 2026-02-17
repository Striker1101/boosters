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
        <!-- Animated Background -->
        <div class="particles" id="particles"></div>

        <!-- Hero Section -->
        <section class="hero">
            <h1>
                Supercharge Your<br>
                <span class="gradient-text">Social Media Growth</span>
            </h1>
            <p>
                {{ config('custom.title') }} your followers, engagement, and reach across all major platforms.
                Authentic growth powered by advanced targeting and real users.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary btn-large">Start Boosting Now</a>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-large">See How It Works</a>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="stat-card">
                <div class="stat-number">2M+</div>
                <div class="stat-label">Active Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">500K+</div>
                <div class="stat-label">Campaigns Delivered</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Available</div>
            </div>
        </section>

        <!-- Social Platforms -->
        <div class="social-platforms">
            <!-- Facebook -->
            <div class="platform-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 0C10.7 0 0 10.7 0 24s10.7 24 24 24 24-10.7 24-24S37.3 0 24 0z" fill="#1877F2" />
                    <path
                        d="M33.5 15.4h-4.2c-.5 0-.9.4-.9.9v3.1h5.1l-.8 5.3h-4.3v13.2h-5.5V24.7h-3.7v-5.3h3.7v-3.7c0-3.6 2.2-5.6 5.4-5.6h4.2v5.3z"
                        fill="white" />
                </svg>
            </div>
            <!-- Instagram -->
            <div class="platform-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="ig-gradient" x1="0%" y1="100%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#FED373;stop-opacity:1" />
                            <stop offset="25%" style="stop-color:#F15245;stop-opacity:1" />
                            <stop offset="50%" style="stop-color:#D92E7F;stop-opacity:1" />
                            <stop offset="75%" style="stop-color:#9B36B7;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#515ECF;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <rect width="48" height="48" rx="12" fill="url(#ig-gradient)" />
                    <rect x="12" y="12" width="24" height="24" rx="5" stroke="white" stroke-width="3"
                        fill="none" />
                    <circle cx="24" cy="24" r="6" stroke="white" stroke-width="3" fill="none" />
                    <circle cx="32" cy="16" r="2" fill="white" />
                </svg>
            </div>
            <!-- Twitter/X -->
            <div class="platform-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" rx="12" fill="#000000" />
                    <path
                        d="M28.5 14h4.5l-9.8 11.2L35 34h-9l-7-9.2L11 34H6.5l10.5-12L7 14h9.2l6.3 8.3L28.5 14zm-1.6 18h2.5L15.5 16.5h-2.7L26.9 32z"
                        fill="white" />
                </svg>
            </div>
            <!-- TikTok -->
            <div class="platform-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" rx="12" fill="#000000" />
                    <path
                        d="M32.2 15.3c-1.8-1.2-3-3.3-3-5.6h-4.7v21.6c0 2.6-2.1 4.7-4.7 4.7s-4.7-2.1-4.7-4.7 2.1-4.7 4.7-4.7c.5 0 1 .1 1.4.2v-4.8c-.5-.1-.9-.1-1.4-.1-5.2 0-9.5 4.2-9.5 9.5s4.2 9.5 9.5 9.5 9.5-4.2 9.5-9.5V17.6c1.9 1.4 4.3 2.2 6.9 2.2v-4.7c-1.4 0-2.7-.5-3.9-1.3l-.1.5z"
                        fill="white" />
                    <path
                        d="M32.2 15.3c-1.8-1.2-3-3.3-3-5.6h-4.7v21.6c0 2.6-2.1 4.7-4.7 4.7s-4.7-2.1-4.7-4.7 2.1-4.7 4.7-4.7c.5 0 1 .1 1.4.2v-4.8c-.5-.1-.9-.1-1.4-.1-5.2 0-9.5 4.2-9.5 9.5s4.2 9.5 9.5 9.5 9.5-4.2 9.5-9.5V17.6c1.9 1.4 4.3 2.2 6.9 2.2v-4.7c-1.4 0-2.7-.5-3.9-1.3l-.1.5z"
                        fill="#EE1D52" opacity="0.9" />
                    <path
                        d="M32.2 15.3c-1.8-1.2-3-3.3-3-5.6h-4.7v21.6c0 2.6-2.1 4.7-4.7 4.7s-4.7-2.1-4.7-4.7 2.1-4.7 4.7-4.7c.5 0 1 .1 1.4.2v-4.8c-.5-.1-.9-.1-1.4-.1-5.2 0-9.5 4.2-9.5 9.5s4.2 9.5 9.5 9.5 9.5-4.2 9.5-9.5V17.6c1.9 1.4 4.3 2.2 6.9 2.2v-4.7c-1.4 0-2.7-.5-3.9-1.3l-.1.5z"
                        fill="#69C9D0" opacity="0.8" />
                </svg>
            </div>
            <!-- YouTube -->
            <div class="platform-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" rx="12" fill="#FF0000" />
                    <path
                        d="M38.3 17.4c-.3-1.2-1.2-2.1-2.4-2.4C33.8 14.5 24 14.5 24 14.5s-9.8 0-11.9.5c-1.2.3-2.1 1.2-2.4 2.4-.5 2.1-.5 6.6-.5 6.6s0 4.5.5 6.6c.3 1.2 1.2 2.1 2.4 2.4 2.1.5 11.9.5 11.9.5s9.8 0 11.9-.5c1.2-.3 2.1-1.2 2.4-2.4.5-2.1.5-6.6.5-6.6s0-4.5-.5-6.6z"
                        fill="white" />
                    <path d="M21.5 28.5V19.5l8 4.5-8 4.5z" fill="#FF0000" />
                </svg>
            </div>
        </div>

        <!-- Features Section -->
        <section class="features">
            <h2 class="section-title">Why Choose {{ config('custom.title') }}?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature1-gradient)"
                            opacity="0.2" />
                        <path d="M30 10L40 25H20L30 10Z" fill="url(#feature1-gradient)" />
                        <rect x="20" y="25" width="20" height="20" rx="2"
                            fill="url(#feature1-gradient)" />
                        <circle cx="30" cy="35" r="5" fill="white" />
                        <defs>
                            <linearGradient id="feature1-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#6366f1" />
                                <stop offset="1" stop-color="#ec4899" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Real Growth</h3>
                    <p>Get genuine followers and engagement from real users interested in your content. No bots, no fake
                        accounts.</p>
                </div>

                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature2-gradient)"
                            opacity="0.2" />
                        <path d="M20 25L30 15L40 25M30 15V45" stroke="url(#feature2-gradient)" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <defs>
                            <linearGradient id="feature2-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ec4899" />
                                <stop offset="1" stop-color="#f59e0b" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Fast Results</h3>
                    <p>See visible growth within 24-48 hours. Our advanced algorithms ensure quick and efficient
                        campaign
                        delivery.</p>
                </div>

                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature3-gradient)"
                            opacity="0.2" />
                        <path d="M15 30L25 40L45 20" stroke="url(#feature3-gradient)" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <defs>
                            <linearGradient id="feature3-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#f59e0b" />
                                <stop offset="1" stop-color="#6366f1" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Safe & Secure</h3>
                    <p>100% compliant with platform guidelines. Your account security is our top priority with encrypted
                        data protection.</p>
                </div>

                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature4-gradient)"
                            opacity="0.2" />
                        <circle cx="30" cy="25" r="8" stroke="url(#feature4-gradient)"
                            stroke-width="3" fill="none" />
                        <path d="M18 45C18 38 23 33 30 33C37 33 42 38 42 45" stroke="url(#feature4-gradient)"
                            stroke-width="3" stroke-linecap="round" />
                        <defs>
                            <linearGradient id="feature4-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#6366f1" />
                                <stop offset="1" stop-color="#ec4899" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Target Audience</h3>
                    <p>Reach the right people with precise demographic and interest-based targeting across all
                        platforms.
                    </p>
                </div>

                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature5-gradient)"
                            opacity="0.2" />
                        <rect x="15" y="20" width="30" height="20" rx="3"
                            stroke="url(#feature5-gradient)" stroke-width="3" fill="none" />
                        <path d="M15 27H45M21 20V40M39 20V40" stroke="url(#feature5-gradient)" stroke-width="3" />
                        <defs>
                            <linearGradient id="feature5-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ec4899" />
                                <stop offset="1" stop-color="#f59e0b" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Analytics Dashboard</h3>
                    <p>Track your growth in real-time with comprehensive analytics and detailed performance metrics.</p>
                </div>

                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="url(#feature6-gradient)"
                            opacity="0.2" />
                        <path
                            d="M25 30L28 33L35 26M30 10C18.95 10 10 18.95 10 30s8.95 20 20 20 20-8.95 20-20S41.05 10 30 10z"
                            stroke="url(#feature6-gradient)" stroke-width="3" fill="none" />
                        <defs>
                            <linearGradient id="feature6-gradient" x1="10" y1="10" x2="50"
                                y2="50" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#f59e0b" />
                                <stop offset="1" stop-color="#6366f1" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3>Money-Back Guarantee</h3>
                    <p>Not satisfied? Get a full refund within 30 days. We stand behind the quality of our service.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <h2>Ready to Go Viral?</h2>
            <p>Join thousands of influencers and businesses growing their social media presence</p>
            <a href="#" class="btn btn-primary btn-large">Start Your Free Trial</a>
        </section>
{{--
        <!-- Footer -->
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
</footer> --}}

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
    </body>

    </html>


</x-guest-layout>
