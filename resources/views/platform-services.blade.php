<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold leading-tight text-gray-900 flex items-center gap-2">
                    <span>Platform & Service Links</span>
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    Generate and share targeted promotional links. When visitors use your link, their attempts will automatically attribute to your dashboard.
                </p>
            </div>

            <!-- Admin Ref ID Badge -->
            <div class="flex items-center gap-2 bg-indigo-50 border border-indigo-200 px-4 py-2 rounded-xl text-xs">
                <span class="text-gray-600 font-medium">Your Ref ID:</span>
                <span id="admin_ref_id" class="font-mono font-bold text-indigo-700 bg-white px-2.5 py-1 rounded-md border border-indigo-200">
                    {{ $user->ref_id }}
                </span>
                <button type="button" onclick="copyText('{{ $user->ref_id }}', this)"
                    class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors flex items-center gap-1 ml-1"
                    title="Copy Ref ID">
                    <i class="fa-regular fa-copy"></i>
                    <span>Copy</span>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Filter & Search Toolbar -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                <!-- Search -->
                <div class="relative flex-1 max-w-md">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
                    <input type="text" id="service_search" onkeyup="filterServices()"
                        placeholder="Search service, platform, or slug..."
                        class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>

                <!-- Platform Filter Pills -->
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
                    <button type="button" onclick="setPlatformFilter('all', this)"
                        class="platform-filter-btn active-filter px-3.5 py-1.5 rounded-full text-xs font-bold transition-all bg-indigo-600 text-white shadow-sm">
                        All ({{ count($offers) }})
                    </button>
                    @foreach($platforms as $p)
                        <button type="button" onclick="setPlatformFilter('{{ $p }}', this)"
                            class="platform-filter-btn px-3 py-1.5 rounded-full text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all capitalize whitespace-nowrap">
                            {{ $p }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Services Grid -->
            <div id="services_container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($offers as $offer)
                    <div class="service-card bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                        data-platform="{{ $offer['platform'] }}"
                        data-service="{{ strtolower($offer['text']) }}"
                        data-slug="{{ $offer['slug'] }}">

                        <div>
                            <!-- Card Header: Platform & Unit Badge -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700">
                                        <i class="fa-brands fa-{{ $offer['icon'] ?? 'star' }} text-lg"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs uppercase font-extrabold tracking-wider text-gray-800 block capitalize">
                                            {{ $offer['platform'] }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-mono">
                                            {{ $offer['slug'] }}
                                        </span>
                                    </div>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-100">
                                    {{ $offer['unit'] ?? 'HOT' }}
                                </span>
                            </div>

                            <!-- Service Title & Image Preview -->
                            <div class="flex items-center gap-3 my-4">
                                @if(!empty($offer['image']))
                                    <img src="{{ asset('images/' . $offer['image']) }}" alt="{{ $offer['text'] }}"
                                        class="w-12 h-12 object-contain shrink-0">
                                @endif
                                <div>
                                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                                        {{ $offer['text'] }}
                                    </h3>
                                    <span class="text-xs text-emerald-600 font-medium flex items-center gap-1 mt-0.5">
                                        <i class="fa-solid fa-bolt text-[10px]"></i> Instant Delivery Included
                                    </span>
                                </div>
                            </div>

                            <!-- URL Box (Catalog Auto-Modal Link) -->
                            <div class="space-y-3 my-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">
                                        Direct Share Link (Attributed)
                                    </label>
                                    <div class="relative">
                                        <input type="text" readonly value="{{ $offer['catalog_url'] }}"
                                            id="link_{{ $offer['slug'] }}"
                                            class="w-full text-xs font-mono bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-gray-600 select-all pr-9 focus:outline-none">
                                        <button type="button" onclick="copyInput('link_{{ $offer['slug'] }}', this)"
                                            class="absolute right-2 top-2 text-gray-400 hover:text-indigo-600 transition-colors"
                                            title="Quick Copy">
                                            <i class="fa-regular fa-copy text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="text-[11px] text-gray-400 flex items-center justify-between">
                                    <span>Attributed to Ref: <strong class="text-gray-700 font-mono">{{ $user->ref_id }}</strong></span>
                                    <a href="{{ $offer['catalog_url'] }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-800 font-semibold hover:underline flex items-center gap-1">
                                        <span>Test</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="pt-4 border-t border-gray-100 flex items-center gap-2">
                            <button type="button" onclick="copyUrl('{{ $offer['catalog_url'] }}', this)"
                                class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                                <i class="fa-regular fa-copy"></i>
                                <span>Copy Link</span>
                            </button>

                            <button type="button" onclick="copyUrl('{{ $offer['direct_login_url'] }}', this)"
                                class="py-2.5 px-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs rounded-xl transition-colors"
                                title="Copy Direct Platform Login Link">
                                <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> Login URL
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            <div id="no_services_found" class="hidden bg-white p-12 rounded-2xl border border-gray-100 text-center">
                <i class="fa-solid fa-filter text-4xl text-gray-300 mb-3"></i>
                <h3 class="text-base font-bold text-gray-700">No Services Found</h3>
                <p class="text-xs text-gray-400 mt-1">Try changing your search term or select "All" platforms.</p>
            </div>
        </div>
    </div>

    <!-- Global Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-gray-900 text-white px-5 py-3 rounded-2xl shadow-xl border border-white/10 flex items-center gap-3 text-xs">
            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                <i class="fa-solid fa-check text-xs"></i>
            </span>
            <div>
                <strong class="block font-bold text-sm">Link Copied!</strong>
                <span class="text-gray-300">Your referral ID has been attached to the URL.</span>
            </div>
        </div>
    </div>

    <script>
        let currentPlatform = 'all';

        function showToast(message) {
            const toast = document.getElementById('toast');
            if (message) {
                toast.querySelector('span.text-gray-300').innerText = message;
            }
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 3000);
        }

        function copyUrl(url, btn) {
            navigator.clipboard.writeText(url).then(() => {
                const originalHtml = btn.innerHTML;
                btn.classList.replace('bg-indigo-600', 'bg-emerald-600');
                btn.classList.replace('hover:bg-indigo-700', 'hover:bg-emerald-700');
                btn.innerHTML = '<i class="fa-solid fa-check"></i> <span>Copied!</span>';
                showToast('Share link copied to clipboard.');
                setTimeout(() => {
                    btn.classList.replace('bg-emerald-600', 'bg-indigo-600');
                    btn.classList.replace('hover:bg-emerald-700', 'hover:bg-indigo-700');
                    btn.innerHTML = originalHtml;
                }, 2000);
            });
        }

        function copyInput(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input) {
                input.select();
                navigator.clipboard.writeText(input.value).then(() => {
                    const originalClass = btn.innerHTML;
                    btn.innerHTML = '<i class="fa-solid fa-check text-emerald-600 text-sm"></i>';
                    showToast('Share link copied to clipboard.');
                    setTimeout(() => {
                        btn.innerHTML = originalClass;
                    }, 2000);
                });
            }
        }

        function copyText(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const original = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check text-emerald-600"></i> <span>Copied!</span>';
                showToast('Ref ID copied: ' + text);
                setTimeout(() => {
                    btn.innerHTML = original;
                }, 2000);
            });
        }

        function setPlatformFilter(platform, btn) {
            currentPlatform = platform;
            document.querySelectorAll('.platform-filter-btn').forEach(b => {
                b.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm', 'active-filter');
                b.classList.add('bg-gray-100', 'text-gray-600');
            });
            btn.classList.add('bg-indigo-600', 'text-white', 'shadow-sm', 'active-filter');
            btn.classList.remove('bg-gray-100', 'text-gray-600');
            filterServices();
        }

        function filterServices() {
            const query = (document.getElementById('service_search')?.value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.service-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const p = card.getAttribute('data-platform');
                const s = card.getAttribute('data-service');
                const slug = card.getAttribute('data-slug');

                const matchesPlatform = (currentPlatform === 'all' || p === currentPlatform);
                const matchesQuery = !query || p.includes(query) || s.includes(query) || slug.includes(query);

                if (matchesPlatform && matchesQuery) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const emptyState = document.getElementById('no_services_found');
            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0);
            }
        }
    </script>
</x-app-layout>
