@php
    $query = array_filter([
        't' => $target?->token,
        'preview' => $preview ? 1 : null,
    ]);
    $dashboardUrl = auth()->check() ? route('dashboard') : null;
@endphp

<x-simulation-layout title="This was a simulation" accent="#10b981" :preview="$preview">
    <div class="w-full max-w-2xl space-y-6">

        <div class="p-8 text-center border rounded-3xl bg-slate-900 border-emerald-500/30">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 rounded-2xl bg-emerald-500/15">
                <i class="text-3xl fa-solid fa-shield-halved text-emerald-400"></i>
            </div>

            <p class="text-xs font-bold tracking-widest uppercase text-emerald-400">Security awareness exercise</p>
            <h1 class="mt-3 text-2xl font-bold text-white">That page was a simulation</h1>

            <p class="max-w-lg mx-auto mt-4 text-sm leading-relaxed text-slate-300">
                You just took part in an authorized security awareness exercise run by your organisation. The page
                you saw was not a real sign-in page and it does not belong to any social media platform.
            </p>

            <div class="max-w-lg p-4 mx-auto mt-6 text-left border rounded-xl bg-emerald-500/5 border-emerald-500/20">
                <p class="text-sm font-semibold text-emerald-300">Nothing you typed was kept</p>
                <p class="mt-2 text-sm leading-relaxed text-slate-300">
                    Whatever you entered stayed on your own device. It was not transmitted, not stored, and not seen
                    by anyone &mdash; not your administrator and not us. There is no record of it anywhere, and there
                    is nothing to clean up.
                </p>
            </div>
        </div>

        <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h2 class="text-sm font-bold tracking-widest uppercase text-slate-400">What gave it away</h2>
            <ul class="mt-4 space-y-3 text-sm text-slate-300">
                <li class="flex gap-3">
                    <i class="mt-1 text-xs fa-solid fa-triangle-exclamation text-amber-400"></i>
                    <span><strong class="text-white">The link arrived unexpectedly.</strong> Sign-in pages reached from a
                        message rather than from the app itself are the most common phishing route.</span>
                </li>
                <li class="flex gap-3">
                    <i class="mt-1 text-xs fa-solid fa-triangle-exclamation text-amber-400"></i>
                    <span><strong class="text-white">It created urgency.</strong> Phrases like "verify now", "unusual
                        activity" or "your payout is on hold" are there to stop you thinking it through.</span>
                </li>
                <li class="flex gap-3">
                    <i class="mt-1 text-xs fa-solid fa-triangle-exclamation text-amber-400"></i>
                    <span><strong class="text-white">It asked for your password.</strong> A genuine platform never asks
                        you to re-enter your password from an emailed link, and never to "retry" it.</span>
                </li>
                <li class="flex gap-3">
                    <i class="mt-1 text-xs fa-solid fa-triangle-exclamation text-amber-400"></i>
                    <span><strong class="text-white">Check the address bar.</strong> Look at the domain before you type
                        anything. This page was not on the platform's domain.</span>
                </li>
            </ul>
        </div>

        <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h2 class="text-sm font-bold tracking-widest uppercase text-slate-400">If this had been real</h2>
            <ol class="mt-4 space-y-3 text-sm text-slate-300 list-decimal list-inside">
                <li>Change the password on that account immediately, and anywhere you reused it.</li>
                <li>Turn on two-factor authentication, preferably with an authenticator app rather than SMS.</li>
                <li>Report it to your security team straight away &mdash; speed matters far more than embarrassment.</li>
                <li>Sign out other sessions on the account and review recent activity.</li>
            </ol>
        </div>

        <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h2 class="text-sm font-bold tracking-widest uppercase text-slate-400">Help us improve the training</h2>
            <p class="mt-3 text-sm text-slate-400">
                If you spotted something suspicious, tell us what it was. This is feedback about the exercise, and
                it is recorded only as a short note against your participation.
            </p>

            <form method="POST" action="{{ route('simulation.report', ['campaign' => $campaign->slug] + $query) }}"
                class="mt-4 space-y-3">
                @csrf
                <textarea name="reason" rows="3" maxlength="500"
                    placeholder="e.g. The domain looked wrong and it asked for my password."
                    class="w-full px-4 py-3 text-sm text-white border rounded-xl bg-slate-950 border-white/10 focus:border-emerald-500 focus:ring-0 placeholder:text-slate-600"></textarea>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-500 transition">
                        Report this attempt
                    </button>

                    @if ($dashboardUrl)
                        <a href="{{ $dashboardUrl }}"
                            class="px-6 py-2.5 text-sm font-semibold text-slate-300 rounded-xl hover:bg-white/5 transition">
                            Back to console
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <p class="pb-4 text-center text-xs text-slate-600">
            Exercise reference {{ strtoupper(substr($campaign->slug, 0, 8)) }}
        </p>
    </div>
</x-simulation-layout>
