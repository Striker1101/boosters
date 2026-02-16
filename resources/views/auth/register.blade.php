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
                <a href={{ route('home') }}>
                    <div class="flex justify-center mb-6">
                        <div class="logo-container">
                            <img src="{{ asset('logo.svg') }}" alt="logo" width="64" height="64">
                        </div>
                    </div>
                </a>
                <h2 class="mb-2 text-4xl font-bold gradient-text">
                    Create Account
                </h2>
                <p class="text-sm text-gray-400">
                    Start boosting your social media today
                </p>
            </div>

            <!-- Register Form Card -->
            <div class="register-card">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Full Name')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10" cy="6" r="4" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M3 18c0-3.9 3.1-7 7-7s7 3.1 7 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <x-text-input id="name" class="pl-12 custom-input" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
                    </div>

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
                                :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- referral_id -->
                    <div class="form-group">
                        <x-input-label for="referral_id" :value="__('Referral ID')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10" cy="6" r="4" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M3 18c0-3.9 3.1-7 7-7s7 3.1 7 7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <x-text-input id="referral_id" class="pl-12 custom-input" type="text" name="referral_id"
                                :value="old('referral_id')" required autofocus autocomplete="referral_id"
                                placeholder="0000-1111" />
                        </div>
                        <x-input-error :messages="$errors->get('referral_id')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="9" width="14" height="9" rx="2"
                                        stroke="currentColor" stroke-width="2" />
                                    <path d="M6 9V6a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                    <circle cx="10" cy="13" r="1.5" fill="currentColor" />
                                </svg>
                            </div>
                            <x-text-input id="password" class="pl-12 custom-input" type="password" name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                        <p class="mt-1.5 text-xs text-gray-500">Must be at least 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 10l3 3 7-7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <rect x="3" y="9" width="14" height="9" rx="2"
                                        stroke="currentColor" stroke-width="2" />
                                    <path d="M6 9V6a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation" class="pl-12 custom-input" type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="terms-box">
                        <label for="terms" class="inline-flex items-start cursor-pointer group">
                            <input id="terms" type="checkbox"
                                class="custom-checkbox rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 focus:ring-offset-gray-800 mt-0.5"
                                required>
                            <span class="text-sm text-gray-400 transition-colors ms-2 group-hover:text-gray-300">
                                I agree to the
                                <a href="#" class="font-medium text-indigo-400 hover:text-indigo-300">Terms of
                                    Service</a>
                                and
                                <a href="#" class="font-medium text-indigo-400 hover:text-indigo-300">Privacy
                                    Policy</a>
                            </span>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <div>
                        <button type="submit" class="register-button group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                {{ __('Create Account') }}
                                <svg class="w-5 h-5 transition-transform transform group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </button>
                    </div>

                    <!-- Divider -->
                    {{-- <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-[#1a1a1a] text-gray-500">Or sign up with</span>
                        </div>
                    </div> --}}

                    <!-- Social Register Buttons -->
                    {{-- <div class="grid grid-cols-2 gap-3">
                        <button type="button" class="social-btn">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span>Google</span>
                        </button>
                        <button type="button" class="social-btn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            <span>GitHub</span>
                        </button>
                    </div> --}}

                    <!-- Login Link -->
                    <div class="pt-4 text-center">
                        <p class="text-sm text-gray-400">
                            Already have an account?
                            <a href="{{ route('login') }}"
                                class="font-medium text-indigo-400 transition-colors hover:text-indigo-300">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Security Badge -->
            <div class="mt-6 text-center">
                <div class="inline-flex items-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Your data is safe and encrypted</span>
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

        /* Register Card */
        .register-card {
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

        /* Custom Checkbox */
        .custom-checkbox {
            width: 1.125rem;
            height: 1.125rem;
            cursor: pointer;
        }

        /* Terms Box */
        .terms-box {
            padding: 1rem;
            background: rgba(99, 102, 241, 0.05);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 0.75rem;
        }

        /* Register Button */
        .register-button {
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

        .register-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .register-button:hover::before {
            left: 100%;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .register-button:active {
            transform: translateY(0);
        }

        /* Social Login Buttons */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            color: #e5e7eb;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Form Group Spacing */
        .form-group {
            margin-bottom: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .register-card {
                padding: 1.5rem;
            }

            .terms-box {
                padding: 0.875rem;
            }
        }
    </style>
</x-guest-layout>
