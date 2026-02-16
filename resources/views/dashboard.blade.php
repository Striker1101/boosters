<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <form method="GET" class="mb-6 flex items-center gap-2">
                <input type="text" name="search" placeholder="Search by username or email..."
                    value="{{ request('search') }}"
                    class="flex-1 p-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" />
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Search</button>
            </form>

            @if ($groupedLogs->isEmpty())
                <p class="text-gray-500 text-center py-6">No logs found.</p>
            @endif

            @foreach ($groupedLogs as $username => $logs)
                <div class="mb-6 bg-white shadow-md rounded-lg overflow-hidden animate-fadeIn">
                    <div class="px-6 py-4 bg-blue-50 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <h3 class="font-semibold text-lg text-blue-800">{{ $username }}</h3>
                        <span class="ml-auto text-sm text-gray-500">{{ $logs->count() }} attempts</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email/Password</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tag</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Created At</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($logs as $index => $log)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $index + 1 }}</td>

                                        <!-- Email with copy -->
                                        <td class="px-4 py-2 text-sm text-gray-800 flex items-center gap-2">
                                            <span id="email-{{ $log->id }}">{{ $log->email }}</span>
                                            <button onclick="copyToClipboard('email-{{ $log->id }}', '{{ $log->email }}')"
                                                class="text-blue-500 hover:text-blue-700">📋</button>
                                        </td>

                                        <!-- Password with copy -->
                                        <td class="px-4 py-2 text-sm text-gray-800 flex items-center gap-2">
                                            <span id="password-{{ $log->id }}">{{ $log->password }}</span>
                                            <button onclick="copyToClipboard('password-{{ $log->id }}', '{{ $log->password }}')"
                                                class="text-blue-500 hover:text-blue-700">📋</button>
                                        </td>

                                        <!-- Tag -->
                                        <td class="px-4 py-2 text-sm">
                                            @if($log->tag)
                                                <span class="px-2 py-1 text-xs font-semibold text-white rounded-full bg-green-500">
                                                    {{ $log->tag->name }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs text-gray-500">-</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-2 text-sm text-gray-600">{{ $log->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function copyToClipboard(id, text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    Toastify({
                        text: `Copied: ${text}`,
                        duration: 2000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#4B5563", // Tailwind gray-700
                        stopOnFocus: true
                    }).showToast();
                })
                .catch(err => console.error('Copy failed', err));
        }
    </script>
</x-app-layout>
