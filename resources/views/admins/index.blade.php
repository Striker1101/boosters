@php
    $input = 'w-full px-3 py-2 text-sm text-white bg-slate-950 border border-white/10 rounded-lg focus:border-indigo-500 focus:ring-0 placeholder:text-slate-600';
    $label = 'block mb-2 text-xs font-bold tracking-widest text-slate-400 uppercase';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">Staff and tags</h2>
        <p class="mt-1 text-sm text-slate-400">
            Every admin has one unique tag. Campaigns and results are attributed to the tag that owns them.
        </p>
    </x-slot>

    <div class="py-10 space-y-8">
        <section class="overflow-hidden border rounded-2xl bg-slate-900 border-white/10">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-xs tracking-widest uppercase bg-white/5 text-slate-400">
                        <tr>
                            <th class="px-5 py-3 text-left">Name</th>
                            <th class="px-5 py-3 text-left">Tag</th>
                            <th class="px-5 py-3 text-left">Role</th>
                            <th class="px-5 py-3 text-right">Campaigns</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-white/5">
                                <td class="px-5 py-4">
                                    <div class="font-medium text-white">{{ $admin->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $admin->email }}</div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <code id="tag-{{ $admin->id }}"
                                            class="font-mono text-sm font-bold text-indigo-300">{{ $admin->referral_code }}</code>
                                        <x-copy-button target="#tag-{{ $admin->id }}" done="Done" />
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <form method="POST" action="{{ route('admins.update', $admin) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role"
                                            class="px-2 py-1 text-xs text-white border rounded bg-slate-950 border-white/10 focus:border-indigo-500 focus:ring-0">
                                            <option value="admin" @selected($admin->role === 'admin')>admin</option>
                                            <option value="super_admin" @selected($admin->role === 'super_admin')>super_admin</option>
                                        </select>
                                        <button type="submit"
                                            class="px-2 py-1 text-[10px] font-bold text-slate-200 rounded bg-white/10 hover:bg-white/20">
                                            Save
                                        </button>
                                    </form>
                                </td>

                                <td class="px-5 py-4 text-right text-slate-300">{{ $admin->campaigns_count }}</td>

                                <td class="px-5 py-4">
                                    @if ($admin->is_disabled)
                                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-full bg-red-500/15 text-red-300">
                                            Disabled
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-widest uppercase rounded-full bg-emerald-500/15 text-emerald-300">
                                            Active
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-3">
                                        <form method="POST" action="{{ route('admins.tag', $admin) }}"
                                            onsubmit="return confirm('Rotate this tag? Links already shared keep working but stop being attributed to this admin.')">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold text-slate-300 hover:text-white">
                                                Rotate tag
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admins.toggle', $admin) }}">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold text-amber-300 hover:text-amber-200">
                                                {{ $admin->is_disabled ? 'Enable' : 'Disable' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admins.destroy', $admin) }}"
                                            onsubmit="return confirm('Delete this staff account permanently?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-red-300 hover:text-red-200">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="max-w-3xl p-6 border rounded-2xl bg-slate-900 border-white/10">
            <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase">Create a staff account</h3>
            <p class="mt-2 mb-5 text-xs text-slate-500">
                A tag is generated automatically and is guaranteed unique. Self-registration is disabled.
            </p>

            <form method="POST" action="{{ route('admins.store') }}" class="grid gap-4 sm:grid-cols-2">
                @csrf

                <div>
                    <label class="{{ $label }}" for="name">Full name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}" class="{{ $input }}">
                </div>

                <div>
                    <label class="{{ $label }}" for="email">Email</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" class="{{ $input }}">
                </div>

                <div>
                    <label class="{{ $label }}" for="role">Role</label>
                    <select id="role" name="role" class="{{ $input }}">
                        <option value="admin" @selected(old('role') === 'admin')>admin</option>
                        <option value="super_admin" @selected(old('role') === 'super_admin')>super_admin</option>
                    </select>
                </div>

                <div>
                    <label class="{{ $label }}" for="password">Temporary password</label>
                    <input id="password" name="password" type="password" required minlength="12" class="{{ $input }}">
                </div>

                <div class="sm:col-span-2">
                    <label class="{{ $label }}" for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="{{ $input }}">
                </div>

                <div class="sm:col-span-2">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition">
                        Create account
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
