<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-white">Edit campaign</h2>
                <p class="mt-1 text-sm text-slate-400">{{ $campaign->name }}</p>
            </div>
            <a href="{{ route('campaigns.show', $campaign) }}"
                class="text-sm font-semibold text-indigo-300 hover:text-indigo-200">
                Back to campaign
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl">
            <form method="POST" action="{{ route('campaigns.update', $campaign) }}"
                class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                @csrf
                @method('PUT')

                @include('campaigns._form', ['campaign' => $campaign, 'platforms' => $platforms])

                <div class="flex items-center gap-3 mt-8">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition">
                        Save changes
                    </button>
                    <a href="{{ route('campaigns.show', $campaign) }}"
                        class="px-6 py-2.5 text-sm font-semibold text-slate-300 rounded-xl hover:bg-white/5 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
