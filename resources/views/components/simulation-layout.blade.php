@props([
    'title' => 'Verify your account',
    'accent' => '#6366f1',
    'preview' => false,
])

<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="referrer" content="no-referrer">

    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --accent: {{ $accent }};
        }

        .accent-bg {
            background-color: var(--accent);
        }

        .accent-text {
            color: var(--accent);
        }

        .accent-ring {
            box-shadow: 0 0 0 1px color-mix(in srgb, var(--accent) 40%, transparent),
                0 20px 60px -20px color-mix(in srgb, var(--accent) 45%, transparent);
        }
    </style>
</head>

<body class="h-full font-sans antialiased bg-slate-950 text-slate-200">
    @if ($preview)
        <div class="px-4 py-2 text-xs font-bold tracking-widest text-center uppercase bg-amber-400 text-slate-900">
            Preview mode &mdash; this visit is not recorded
        </div>
    @endif

    <main class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
        {{ $slot }}
    </main>
</body>

</html>
