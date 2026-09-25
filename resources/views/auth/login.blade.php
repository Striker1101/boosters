<x-guest-layout>
    <div class="p-8 border rounded-2xl bg-slate-900 border-white/10">
        <h1 class="text-xl font-bold text-white">Sign in</h1>
        <p class="mt-1 text-sm text-slate-400">Staff access only.</p>

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label class="block mb-1.5 text-xs font-bold tracking-widest text-slate-400 uppercase" for="email">
                    Email
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class="w-full px-4 py-3 text-sm text-white border rounded-xl bg-slate-950 border-white/10 focus:border-indigo-500 focus:ring-0">
            </div>

            <div>
                <label class="block mb-1.5 text-xs font-bold tracking-widest text-slate-400 uppercase" for="password">
                    Password
                </label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 text-sm text-white border rounded-xl bg-slate-950 border-white/10 focus:border-indigo-500 focus:ring-0">
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center gap-2 text-sm text-slate-400">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="text-indigo-600 bg-slate-950 border-white/20 rounded focus:ring-0">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-300 hover:text-indigo-200">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full py-3 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition">
                Sign in
            </button>
        </form>

        <p class="mt-6 text-xs text-center text-slate-600">
            Accounts are created by a super admin. There is no public sign-up.
        </p>
    </div>
</x-guest-layout>
