<nav x-data="{ open: false }" class="bg-gradient-to-r from-sky-700 via-sky-600 to-teal-500 text-white shadow">
    @php
    $user = Auth::user();
    $isAdmin = $user && $user->role === 'admin';
    @endphp

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Title -->
                <div class="shrink-0 flex flex-col justify-center">
                    <a href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2">
                        <span class="text-base font-semibold tracking-tight">
                            Magang DPPPA
                        </span>
                    </a>
                    <span class="text-[10px] text-sky-100 uppercase tracking-[0.25em] hidden sm:block">
                        Provinsi Sumatera Selatan
                    </span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    @if($isAdmin)
                    {{-- MENU ADMIN --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center h-16 border-b-2 text-sm font-medium
                                  {{ request()->routeIs('admin.dashboard')
                                        ? 'border-white text-white'
                                        : 'border-transparent text-sky-100 hover:text-white hover:border-white/70' }}">
                        Dashboard Admin
                    </a>

                    <a href="{{ route('admin.pendaftar.index') }}"
                        class="inline-flex items-center h-16 border-b-2 text-sm font-medium
                                  {{ request()->routeIs('admin.pendaftar.*')
                                        ? 'border-white text-white'
                                        : 'border-transparent text-sky-100 hover:text-white hover:border-white/70' }}">
                        Data Pendaftar
                    </a>
                    @else
                    {{-- MENU PESERTA --}}
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center h-16 border-b-2 text-sm font-medium
                                  {{ request()->routeIs('dashboard')
                                        ? 'border-white text-white'
                                        : 'border-transparent text-sky-100 hover:text-white hover:border-white/70' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('pendaftaran.index') }}"
                        class="inline-flex items-center h-16 border-b-2 text-sm font-medium
                                  {{ request()->routeIs('pendaftaran.*')
                                        ? 'border-white text-white'
                                        : 'border-transparent text-sky-100 hover:text-white hover:border-white/70' }}">
                        Pendaftaran Magang
                    </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-white/20 text-sm leading-4 font-medium rounded-md text-white bg-white/10 hover:bg-white/20 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-sky-50 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-sky-700/95 border-t border-sky-500">
        <div class="pt-2 pb-3 space-y-1">
            @if($isAdmin)
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard Admin
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.pendaftar.index')" :active="request()->routeIs('admin.pendaftar.*')">
                Data Pendaftar
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pendaftaran.index')" :active="request()->routeIs('pendaftaran.*')">
                Pendaftaran Magang
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-sky-500">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-sky-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>