<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">How this console works</h2>
        <p class="mt-1 text-sm text-slate-400">
            A short tour of the campaign lifecycle and the limits built into it.
        </p>
    </x-slot>

    <div class="py-10 space-y-8">

        <section class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach ([
        ['step' => '1', 'title' => 'Create a campaign', 'body' => 'Name it, pick a generic lure theme, and record who authorized the exercise, the reference, and when the sign-off expires.'],
        ['step' => '2', 'title' => 'Enroll participants', 'body' => 'Add people one at a time or paste a list. Each person gets a personal, unguessable link. Nobody outside the list can be served a lure.'],
        ['step' => '3', 'title' => 'Super admin activates', 'body' => 'A campaign cannot go live on its own. A super admin checks the authorization record, then switches it to active.'],
        ['step' => '4', 'title' => 'Read the debrief results', 'body' => 'See who clicked, who typed something, and who reported it. You get rates, never the contents of any field.'],
    ] as $card)
                <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                    <div class="flex items-center justify-center w-9 h-9 mb-4 text-sm font-bold text-white rounded-lg bg-indigo-600">
                        {{ $card['step'] }}
                    </div>
                    <h3 class="font-semibold text-white">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $card['body'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h3 class="text-sm font-bold tracking-widest uppercase text-emerald-300">What happens to a participant</h3>
            <ol class="mt-4 space-y-4 text-sm text-slate-300">
                <li class="flex gap-4">
                    <span class="font-mono text-slate-500">01</span>
                    <p>They receive their personal link and land on the lure page for that campaign theme.</p>
                </li>
                <li class="flex gap-4">
                    <span class="font-mono text-slate-500">02</span>
                    <p>If they continue, they see a simulated sign-in form.</p>
                </li>
                <li class="flex gap-4">
                    <span class="font-mono text-slate-500">03</span>
                    <p>
                        The moment they submit, they are taken straight to a debrief that tells them the page was a
                        simulation. <strong class="text-white">There is no second attempt and no password re-prompt.</strong>
                    </p>
                </li>
                <li class="flex gap-4">
                    <span class="font-mono text-slate-500">04</span>
                    <p>The debrief explains what gave the attempt away, and offers a one-click way to report it.</p>
                </li>
            </ol>
        </section>

        <section class="grid gap-4 lg:grid-cols-2">
            <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                <h3 class="text-sm font-bold tracking-widest uppercase text-indigo-300">Your tag and links</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-400">
                    Every admin has a unique tag, shown in the navigation bar. It is the identifier that ties a
                    campaign to the admin running it, so results land on the right dashboard.
                </p>
                <p class="mt-3 text-sm leading-relaxed text-slate-400">
                    Participant links are generated per person on the campaign page. Send each person their own
                    link &mdash; a shared link will not attribute correctly and is not a valid exercise.
                </p>
            </div>

            <div class="p-6 border rounded-2xl bg-slate-900 border-white/10">
                <h3 class="text-sm font-bold tracking-widest uppercase text-amber-300">Built-in limits</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-400 list-disc list-inside">
                    <li>The console is invisible to anyone who is not signed in.</li>
                    <li>Accounts are created by super admins only; there is no public sign-up.</li>
                    <li>A campaign needs a current named authorization before it can run.</li>
                    <li>Only enrolled participants with a valid personal token see a lure.</li>
                    <li>The database has no column that can store a submitted secret.</li>
                    <li>The simulated form discards its input before any other code runs.</li>
                </ul>
            </div>
        </section>

        <section class="p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h3 class="text-sm font-bold tracking-widest uppercase text-slate-400">Reading the numbers</h3>
            <div class="grid gap-4 mt-4 text-sm sm:grid-cols-3">
                <div class="p-4 rounded-xl bg-white/5">
                    <p class="font-semibold text-white">Click rate</p>
                    <p class="mt-1 text-slate-400">How many people acted on the message. High is expected; treat it as the baseline for training.</p>
                </div>
                <div class="p-4 rounded-xl bg-white/5">
                    <p class="font-semibold text-white">Submit rate</p>
                    <p class="mt-1 text-slate-400">How many typed something into the form. <span class="text-red-300">Lower is better.</span></p>
                </div>
                <div class="p-4 rounded-xl bg-white/5">
                    <p class="font-semibold text-white">Report rate</p>
                    <p class="mt-1 text-slate-400">How many flagged it. <span class="text-emerald-300">This is the number to grow.</span></p>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
