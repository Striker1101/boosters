<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admins Management
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Success --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Create --}}
        <button onclick="openCreateModal()"
            class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Admin
        </button>

        {{-- Filters --}}
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..."
                class="flex-1 p-2 border rounded" />

            <select name="is_disabled" class="p-2 border rounded">
                <option value="">All</option>
                <option value="0" @selected(request('is_disabled') === '0')>Enabled</option>
                <option value="1" @selected(request('is_disabled') === '1')>Disabled</option>
            </select>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Filter
            </button>
        </form>

        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Ref ID</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Disabled</th>
                        <th class="px-4 py-2">Created</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($admins as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $admin->id }}</td>
                            <td class="px-4 py-2">
                                {{ $admin->name }}
                                @if ($admin->is(Auth::user()))
                                    <span class="text-xs text-gray-500">(you)</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $admin->email }}</td>

                            <td class="px-4 py-2">
                                <span class="font-mono text-sm" id="ref-id-{{ $admin->id }}">{{ $admin->ref_id ?: '—' }}</span>
                                @if ($admin->ref_id)
                                    <button type="button"
                                        onclick="copyRefLink('{{ $admin->refLink() }}')"
                                        class="ml-1 text-xs text-blue-600 underline hover:text-blue-800">
                                        copy link
                                    </button>
                                @endif
                                <button type="button"
                                    onclick="editRefId({{ $admin->id }}, '{{ $admin->ref_id }}')"
                                    class="ml-1 text-xs text-gray-600 underline hover:text-gray-800">
                                    edit
                                </button>
                            </td>

                            <td class="px-4 py-2">
                                <select class="border rounded p-1"
                                    onchange="changeRole({{ $admin->id }}, this)"
                                    @disabled($admin->is(Auth::user()))>
                                    <option value="admin" @selected($admin->role === 'admin')>admin</option>
                                    <option value="super_admin" @selected($admin->role === 'super_admin')>super_admin</option>
                                </select>
                            </td>

                            <td class="px-4 py-2">
                                <input type="checkbox" {{ $admin->is_disabled ? 'checked' : '' }}
                                    @disabled($admin->is(Auth::user()))
                                    onchange="toggleAdminStatus({{ $admin->id }}, this)">
                            </td>

                            <td class="px-4 py-2">
                                {{ $admin->created_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-2">
                                @unless ($admin->is(Auth::user()))
                                    <form method="POST" action="{{ route('admins.destroy', $admin->id) }}"
                                        onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:text-red-800 underline">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">No admins found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CREATE MODAL --}}
    <div id="adminModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h3 class="font-bold text-lg mb-4">Create Admin</h3>

            <form method="POST" action="{{ route('admins.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border rounded p-2">
                    @error('name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border rounded p-2">
                    @error('email')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border rounded p-2">
                    @error('password')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Role</label>
                    <select name="role" class="w-full border rounded p-2">
                        <option value="admin" @selected(old('role') === 'admin')>admin</option>
                        <option value="super_admin" @selected(old('role') === 'super_admin')>super_admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 border rounded">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- PURE JS --}}
    <script>
        const adminModal = document.getElementById('adminModal');

        function openCreateModal() {
            adminModal.classList.remove('hidden');
            adminModal.classList.add('flex');
        }

        function closeCreateModal() {
            adminModal.classList.add('hidden');
            adminModal.classList.remove('flex');
        }

        function toast(text, success) {
            Toastify({
                text: text,
                duration: 2000,
                gravity: "bottom",
                position: "right",
                backgroundColor: success ? "#10B981" : "#EF4444"
            }).showToast();
        }

        function copyRefLink(link) {
            navigator.clipboard.writeText(link)
                .then(() => toast('Ref link copied', true))
                .catch(() => toast('Copy failed', false));
        }

        function editRefId(id, current) {
            const refId = window.prompt('Set ref id for this admin:', current || '');
            if (refId === null) {
                return;
            }

            fetch(`/admins/${id}/ref-id`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ref_id: refId.trim()
                    })
                })
                .then(r => r.json().then(data => ({
                    ok: r.ok,
                    data
                })))
                .then(({
                    ok,
                    data
                }) => {
                    if (!ok || !data.success) {
                        toast(data.message || 'Ref id update failed', false);
                        return;
                    }

                    const label = document.getElementById(`ref-id-${id}`);
                    if (label) label.textContent = data.ref_id;

                    toast('Ref id updated', true);
                    setTimeout(() => window.location.reload(), 600);
                })
                .catch(() => toast('Server error', false));
        }

        function toggleAdminStatus(id, checkbox) {
            fetch(`/admins/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(r => r.json().then(data => ({
                    ok: r.ok,
                    data
                })))
                .then(({
                    ok,
                    data
                }) => {
                    if (!ok || !data.success) {
                        checkbox.checked = !checkbox.checked;
                        toast(data.message || 'Update failed', false);
                        return;
                    }

                    toast(data.is_disabled ? 'Admin disabled' : 'Admin enabled', true);
                })
                .catch(() => {
                    checkbox.checked = !checkbox.checked;
                    toast("Server error", false);
                });
        }

        function changeRole(id, select) {
            const previous = select.dataset.previous ?? select.value;
            select.dataset.previous = select.value;

            fetch(`/admins/${id}/role`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        role: select.value
                    })
                })
                .then(r => r.json().then(data => ({
                    ok: r.ok,
                    data
                })))
                .then(({
                    ok,
                    data
                }) => {
                    if (!ok || !data.success) {
                        select.value = previous;
                        toast(data.message || 'Update failed', false);
                        return;
                    }

                    select.dataset.previous = data.role;
                    toast('Role updated to ' + data.role, true);
                })
                .catch(() => {
                    select.value = previous;
                    toast("Server error", false);
                });
        }

        function confirmDelete(e) {
            return window.confirm(
                "⚠️ This action is irreversible.\n\nDo you really want to delete this admin?"
            );
        }

        @if ($errors->any())
            openCreateModal();
        @endif
    </script>
</x-app-layout>
