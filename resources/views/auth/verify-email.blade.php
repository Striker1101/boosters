<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0a0a0a] to-[#1a1a2e] py-12 px-4 sm:px-6 lg:px-8">
        <!-- Animated Background Particles -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none particles-bg">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="relative z-10 w-full max-w-md space-y-8">
            <!-- Logo and Header -->
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <div class="flex justify-center mb-6">
                        <div class="logo-container">
                            <img src="{{ asset('logo.svg') }}" alt="logo" width="64" height="64">
                        </div>
                    </div>

                </a>
                <h2 class="mb-2 text-4xl font-bold gradient-text">
                    Verify Your Email
                </h2>
                <p class="text-sm text-gray-400">
                    One more step to get started
                </p>
            </div>

            <!-- Verification Card -->
            <div class="verify-card">
                <!-- Email Icon Illustration -->
                <div class="email-illustration">
                    <svg width="120" height="120" viewBox="0 0 120 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="60" cy="60" r="50" fill="url(#email-gradient)" opacity="0.2" />
                        <rect x="30" y="40" width="60" height="40" rx="4" stroke="url(#email-gradient)"
                            stroke-width="3" fill="none" />
                        <path d="M30 45L60 65L90 45" stroke="url(#email-gradient)" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="75" cy="50" r="8" fill="#22c55e" />
                        <path d="M72 50L74 52L78 48" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <defs>
                            <linearGradient id="email-gradient" x1="30" y1="40" x2="90"
                                y2="80" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#6366f1" />
                                <stop offset="1" stop-color="#ec4899" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <!-- Info Message -->
                <div class="mb-6 info-box">
                    <div class="flex items-start gap-3">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-300">
                            {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you. If you didn\'t receive the email, we\'ll gladly send you another.') }}
                        </p>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 success-message">
                        <div class="flex items-start gap-3">
                            <div class="success-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M8 12l2 2 4-4" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="text-sm leading-relaxed text-green-400">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Resend Button -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="verify-button group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                {{ __('Resend Verification Email') }}
                            </span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>
                </div>

                <!-- Help Section -->
                <div class="mt-6 help-box">
                    <p class="mb-2 text-xs text-center text-gray-500">
                        Didn't receive the email?
                    </p>
                    <ul class="space-y-1 text-xs text-gray-500">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Check your spam or junk folder</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Make sure the email address is correct</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Wait a few minutes and try again</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Support Link -->
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Need help? <a href="#"
                            class="font-medium text-indigo-400 hover:text-indigo-300">Contact support</a></span>
                </div>
            </div>

            <!-- Security Badge -->
            <div class="mt-6 text-center">
                <div class="inline-flex items-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Your account is secure</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animated Background Particles */
        .particles-bg .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #6366f1;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite;
        }

        .particles-bg .particle:nth-child(1) {
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .particles-bg .particle:nth-child(2) {
            left: 80%;
            top: 30%;
            animation-delay: 2s;
        }

        .particles-bg .particle:nth-child(3) {
            left: 30%;
            top: 70%;
            animation-delay: 4s;
        }

        .particles-bg .particle:nth-child(4) {
            left: 70%;
            top: 60%;
            animation-delay: 6s;
        }

        .particles-bg .particle:nth-child(5) {
            left: 50%;
            top: 10%;
            animation-delay: 1s;
        }

        .particles-bg .particle:nth-child(6) {
            left: 20%;
            top: 80%;
            animation-delay: 3s;
        }

        .particles-bg .particle:nth-child(7) {
            left: 90%;
            top: 50%;
            animation-delay: 5s;
        }

        .particles-bg .particle:nth-child(8) {
            left: 40%;
            top: 40%;
            animation-delay: 7s;
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

        /* Logo Animation */
        .logo-icon {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                filter: drop-shadow(0 0 10px rgba(99, 102, 241, 0.5));
            }

            50% {
                transform: scale(1.05);
                filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.8));
            }
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #ec4899 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Verify Card */
        .verify-card {
            background: rgba(26, 26, 26, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Email Illustration */
        .email-illustration {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            animation: bounce 3s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Info Box */
        .info-box {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 1rem;
            padding: 1rem;
        }

        .info-icon {
            color: #6366f1;
            flex-shrink: 0;
        }

        /* Success Message */
        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 1rem;
            padding: 1rem;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .success-icon {
            color: #22c55e;
            flex-shrink: 0;
        }

        /* Verify Button */
        .verify-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .verify-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .verify-button:hover::before {
            left: 100%;
        }

        .verify-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .verify-button:active {
            transform: translateY(0);
        }

        /* Logout Button */
        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            color: #e5e7eb;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Help Box */
        .help-box {
            background: rgba(75, 85, 99, 0.1);
            border: 1px solid rgba(75, 85, 99, 0.3);
            border-radius: 0.75rem;
            padding: 1rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .verify-card {
                padding: 1.5rem;
            }

            .info-box,
            .success-message,
            .help-box {
                padding: 0.875rem;
            }

            .email-illustration svg {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</x-guest-layout>
