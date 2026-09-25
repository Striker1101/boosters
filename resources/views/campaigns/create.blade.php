<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">New campaign</h2>
        <p class="mt-1 text-sm text-slate-400">
            A campaign is one authorized exercise against an enrolled group.
        </p>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl">
            <form method="POST" action="{{ route('campaigns.store') }}"
                class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                @csrf

                @include('campaigns._form', ['platforms' => $platforms])

                <div class="flex items-center gap-3 mt-8">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition">
                        Create draft
                    </button>
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-2.5 text-sm font-semibold text-slate-300 rounded-xl hover:bg-white/5 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
