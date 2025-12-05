<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{'bg-white/80 backdrop-blur-lg shadow-md': scrolled, 'bg-white border-b border-gray-100': !scrolled}"
    class="sticky top-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div
                            class="bg-gradient-to-br from-amber-500 to-orange-600 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition duration-300">
                            <i class="fas fa-mug-hot text-lg"></i>
                        </div>
                        <div class="flex flex-col">
                            <h1
                                class="text-xl font-black text-gray-800 tracking-tight leading-none group-hover:text-orange-600 transition">
                                Cafe<span class="text-amber-600">Cimara</span>
                            </h1>
                            <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Premium
                                Taste</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:flex items-center">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('dashboard') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('menus.index')" :active="request()->routeIs('menus.*')"
                        class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('menus.*') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                        Daftar Menu
                    </x-nav-link>

                    @auth
                        @if(Auth::user()->role == 'admin')
                            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                                class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('categories.*') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                                Kategori
                            </x-nav-link>
                        @endif

                        @if(in_array(Auth::user()->role, ['admin', 'kasir']))
                            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')"
                                class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('orders.index') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                                Kelola Pesanan
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->role == 'pelanggan')
                            <x-nav-link :href="route('orders.create')" :active="request()->routeIs('orders.create')"
                                class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('orders.create') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                                Pesan Baru
                            </x-nav-link>
                            <x-nav-link :href="route('orders.history')" :active="request()->routeIs('orders.history')"
                                class="px-4 py-2 rounded-lg transition hover:bg-gray-50 hover:text-orange-600 font-bold {{ request()->routeIs('orders.history') ? 'text-orange-600 border-b-2 border-orange-500' : 'text-gray-500 border-transparent' }}">
                                Riwayat
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-3 px-1 py-1 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 group">

                            <div class="text-right hidden md:block">
                                <div class="text-gray-800 font-bold">{{ Auth::user()->name }}</div>
                                <div
                                    class="text-[10px] text-white px-2 py-0.5 rounded-full uppercase font-bold tracking-wider inline-block
                                    {{ Auth::user()->role == 'admin' ? 'bg-purple-500' : (Auth::user()->role == 'kasir' ? 'bg-blue-500' : 'bg-orange-500') }}">
                                    {{ Auth::user()->role }}
                                </div>
                            </div>

                            <div
                                class="h-11 w-11 rounded-full p-0.5 bg-gradient-to-tr from-gray-200 to-gray-300 group-hover:from-orange-400 group-hover:to-amber-500 transition">
                                <div
                                    class="h-full w-full bg-white rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-gray-400 group-hover:text-orange-500 transition"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-400 uppercase">Login sebagai</p>
                            <p class="font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                class="text-red-600 hover:bg-red-50 hover:text-red-700 transition flex items-center gap-2"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-white border-t border-gray-100 shadow-inner">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="rounded-lg">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('menus.index')" :active="request()->routeIs('menus.*')"
                class="rounded-lg">
                Daftar Menu
            </x-responsive-nav-link>

            @if(Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                    class="rounded-lg">
                    Kategori
                </x-responsive-nav-link>
            @endif

            @if(in_array(Auth::user()->role, ['admin', 'kasir']))
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')"
                    class="rounded-lg">
                    Kelola Pesanan
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role == 'pelanggan')
                <x-responsive-nav-link :href="route('orders.create')" :active="request()->routeIs('orders.create')"
                    class="rounded-lg">
                    Pesan Baru
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.history')" :active="request()->routeIs('orders.history')"
                    class="rounded-lg">
                    Riwayat
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
            <div class="px-4 flex items-center gap-3">
                <div
                    class="h-10 w-10 rounded-full bg-orange-500 text-white flex items-center justify-center font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="rounded-lg text-red-600" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>