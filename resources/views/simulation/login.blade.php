@php
    $query = array_filter([
        't' => $target?->token,
        'preview' => $preview ? 1 : null,
    ]);
    $action = route('simulation.submit', ['campaign' => $campaign->slug] + $query);
@endphp

{{--
    Simulated sign-in form.

    Note what the credential inputs do NOT have: a `name` attribute. The browser
    therefore never includes their values in the POST body, so a password typed
    here never leaves this device. All the server receives is the boolean
    `password_entered` flag, which is set locally as the person types.
--}}
<x-simulation-layout :title="$lure['headline']" :accent="$lure['accent']" :preview="$preview">
    <div class="w-full max-w-md" x-data="{ typed: false, pw: '' }">
        <div class="p-8 border rounded-3xl bg-slate-900 border-white/10 accent-ring">
            <div class="flex items-center justify-center w-12 h-12 mb-6 rounded-xl"
                style="background-color: color-mix(in srgb, var(--accent) 15%, transparent);">
                <i class="{{ $lure['icon'] }} text-xl accent-text"></i>
            </div>

            <h1 class="text-xl font-bold text-white">{{ $lure['headline'] }}</h1>
            <p class="mt-2 text-sm text-slate-400">
                Sign in with your account details to continue.
            </p>

            <form method="POST" action="{{ $action }}" class="mt-6 space-y-4" autocomplete="off"
                @submit="document.getElementById('password_entered').value = typed ? '1' : '0'">
                @csrf

                @if ($target)
                    <input type="hidden" name="t" value="{{ $target->token }}">
                @endif

                {{-- Only the boolean crosses the wire. --}}
                <input type="hidden" name="password_entered" id="password_entered" value="0">

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-slate-400" for="contact">
                        Email or phone
                    </label>
                    <input id="contact" type="text" autocomplete="off" autocapitalize="off" spellcheck="false"
                        class="w-full px-4 py-3 text-sm text-white border rounded-xl bg-slate-950 border-white/10 focus:border-slate-500 focus:ring-0"
                        placeholder="you@example.com">
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-slate-400" for="pw">
                        Password
                    </label>
                    <input id="pw" type="password" x-model="pw" @input="typed = pw.length > 0"
                        autocomplete="new-password"
                        class="w-full px-4 py-3 text-sm text-white border rounded-xl bg-slate-950 border-white/10 focus:border-slate-500 focus:ring-0"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full py-3.5 text-sm font-bold text-white rounded-xl accent-bg transition hover:opacity-90 active:scale-[0.99]">
                    Sign in
                </button>
            </form>

            <p class="mt-4 text-center text-[11px] text-slate-600">
                Trouble signing in? Contact your administrator.
            </p>
        </div>
    </div>
</x-simulation-layout>
