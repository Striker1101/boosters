@php
    $query = array_filter([
        't' => $target?->token,
        'preview' => $preview ? 1 : null,
    ]);
    $continueUrl = route('simulation.login', ['campaign' => $campaign->slug] + $query);
@endphp

<x-simulation-layout :title="$lure['headline']" :accent="$lure['accent']" :preview="$preview">
    <div class="w-full max-w-md">
        <div class="p-8 border rounded-3xl bg-slate-900 border-white/10 accent-ring">
            <div class="flex items-center justify-center w-14 h-14 mb-6 rounded-2xl"
                style="background-color: color-mix(in srgb, var(--accent) 15%, transparent);">
                <i class="{{ $lure['icon'] }} text-2xl accent-text"></i>
            </div>

            <h1 class="text-2xl font-bold leading-snug text-white">{{ $lure['headline'] }}</h1>
            <p class="mt-3 text-sm leading-relaxed text-slate-400">{{ $lure['subhead'] }}</p>

            <ul class="mt-6 space-y-2 text-sm text-slate-400">
                <li class="flex items-center gap-2">
                    <i class="text-xs fa-solid fa-circle-check accent-text"></i>
                    Takes less than a minute
                </li>
                <li class="flex items-center gap-2">
                    <i class="text-xs fa-solid fa-circle-check accent-text"></i>
                    Your details stay private
                </li>
            </ul>

            <a href="{{ $continueUrl }}"
                class="block w-full py-3.5 mt-8 text-sm font-bold text-center text-white rounded-xl accent-bg transition hover:opacity-90 active:scale-[0.99]">
                {{ $lure['prompt'] }}
            </a>

            <p class="mt-4 text-center text-[11px] text-slate-600">
                Secure connection
            </p>
        </div>

        <p class="mt-6 text-center text-[11px] text-slate-600">
            Reference {{ strtoupper(substr($campaign->slug, 0, 8)) }}
        </p>
    </div>
</x-simulation-layout>
