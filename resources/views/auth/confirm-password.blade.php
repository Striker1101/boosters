<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0a0a0a] to-[#1a1a2e] py-12 px-4 sm:px-6 lg:px-8">
        <div class="fixed inset-0 overflow-hidden pointer-events-none particles-bg">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="relative z-10 w-full max-w-md space-y-8">
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <div class="flex justify-center mb-6">
                        <div class="logo-container">
                            <img src="{{ asset('logo.svg') }}" alt="logo" width="64" height="64"
                                class="logo-icon">
                        </div>
                    </div>
                </a>
                <h2 class="mb-2 text-4xl font-bold gradient-text">
                    Security Check
                </h2>
                <p class="px-4 text-sm text-gray-400">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>

            <div class="reset-card">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" class="form-label" />
                        <div class="relative mt-2">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <x-text-input id="password" class="pl-12 custom-input" type="password" name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <div>
                        <button type="submit" class="reset-button group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                {{ __('Confirm Password') }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-4 text-center">
                <a href="javascript:history.back()" class="back-link group">
                    <span>{{ __('Go back') }}</span>
                </a>
            </div>
        </div>
    </div>

    <style>
        /* [Keep your existing CSS here to maintain consistency] */
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

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #ec4899 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

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

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #e5e7eb;
            margin-bottom: 0.5rem;
        }

        .custom-input {
            width: 100%;
            padding: 0.875rem 1rem;
            padding-left: 3rem;
            background: rgba(17, 24, 39, 0.5);
            border: 1px solid rgba(75, 85, 99, 0.5);
            border-radius: 0.75rem;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
            z-index: 10;
        }

        .reset-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0
