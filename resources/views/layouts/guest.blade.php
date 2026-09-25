<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? config('custom.title', 'Awareness Console') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    @yield('head')
</head>

<body class="h-full font-sans antialiased bg-slate-950 text-slate-200">
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12">

        <a href="{{ url('/') }}" class="flex items-center gap-2 mb-8">
            <img src="{{ asset('logo.svg') }}" alt="" class="w-9 h-9">
            <span class="text-xl font-bold tracking-tight text-white">{{ config('custom.title') }}</span>
        </a>

        <main class="w-full max-w-md">
            @if (session('status'))
                <div class="px-4 py-3 mb-4 text-sm border rounded-xl bg-emerald-500/10 border-emerald-500/30 text-emerald-300">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="px-4 py-3 mb-4 text-sm border rounded-xl bg-red-500/10 border-red-500/30 text-red-300">
                    <ul class="space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>

        <p class="max-w-md mt-8 text-center text-xs text-slate-600">
            Authorized security awareness console. Access is limited to staff accounts.
        </p>
    </div>

    @stack('scripts')
</body>

</html>
