@php
    /** @var \App\Models\User $user */
    $totals = [
        'campaigns' => $campaigns->count(),
        'targets' => $campaigns->sum('targets_count'),
        'clicked' => $campaigns->sum('clicked_count'),
        'submitted' => $campaigns->sum('submitted_count'),
        'reported' => $campaigns->sum('reported_count'),
    ];

    $rate = fn (int $value): float => $totals['targets'] > 0
        ? round($value / $totals['targets'] * 100, 1)
        : 0.0;

    $statusStyles = [
        'draft' => 'bg-slate-500/15 text-slate-300 border-slate-500/30',
        'active' => 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30',
        'paused' => 'bg-amber-500/15 text-amber-300 border-amber-500/30',
        'completed' => 'bg-indigo-500/15 text-indigo-300 border-indigo-500/30',
    ];

    $baseUrl = rtrim(url('/'), '/');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-white">Campaign dashboard</h2>
                <p class="mt-1 text-sm text-slate-400">
                    Aggregate engagement only. This system never stores what a participant types.
                </p>
            </div>
            <a href="{{ route('campaigns.create') }}"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition">
                New campaign
            </a>
        </div>
    </x-slot>

    <div class="py-10 space-y-8">

        {{-- Your tag ------------------------------------------------------- --}}
        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <div class="flex flex-wrap items-start justify-between gap-6">
                <div>
                    <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase">Your unique tag</h3>
                    <p class="mt-2 font-mono text-3xl font-bold text-indigo-300">{{ $user->referral_code }}</p>
                    <p class="max-w-xl mt-2 text-sm text-slate-400">
                        Every admin has one tag. It identifies which admin a campaign belongs to, so results are
                        attributed to you automatically.
                    </p>
                </div>

                <div class="w-full max-w-md">
                    <label class="block mb-2 text-xs font-bold tracking-widest text-slate-500 uppercase">
                        Your console link
                    </label>
                    <div class="flex items-center gap-2">
                        <code id="console-link"
                            class="flex-1 px-3 py-2 font-mono text-xs break-all border rounded-lg bg-black/40 border-white/10 text-slate-300">{{ $baseUrl }}/dashboard</code>
                        <x-copy-button target="#console-link" />
                    </div>
                    <p class="mt-2 text-xs text-slate-500">
                        Participant links live on each campaign page &mdash; they are unique per person and per campaign.
                    </p>
                </div>
            </div>
        </section>

        {{-- Totals --------------------------------------------------------- --}}
        <section class="grid grid-cols-2 gap-4 lg:grid-cols-5">
            @foreach ([
        ['label' => 'Campaigns', 'value' => $totals['campaigns'], 'hint' => 'Created'],
        ['label' => 'Participants', 'value' => $totals['targets'], 'hint' => 'Enrolled'],
        ['label' => 'Clicked', 'value' => $rate($totals['clicked']).'%', 'hint' => 'Opened the lure'],
        ['label' => 'Submitted data', 'value' => $rate($totals['submitted']).'%', 'hint' => 'Lower is better'],
        ['label' => 'Reported', 'value' => $rate($totals['reported']).'%', 'hint' => 'Higher is better'],
    ] as $card)
                <div class="p-5 border rounded-2xl bg-slate-900 border-white/10">
                    <p class="text-xs font-bold tracking-widest text-slate-500 uppercase">{{ $card['label'] }}</p>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $card['value'] }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $card['hint'] }}</p>
                </div>
            @endforeach
        </section>

        {{-- Filters ------------------------------------------------------- --}}
        <form method="GET" class="flex flex-wrap items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search campaigns..."
                class="flex-1 min-w-[200px] px-4 py-2 text-sm text-white border rounded-lg bg-slate-900 border-white/10 focus:border-indigo-500 focus:ring-0">
            <select name="status"
                class="px-4 py-2 text-sm text-white border rounded-lg bg-slate-900 border-white/10 focus:border-indigo-500 focus:ring-0">
                <option value="">All statuses</option>
                @foreach (['draft', 'active', 'paused', 'completed'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button class="px-5 py-2 text-sm font-semibold text-white bg-white/10 rounded-lg hover:bg-white/20 transition">
                Filter
            </button>
        </form>

        {{-- Campaign list -------------------------------------------------- --}}
        <section class="overflow-hidden border rounded-2xl bg-slate-900 border-white/10">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-xs tracking-widest uppercase bg-white/5 text-slate-400">
                        <tr>
                            <th class="px-5 py-3 text-left">Campaign</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            @if ($user->isSuperAdmin())
                                <th class="px-5 py-3 text-left">Owner</th>
                            @endif
                            <th class="px-5 py-3 text-right">Enrolled</th>
                            <th class="px-5 py-3 text-right">Clicked</th>
                            <th class="px-5 py-3 text-right">Submitted</th>
                            <th class="px-5 py-3 text-right">Reported</th>
                            <th class="px-5 py-3 text-right">Resilience</th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($campaigns as $campaign)
                            @php
                                $enrolled = max($campaign->targets_count, 1);
                                $resilience = round((($campaign->targets_count - $campaign->submitted_count) + $campaign->reported_count) / $enrolled * 100, 1);
                            @endphp
                            <tr class="hover:bg-white/5">
                                <td class="px-5 py-4">
                                    <a href="{{ route('campaigns.show', $campaign) }}"
                                        class="font-semibold text-white hover:text-indigo-300">
                                        {{ $campaign->name }}
                                    </a>
                                    <div class="text-xs text-slate-500">
                                        {{ config("lures.{$campaign->platform}.label", $campaign->platform) }}
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span
                                        class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase border rounded-full {{ $statusStyles[$campaign->status] ?? $statusStyles['draft'] }}">
                                        {{ $campaign->status }}
                                    </span>
                                    @unless ($campaign->isAuthorized())
                                        <div class="mt-1 text-[10px] text-amber-400">Authorization missing</div>
                                    @endunless
                                </td>
                                @if ($user->isSuperAdmin())
                                    <td class="px-5 py-4">
                                        <div class="text-slate-300">{{ $campaign->owner?->name }}</div>
                                        <div class="font-mono text-xs text-indigo-300">{{ $campaign->owner?->referral_code }}</div>
                                    </td>
                                @endif
                                <td class="px-5 py-4 text-right text-slate-300">{{ $campaign->targets_count }}</td>
                                <td class="px-5 py-4 text-right text-slate-300">{{ $campaign->clicked_count }}</td>
                                <td class="px-5 py-4 text-right {{ $campaign->submitted_count > 0 ? 'text-red-300 font-semibold' : 'text-slate-300' }}">
                                    {{ $campaign->submitted_count }}
                                </td>
                                <td class="px-5 py-4 text-right {{ $campaign->reported_count > 0 ? 'text-emerald-300 font-semibold' : 'text-slate-300' }}">
                                    {{ $campaign->reported_count }}
                                </td>
                                <td class="px-5 py-4 text-right font-semibold text-white">
                                    {{ $campaign->targets_count ? $resilience.'%' : '—' }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('campaigns.show', $campaign) }}"
                                        class="text-xs font-semibold text-indigo-300 hover:text-indigo-200">Open</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-5 py-16 text-center text-slate-500">
                                    No campaigns yet.
                                    <a href="{{ route('campaigns.create') }}"
                                        class="font-semibold text-indigo-300 hover:text-indigo-200">Create the first one</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Super admin: staff rollup -------------------------------------- --}}
        @if ($user->isSuperAdmin() && $adminRollup->isNotEmpty())
            <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase">Admins and their tags</h3>
                    <a href="{{ route('admins.index') }}" class="text-xs font-semibold text-indigo-300 hover:text-indigo-200">
                        Manage staff
                    </a>
                </div>
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($adminRollup as $admin)
                        <div class="flex items-center justify-between p-4 border rounded-xl bg-white/5 border-white/5">
                            <div>
                                <div class="font-semibold text-white">{{ $admin->name }}</div>
                                <div class="text-xs text-slate-500">{{ $admin->email }}</div>
                                <div class="mt-1 font-mono text-xs text-indigo-300">{{ $admin->referral_code }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-white">{{ $admin->campaigns_count }}</div>
                                <div class="text-[10px] tracking-widest text-slate-500 uppercase">Campaigns</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-app-layout>
