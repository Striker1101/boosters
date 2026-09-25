<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title ?? config('custom.title', 'Awareness Console') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
</head>

<body class="h-full font-sans antialiased bg-slate-950 text-slate-200">
    <div class="min-h-full">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-white/5 bg-slate-900/50">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="pb-20">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mt-6 px-4 py-3 text-sm rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 px-4 py-3 text-sm rounded-xl bg-red-500/10 border border-red-500/30 text-red-300">
                        <p class="font-semibold">Please fix the following:</p>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>

</html>
