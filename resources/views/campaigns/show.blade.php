@php
    /** @var \App\Models\Campaign $campaign */
    $statusStyles = [
        'draft' => 'bg-slate-500/15 text-slate-300 border-slate-500/30',
        'active' => 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30',
        'paused' => 'bg-amber-500/15 text-amber-300 border-amber-500/30',
        'completed' => 'bg-indigo-500/15 text-indigo-300 border-indigo-500/30',
    ];
    $statusStyle = $statusStyles[$campaign->status] ?? $statusStyles['draft'];

    $targetStatusStyles = [
        'Reported' => 'bg-emerald-500/15 text-emerald-300',
        'Submitted data' => 'bg-red-500/15 text-red-300',
        'Clicked' => 'bg-amber-500/15 text-amber-300',
        'Opened' => 'bg-sky-500/15 text-sky-300',
        'Not engaged' => 'bg-white/5 text-slate-400',
    ];

    $input = 'w-full px-3 py-2 text-sm text-white bg-slate-950 border border-white/10 rounded-lg focus:border-indigo-500 focus:ring-0 placeholder:text-slate-600';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-xl font-semibold text-white">{{ $campaign->name }}</h2>
                    <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase border rounded-full {{ $statusStyle }}">
                        {{ $campaign->status }}
                    </span>
                </div>
                <p class="mt-1 text-sm text-slate-400">
                    {{ config("lures.{$campaign->platform}.label", $campaign->platform) }}
                    &middot; owned by {{ $campaign->owner?->name }}
                    <span class="font-mono text-indigo-300">({{ $campaign->owner?->referral_code }})</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('simulation.lure', ['campaign' => $campaign->slug, 'preview' => 1]) }}" target="_blank"
                    class="px-4 py-2 text-sm font-semibold text-slate-200 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    Preview lure
                </a>
                <a href="{{ route('campaigns.edit', $campaign) }}"
                    class="px-4 py-2 text-sm font-semibold text-slate-200 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    Edit
                </a>
                <form method="POST" action="{{ route('campaigns.destroy', $campaign) }}"
                    onsubmit="return confirm('Delete this campaign and all of its participant records?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-red-300 bg-red-500/10 rounded-lg hover:bg-red-500/20 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-10 space-y-8">

        {{-- Authorization ---------------------------------------------------- --}}
        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold tracking-widest uppercase text-amber-300">Authorization record</h3>
                    <dl class="grid gap-4 mt-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <dt class="text-xs tracking-widest text-slate-500 uppercase">Authorized by</dt>
                            <dd class="mt-1 text-slate-200">{{ $campaign->authorized_by ?: '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs tracking-widest text-slate-500 uppercase">Email</dt>
                            <dd class="mt-1 break-all text-slate-200">{{ $campaign->authorized_email ?: '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs tracking-widest text-slate-500 uppercase">Reference</dt>
                            <dd class="mt-1 text-slate-200">{{ $campaign->authorization_ref ?: '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs tracking-widest text-slate-500 uppercase">Expires</dt>
                            <dd class="mt-1 {{ $campaign->authorization_expires_at?->isPast() ? 'text-red-300' : 'text-slate-200' }}">
                                {{ $campaign->authorization_expires_at?->format('d M Y') ?? '—' }}
                            </dd>
                        </div>
                    </dl>
                    <p class="max-w-3xl mt-4 text-sm text-slate-400">{{ $campaign->scope }}</p>
                </div>

                @unless ($campaign->isAuthorized())
                    <div class="max-w-xs p-4 text-sm border rounded-xl bg-amber-500/10 border-amber-500/30 text-amber-200">
                        <strong class="block mb-1">Not currently authorized</strong>
                        The sign-off is incomplete or has expired. No link will serve until a super admin re-confirms it.
                    </div>
                @endunless
            </div>
        </section>

        {{-- Status control ---------------------------------------------------- --}}
        @if (auth()->user()->isSuperAdmin())
            <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                <h3 class="mb-3 text-sm font-bold tracking-widest text-slate-400 uppercase">Campaign status</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach (['draft', 'active', 'paused', 'completed'] as $status)
                        <form method="POST" action="{{ route('campaigns.status', $campaign) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button type="submit" @disabled($campaign->status === $status)
                                class="px-4 py-2 text-sm font-semibold rounded-lg transition {{ $campaign->status === $status
                                    ? 'bg-white/5 text-slate-500 cursor-not-allowed'
                                    : 'bg-white/10 text-slate-100 hover:bg-white/20' }}">
                                Mark {{ $status }}
                            </button>
                        </form>
                    @endforeach
                </div>
                @unless ($campaign->canBeActivated())
                    <p class="mt-3 text-xs text-amber-300">
                        Activation is blocked until the authorization record above is complete and unexpired.
                    </p>
                @endunless
            </section>
        @endif

        {{-- Metrics ----------------------------------------------------------- --}}
        <section class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            @foreach ([
        ['label' => 'Enrolled', 'value' => $metrics['total']],
        ['label' => 'Clicked', 'value' => $metrics['clicked'].' ('.$metrics['click_rate'].'%)'],
        ['label' => 'Submitted data', 'value' => $metrics['submitted'].' ('.$metrics['submit_rate'].'%)'],
        ['label' => 'Reported', 'value' => $metrics['reported'].' ('.$metrics['report_rate'].'%)'],
    ] as $card)
                <div class="p-5 border rounded-2xl bg-slate-900 border-white/10">
                    <p class="text-xs font-bold tracking-widest text-slate-500 uppercase">{{ $card['label'] }}</p>
                    <p class="mt-2 text-2xl font-bold text-white">{{ $card['value'] }}</p>
                </div>
            @endforeach
        </section>

        {{-- Participants ------------------------------------------------------ --}}
        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <div>
                    <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase">Participants</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        A lure is only ever served to someone on this list, through their personal link.
                    </p>
                </div>
                @if ($targets->isNotEmpty())
                    <x-copy-button target="#all-links" label="Copy all links"
                        class="px-4 py-2 text-xs font-semibold text-slate-200 bg-white/10 rounded-lg hover:bg-white/20 transition" />
                @endif
            </div>

            <textarea id="all-links" class="hidden" aria-hidden="true">@foreach ($targets as $target){{ $links[$target->id] }}
@endforeach</textarea>

            <div class="grid gap-4 mb-6 lg:grid-cols-2">
                <form method="POST" action="{{ route('campaigns.targets.store', $campaign) }}"
                    class="p-4 space-y-3 border rounded-xl bg-white/5 border-white/10">
                    @csrf
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase">Add one participant</p>
                    <input name="name" type="text" required placeholder="Full name" class="{{ $input }}">
                    <input name="email" type="email" required placeholder="Email address" class="{{ $input }}">
                    <input name="department" type="text" placeholder="Department (optional)" class="{{ $input }}">
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 transition">
                        Enroll
                    </button>
                </form>

                <form method="POST" action="{{ route('campaigns.targets.import', $campaign) }}"
                    class="p-4 space-y-3 border rounded-xl bg-white/5 border-white/10">
                    @csrf
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase">Bulk enroll</p>
                    <textarea name="participants" rows="5" required
                        placeholder="One per line:&#10;Thandi M &lt;thandi@example.com&gt;&#10;just.email@example.com"
                        class="{{ $input }} font-mono text-xs"></textarea>
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-semibold text-white bg-white/10 rounded-lg hover:bg-white/20 transition">
                        Import list
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto border rounded-xl border-white/10">
                <table class="min-w-full text-sm">
                    <thead class="text-xs tracking-widest uppercase bg-white/5 text-slate-400">
                        <tr>
                            <th class="px-4 py-3 text-left">Participant</th>
                            <th class="px-4 py-3 text-left">Department</th>
                            <th class="px-4 py-3 text-left">Engagement</th>
                            <th class="px-4 py-3 text-left">Personal link</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($targets as $target)
                            @php $statusLabel = $target->statusLabel(); @endphp
                            <tr class="hover:bg-white/5">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-white">{{ $target->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $target->email }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-400">{{ $target->department ?: '—' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-full {{ $targetStatusStyles[$statusLabel] ?? 'bg-white/5 text-slate-400' }}">
                                        {{ $statusLabel }}
                                    </span>
                                    @if ($target->debrief_seen_at)
                                        <div class="mt-1 text-[10px] text-emerald-400">Saw the debrief</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <code id="link-{{ $target->id }}"
                                            class="block max-w-[280px] truncate font-mono text-xs text-slate-400">{{ $links[$target->id] }}</code>
                                        <x-copy-button target="#link-{{ $target->id }}" />
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <form method="POST"
                                        action="{{ route('campaigns.targets.destroy', [$campaign, $target]) }}"
                                        onsubmit="return confirm('Remove this participant?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-300 hover:text-red-200">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-slate-500">
                                    No participants enrolled yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- What is recorded -------------------------------------------------- --}}
        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase">What this campaign records</h3>
            <div class="grid gap-4 mt-4 text-sm sm:grid-cols-2">
                <div class="p-4 border rounded-xl bg-emerald-500/5 border-emerald-500/20">
                    <p class="font-semibold text-emerald-300">Recorded</p>
                    <ul class="mt-2 space-y-1 text-slate-300 list-disc list-inside">
                        <li>Whether the message was opened</li>
                        <li>Whether the link was clicked</li>
                        <li>Whether anything was typed into the form</li>
                        <li>Whether the participant reported it</li>
                        <li>Whether they read the debrief</li>
                    </ul>
                </div>
                <div class="p-4 border rounded-xl bg-red-500/5 border-red-500/20">
                    <p class="font-semibold text-red-300">Never recorded</p>
                    <ul class="mt-2 space-y-1 text-slate-300 list-disc list-inside">
                        <li>The email address typed into the form</li>
                        <li>The password typed into the form</li>
                        <li>Any value from any submitted field</li>
                    </ul>
                    <p class="mt-3 text-xs text-slate-400">
                        The database has no column able to hold a submitted secret, and the simulated form
                        discards its input before anything else runs.
                    </p>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
