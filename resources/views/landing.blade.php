@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('custom.title', 'Awareness Console') }} — security awareness simulations</title>
    <meta name="description"
        content="Run authorized phishing-simulation exercises against enrolled participants and measure how they respond — without ever collecting a credential.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="h-full font-sans antialiased bg-slate-950 text-slate-200">

    {{-- Nav ---------------------------------------------------------------- --}}
    <header class="sticky top-0 z-50 border-b border-white/5 bg-slate-950/80 backdrop-blur">
        <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('logo.svg') }}" alt="" class="w-8 h-8">
                <span class="text-lg font-bold tracking-tight text-white">{{ config('custom.title') }}</span>
            </a>

            <nav class="items-center hidden gap-8 text-sm text-slate-400 md:flex">
                <a href="#how" class="transition hover:text-white">How it works</a>
                <a href="#guardrails" class="transition hover:text-white">Guardrails</a>
            </nav>

            @if ($user)
                <a href="{{ route('dashboard') }}"
                    class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl transition hover:bg-indigo-500">
                    Open console
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl transition hover:bg-indigo-500">
                    Staff sign in
                </a>
            @endif
        </div>
    </header>

    {{-- Hero ---------------------------------------------------------------- --}}
    <section class="px-4 pt-20 pb-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span
                class="inline-flex items-center gap-2 px-3 py-1 text-[11px] font-bold tracking-widest uppercase border rounded-full bg-indigo-500/10 border-indigo-500/30 text-indigo-300">
                <i class="fa-solid fa-shield-halved"></i>
                Authorized exercises only
            </span>

            <h1 class="mt-6 text-4xl font-bold leading-tight tracking-tight text-white sm:text-6xl">
                Phishing simulations that
                <span class="text-indigo-400">never collect a password.</span>
            </h1>

            <p class="max-w-2xl mt-6 text-lg leading-relaxed text-slate-400">
                Measure how your people respond to a realistic attempt, and find out who reports it.
                Participants get an immediate teachable moment. You get the numbers &mdash; never anyone's
                credentials.
            </p>

            <div class="flex flex-wrap items-center gap-3 mt-8">
                @if ($user)
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-xl transition hover:bg-indigo-500">
                        Open the console
                    </a>
                    <a href="{{ route('campaigns.create') }}"
                        class="px-6 py-3 text-sm font-semibold text-slate-200 border rounded-xl border-white/10 transition hover:bg-white/5">
                        Start a campaign
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-xl transition hover:bg-indigo-500">
                        Staff sign in
                    </a>
                    <a href="#how"
                        class="px-6 py-3 text-sm font-semibold text-slate-200 border rounded-xl border-white/10 transition hover:bg-white/5">
                        See how it works
                    </a>
                @endif
            </div>

            <p class="mt-4 text-xs text-slate-500">
                No public sign-up. Staff accounts are created by a super admin.
            </p>
        </div>
    </section>

    {{-- Recorded / never recorded ------------------------------------------- --}}
    <section class="px-4 pb-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid gap-4 lg:grid-cols-2">
            <div class="p-6 border rounded-2xl bg-slate-900 border-emerald-500/20">
                <h2 class="text-sm font-bold tracking-widest uppercase text-emerald-300">What a campaign records</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-check text-emerald-400"></i> Whether the message was opened</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-check text-emerald-400"></i> Whether the link was clicked</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-check text-emerald-400"></i> Whether anything was typed into the form</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-check text-emerald-400"></i> Whether the participant reported it</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-check text-emerald-400"></i> Whether they read the debrief</li>
                </ul>
            </div>

            <div class="p-6 border rounded-2xl bg-slate-900 border-red-500/20">
                <h2 class="text-sm font-bold tracking-widest uppercase text-red-300">What it can never record</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-xmark text-red-400"></i> The email typed into the form</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-xmark text-red-400"></i> The password typed into the form</li>
                    <li class="flex gap-3"><i class="mt-1 text-xs fa-solid fa-xmark text-red-400"></i> Any value from any submitted field</li>
                </ul>
                <p class="mt-4 text-xs leading-relaxed text-slate-400">
                    The database has no column able to hold a submitted secret, and the simulated form
                    discards its input before anything else runs. A typed password never leaves the
                    participant's own device.
                </p>
            </div>
        </div>
    </section>

    {{-- How it works --------------------------------------------------------- --}}
    <section id="how" class="px-4 py-20 border-y border-white/5 bg-slate-900/40">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-white">How an exercise runs</h2>
            <p class="max-w-2xl mt-3 text-slate-400">
                Four steps, each with a control that keeps the exercise scoped to people who are covered by it.
            </p>

            <div class="grid gap-4 mt-10 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
        ['step' => '1', 'title' => 'Create a campaign', 'body' => 'Record who authorized the exercise, their reference, the written scope, and when the sign-off expires.'],
        ['step' => '2', 'title' => 'Enrol participants', 'body' => 'Add people one at a time or paste a list. Each person gets a personal, unguessable link.'],
        ['step' => '3', 'title' => 'A super admin activates it', 'body' => 'A campaign cannot go live on its own, and cannot run without a current authorization on record.'],
        ['step' => '4', 'title' => 'Read the results', 'body' => 'See click, submit and report rates per campaign. Aggregate numbers only.'],
    ] as $card)
                    <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                        <div class="flex items-center justify-center w-9 h-9 mb-4 text-sm font-bold text-white rounded-lg bg-indigo-600">
                            {{ $card['step'] }}
                        </div>
                        <h3 class="font-semibold text-white">{{ $card['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $card['body'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="p-6 mt-10 border rounded-2xl bg-slate-900 border-white/10">
                <h3 class="text-sm font-bold tracking-widest uppercase text-slate-400">What the participant sees</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">
                    Their personal link opens the lure. If they continue, they see a simulated sign-in form.
                    The moment they submit, they are taken straight to a debrief that tells them the page was a
                    simulation, shows what gave it away, and offers a one-click way to report it.
                    <strong class="text-white">There is no second attempt and no password re-prompt.</strong>
                </p>
            </div>
        </div>
    </section>

    {{-- Guardrails ----------------------------------------------------------- --}}
    <section id="guardrails" class="px-4 py-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-white">Guardrails</h2>
        <p class="max-w-2xl mt-3 text-slate-400">
            These are enforced in code, not by policy alone.
        </p>

        <div class="grid gap-4 mt-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ([
        ['icon' => 'fa-solid fa-file-signature', 'title' => 'Authorization required', 'body' => 'A campaign cannot be activated without a named authorizer, a reference, a written scope and an unexpired date.'],
        ['icon' => 'fa-solid fa-user-lock', 'title' => 'Enrolled participants only', 'body' => 'A lure is served only to someone on the participant list, via their own token. Anything else gets a 404.'],
        ['icon' => 'fa-solid fa-user-shield', 'title' => 'Private console', 'body' => 'Every operator page requires a signed-in account, and there is no public sign-up.'],
        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'No credential storage', 'body' => 'No table has a column able to hold a submitted secret, and the form never transmits one.'],
        ['icon' => 'fa-solid fa-graduation-cap', 'title' => 'Immediate debrief', 'body' => 'Participants are taught at the moment of the click, which is when the lesson actually lands.'],
        ['icon' => 'fa-solid fa-gauge-high', 'title' => 'Rate limited', 'body' => 'Public endpoints are throttled so valid tokens cannot be enumerated.'],
    ] as $item)
                <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                    <div class="flex items-center justify-center w-11 h-11 mb-4 rounded-xl bg-indigo-500/10">
                        <i class="{{ $item['icon'] }} text-indigo-400"></i>
                    </div>
                    <h3 class="font-semibold text-white">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $item['body'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --------------------------------------------------------------- --}}
    <footer class="border-t border-white/5">
        <div class="flex flex-col items-center justify-between gap-4 px-4 py-8 mx-auto text-xs text-slate-500 max-w-7xl sm:px-6 md:flex-row lg:px-8">
            <p>&copy; {{ date('Y') }} {{ config('custom.title') }}. Authorized security awareness exercises only.</p>
            <div class="flex items-center gap-6">
                <a href="#how" class="transition hover:text-white">How it works</a>
                <a href="#guardrails" class="transition hover:text-white">Guardrails</a>
                <a href="{{ route('login') }}" class="transition hover:text-white">Staff sign in</a>
            </div>
        </div>
    </footer>

</body>

</html>
