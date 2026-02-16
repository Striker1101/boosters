<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tags Management</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Tag -->
        <button onclick="openCreateModal()"
            class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Tag
        </button>

        <!-- Tags Table -->
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Image</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $tag->id }}</td>
                            <td class="px-4 py-2">{{ $tag->name }}</td>
                            <td class="px-4 py-2">{{ $tag->image ?? '-' }}</td>
                            <td class="px-4 py-2 flex gap-2">

                                <button onclick="openEditModal({{ $tag->id }}, '{{ $tag->name }}', '{{ $tag->image }}')"
                                    class="text-blue-600 underline">
                                    Edit
                                </button>

                                <form method="POST"
                                      action="{{ route('tags.destroy', $tag->id) }}"
                                      onsubmit="return confirm('Delete this tag?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 underline">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL -->
    <div id="tagModal"
         class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-md rounded-lg p-6">
            <h3 id="modalTitle" class="text-lg font-bold mb-4"></h3>

            <form id="tagForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="methodField">

                <div class="mb-3">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" id="tagName"
                        class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Image (optional)</label>
                    <input type="text" name="image" id="tagImage"
                        class="w-full border rounded p-2">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border rounded">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PURE JS -->
    <script>
        const modal = document.getElementById('tagModal');
        const form = document.getElementById('tagForm');
        const methodField = document.getElementById('methodField');
        const title = document.getElementById('modalTitle');

        function openCreateModal() {
            title.innerText = 'Create Tag';
            form.action = "{{ route('tags.store') }}";
            methodField.value = 'POST';
            document.getElementById('tagName').value = '';
            document.getElementById('tagImage').value = '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditModal(id, name, image) {
            title.innerText = 'Edit Tag';
            form.action = `/tags/${id}`;
            methodField.value = 'PATCH';
            document.getElementById('tagName').value = name;
            document.getElementById('tagImage').value = image ?? '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</x-app-layout>
