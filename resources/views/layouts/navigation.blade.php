@php
    $user = Auth::user();
    $navBase = 'px-3 py-2 text-sm font-medium rounded-lg transition-colors';
@endphp

<nav x-data="{ open: false }" class="bg-slate-900 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('logo.svg') }}" alt="" class="w-8 h-8">
                    <span class="text-lg font-bold tracking-tight text-white">{{ config('custom.title') }}</span>
                    <span
                        class="hidden sm:inline px-2 py-0.5 text-[10px] font-bold tracking-widest uppercase rounded-full bg-indigo-500/15 text-indigo-300 border border-indigo-500/30">
                        Awareness
                    </span>
                </a>

                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}"
                        class="{{ $navBase }} {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('campaigns.create') }}"
                        class="{{ $navBase }} {{ request()->routeIs('campaigns.create') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        New campaign
                    </a>
                    <a href="{{ route('tutorial') }}"
                        class="{{ $navBase }} {{ request()->routeIs('tutorial') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        How it works
                    </a>
                    @if ($user?->isSuperAdmin())
                        <a href="{{ route('admins.index') }}"
                            class="{{ $navBase }} {{ request()->routeIs('admins.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            Staff
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <div class="text-right leading-tight">
                    <div class="text-xs text-slate-500">Your tag</div>
                    <div class="font-mono text-sm font-bold text-indigo-300">{{ $user?->referral_code }}</div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg text-slate-300 hover:text-white hover:bg-white/5 focus:outline-none transition">
                            <span
                                class="flex items-center justify-center w-7 h-7 text-xs font-bold rounded-full bg-indigo-500/20 text-indigo-300">
                                {{ strtoupper(substr($user?->name ?? '?', 0, 1)) }}
                            </span>
                            <span>{{ $user?->name }}</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ $user?->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user?->email }}</p>
                            <p class="mt-1 text-xs">
                                <span class="font-semibold text-gray-700">{{ $user?->role }}</span>
                            </p>
                        </div>

                        <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                        <x-dropdown-link :href="route('tutorial')">How it works</x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-white/5 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-white/5">
        <div class="px-4 py-3 space-y-1">
            <div class="pb-3 mb-2 border-b border-white/5">
                <div class="text-xs text-slate-500">Your tag</div>
                <div class="font-mono text-sm font-bold text-indigo-300">{{ $user?->referral_code }}</div>
            </div>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-white/5">Dashboard</a>
            <a href="{{ route('campaigns.create') }}" class="block px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-white/5">New campaign</a>
            <a href="{{ route('tutorial') }}" class="block px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-white/5">How it works</a>
            @if ($user?->isSuperAdmin())
                <a href="{{ route('admins.index') }}" class="block px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-white/5">Staff</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full px-3 py-2 text-sm text-left text-slate-300 rounded-lg hover:bg-white/5">
                    Log out
                </button>
            </form>
        </div>
    </div>
</nav>
