<x-simulation-layout title="Thanks for reporting" accent="#10b981" :preview="$preview">
    <div class="w-full max-w-lg p-8 text-center border rounded-3xl bg-slate-900 border-emerald-500/30">
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-5 rounded-2xl bg-emerald-500/15">
            <i class="text-3xl fa-solid fa-hand text-emerald-400"></i>
        </div>

        <h1 class="text-2xl font-bold text-white">Nice catch</h1>

        <p class="mt-4 text-sm leading-relaxed text-slate-300">
            Reporting a suspicious message is the single most valuable thing you can do. It lets your security team
            warn everyone else before someone else falls for it.
        </p>

        <p class="mt-4 text-sm leading-relaxed text-slate-400">
            Reminder: the page you just saw was part of an authorized awareness exercise, and nothing you typed was
            recorded anywhere.
        </p>

        <a href="{{ url('/') }}"
            class="inline-block px-6 py-3 mt-8 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-500 transition">
            Done
        </a>
    </div>
</x-simulation-layout>
