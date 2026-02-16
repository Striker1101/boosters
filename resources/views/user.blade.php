<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users Management
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Success --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filters --}}
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
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
                        <th class="px-4 py-2">Referral Code</th>
                        <th class="px-4 py-2">Referral ID</th>
                        <th class="px-4 py-2">Referrals</th>
                        <th class="px-4 py-2">Logs</th>
                        <th class="px-4 py-2">Disabled</th>
                        <th class="px-4 py-2">Created</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->referral_code }}</td>
                            <td class="px-4 py-2">{{ $user->referral_id }}</td>

                            <td class="px-4 py-2">
                                <button onclick="openReferrals({{ $user->id }})" class="text-blue-600 underline">
                                    {{ $user->referred_users_count }}
                                </button>
                            </td>

                            <td class="px-4 py-2">
                                <button onclick="openLogs({{ $user->id }})" class="text-blue-600 underline">
                                    {{ $user->logs_count }}
                                </button>
                            </td>

                            <td class="px-4 py-2">
                                <input type="checkbox" {{ $user->is_disabled ? 'checked' : '' }}
                                    onchange="toggleUserStatus({{ $user->id }}, this)">
                            </td>

                            <td class="px-4 py-2">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-2">
                                <form method="POST" action="{{ route('user.delete', $user->id) }}"
                                    onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800 underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL --}}
    <div id="modal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg w-full max-w-xl p-6">
            <h3 id="modal-title" class="font-bold text-lg mb-4"></h3>

            <ul id="modal-list" class="max-h-80 overflow-y-auto divide-y"></ul>

            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                Close
            </button>
        </div>
    </div>

    {{-- PURE JS --}}
    <script>
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalList = document.getElementById('modal-list');

        function openModal(title, items, type) {
            modalTitle.textContent = title;
            modalList.innerHTML = '';

            if (!items.length) {
                modalList.innerHTML =
                    `<li class="p-2 text-gray-500">No records found</li>`;
            } else {
                items.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'p-2 flex justify-between';

                    li.innerHTML = type === 'referrals' ?
                        `<span>${item.name}</span>
                           <span>${item.referral_code}</span>
                           <span>${item.referral_id}</span>
                           ` :
                        `<span>${item.email}</span>
                           <span>${new Date(item.created_at).toDateString()}</span>`;

                    modalList.appendChild(li);
                });
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        function openReferrals(id) {
            fetch(`/user/${id}/referrals`)
                .then(r => r.json())
                .then(d => openModal('Referred Users', d, 'referrals'));
        }

        function openLogs(id) {
            fetch(`/user/${id}/logs`)
                .then(r => r.json())
                .then(d => openModal('Logs', d, 'logs'));
        }

        function toggleUserStatus(id, checkbox) {
            fetch(`/user/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(r => r.json())
                .then(d => {
                    Toastify({
                        text: d.success ?
                            (d.is_disabled ? 'User disabled' : 'User enabled') :
                            'Update failed',
                        duration: 2000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: d.success ? "#10B981" : "#EF4444"
                    }).showToast();

                    if (!d.success) checkbox.checked = !checkbox.checked;
                })
                .catch(() => {
                    checkbox.checked = !checkbox.checked;
                    Toastify({
                        text: "Server error",
                        duration: 2000,
                        backgroundColor: "#EF4444"
                    }).showToast();
                });
        }
    </script>

    <script>
    function confirmDelete(e) {
        return window.confirm(
            "⚠️ This action is irreversible.\n\nDo you really want to delete this user?"
        );
    }
</script>
</x-app-layout>
