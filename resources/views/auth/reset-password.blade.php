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
                    Reset Password
                </h2>
                <p class="text-sm text-gray-400">
                    Create a new secure password for your account
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
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-300">
                            Choose a strong password with at least 8 characters, including letters and numbers.
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                :value="old('email', $request->email)" required autofocus autocomplete="username"
                                placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('New Password')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="9" width="14" height="9" rx="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M6 9V6a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                    <circle cx="10" cy="13" r="1.5" fill="currentColor" />
                                </svg>
                            </div>
                            <x-text-input id="password" class="pl-12 custom-input" type="password" name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex gap-1">
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                                <div class="strength-bar"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1.5">Must be at least 8 characters</p>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="form-label" />
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

                    <!-- Security Tips -->
                    <div class="security-tips">
                        <p class="mb-2 text-xs font-semibold text-gray-400">Password Security Tips:</p>
                        <ul class="space-y-1">
                            <li class="flex items-start gap-2 text-xs text-gray-500">
                                <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Use a mix of uppercase and lowercase letters</span>
                            </li>
                            <li class="flex items-start gap-2 text-xs text-gray-500">
                                <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Include numbers and special characters</span>
                            </li>
                            <li class="flex items-start gap-2 text-xs text-gray-500">
                                <svg class="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Avoid common words and personal information</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Reset Button -->
                    <div>
                        <button type="submit" class="reset-button group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                {{ __('Reset Password') }}
                                <svg class="w-5 h-5 transition-transform transform group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
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

        /* Security Tips */
        .security-tips {
            background: rgba(34, 197, 94, 0.05);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 0.75rem;
            padding: 1rem;
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

        /* Password Strength Indicator */
        .strength-bar {
            flex: 1;
            height: 4px;
            background: rgba(75, 85, 99, 0.3);
            border-radius: 2px;
            transition: all 0.3s ease;
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

        /* Form Group Spacing */
        .form-group {
            margin-bottom: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .reset-card {
                padding: 1.5rem;
            }

            .info-box {
                padding: 0.875rem;
            }

            .security-tips {
                padding: 0.875rem;
            }
        }

        /* Simple password strength indicator animation on input focus */
        .custom-input[type="password"]:focus~.strength-bar:nth-child(1) {
            background: #ef4444;
        }

        .custom-input[type="password"]:valid~.strength-bar:nth-child(1) {
            background: #22c55e;
        }
    </style>

    <script>
        // Password strength indicator
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBars = document.querySelectorAll('.strength-bar');

            if (passwordInput && strengthBars.length > 0) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strength = calculatePasswordStrength(password);

                    // Reset all bars
                    strengthBars.forEach(bar => {
                        bar.style.background = 'rgba(75, 85, 99, 0.3)';
                    });

                    // Fill bars based on strength
                    const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
                    for (let i = 0; i < strength; i++) {
                        strengthBars[i].style.background = colors[strength - 1];
                    }
                });
            }

            function calculatePasswordStrength(password) {
                let strength = 0;

                if (password.length >= 8) strength++;
                if (password.length >= 12) strength++;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                if (/\d/.test(password) && /[^a-zA-Z\d]/.test(password)) strength++;

                return Math.min(strength, 4);
            }
        });
    </script>
</x-guest-layout>
