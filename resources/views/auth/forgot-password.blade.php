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
                    Forgot Password?
                </h2>
                <p class="text-sm text-gray-400">
                    No worries, we'll help you reset it
                </p>
            </div>

            <!-- Reset Password Card -->
            <div class="reset-card">
                <!-- Info Message -->
                <div class="mb-6 info-box">
                    <div class="flex items-start gap-3">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                                <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-300">
                            {{ __('Enter your email address and we\'ll send you a password reset link that will allow you to choose a new one.') }}
                        </p>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 success-message" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email Address')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 4h14a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <path d="m2 5 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <x-text-input id="email" class="pl-12 custom-input" type="email" name="email"
                                :value="old('email')" required autofocus placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="reset-button group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ __('Send Reset Link') }}
                            </span>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="back-link group">
                            <svg class="w-4 h-4 transition-transform transform group-hover:-translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>{{ __('Back to login') }}</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Help Section -->
            <div class="help-section">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Need help? <a href="#" class="font-medium text-indigo-400 hover:text-indigo-300">Contact
                            support</a></span>
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
                    <span>Secured by 256-bit SSL encryption</span>
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

        /* Reset Card */
        .reset-card {
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
            border-radius: 0.75rem;
            padding: 1rem;
            color: #4ade80;
            font-size: 0.875rem;
        }

        /* Form Labels */
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #e5e7eb;
            margin-bottom: 0.5rem;
        }

        /* Custom Input */
        .custom-input {
            width: 100%;
            padding: 0.875rem 1rem;
            padding-left: 3rem;
            background: rgba(17, 24, 39, 0.5);
            border: 1px solid rgba(75, 85, 99, 0.5);
            border-radius: 0.75rem;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            outline: none;
            background: rgba(17, 24, 39, 0.8);
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .custom-input::placeholder {
            color: #6b7280;
        }

        /* Input Icon */
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
            z-index: 10;
        }

        /* Reset Button */
        .reset-button {
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

        .reset-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .reset-button:hover::before {
            left: 100%;
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .reset-button:active {
            transform: translateY(0);
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #9ca3af;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #6366f1;
        }

        /* Help Section */
        .help-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(75, 85, 99, 0.3);
        }

        /* Form Group Spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .reset-card {
                padding: 1.5rem;
            }

            .info-box {
                padding: 0.875rem;
            }
        }
    </style>
</x-guest-layout>
