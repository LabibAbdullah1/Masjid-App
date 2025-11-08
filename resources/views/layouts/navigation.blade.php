@php
    // Definisikan menu untuk Admin
    $adminMenuItems = [
        ['name' => 'Home', 'route' => 'utama', 'icon' => 'fa fa-home'],
        ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'fa fa-tachometer-alt'],
        ['name' => 'Anggota', 'route' => 'admin.anggota.index', 'icon' => 'fa fa-users'],
        ['name' => 'Keuangan', 'route' => 'transaksi.index', 'icon' => 'fa fa-wallet'],
        ['name' => 'Kategori', 'route' => 'kategori.index', 'icon' => 'fa fa-list'],
        ['name' => 'Ceramah', 'route' => 'admin.jadwal-ceramah.index', 'icon' => 'fa fa-microphone'],
        ['name' => 'Quotes', 'route' => 'admin.quote.index', 'icon' => 'fa fa-quote-left'],
        ['name' => 'Galeri', 'route' => 'admin.galeri.index', 'icon' => 'fa fa-image'],
        ['name' => 'Pesan', 'route' => 'admin.pesan.index', 'icon' => 'fa fa-envelope'],
    ];

    $umumMenuItems = [
        ['name' => 'Home', 'route' => 'utama', 'icon' => 'fa fa-home'],
        ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'fa fa-tachometer-alt'],
        ['name' => 'Keuangan', 'route' => 'umum.transaksi', 'icon' => 'fa fa-wallet'],
        ['name' => 'Galeri', 'route' => 'umum.galeri', 'icon' => 'fa fa-image'],
        ['name' => 'Ceramah', 'route' => 'umum.ceramah', 'icon' => 'fa fa-microphone'],
        ['name' => 'Kotak Pengaduan', 'route' => 'umum.pesan.create', 'icon' => 'fa fa-comment-dots'],
    ];

    // Pilih menu sesuai role
    $menuItems = Auth::check() && Auth::user()->role === 'admin' ? $adminMenuItems : $umumMenuItems;
@endphp

<nav x-data="{ open: false }" class="z-50">
    <!-- Sidebar Desktop -->
    <aside class="hidden sm:flex flex-col fixed top-0 left-0 h-screen w-64 bg-green-800 text-white shadow-lg">
        <!-- Logo -->
        <div class="flex items-center h-16 px-4 border-b border-green-700">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>

        <!-- Menu Items -->
        <div class="flex-1 overflow-y-auto py-4 space-y-1">
            @foreach ($menuItems as $item)
                <x-nav-link :href="route($item['route'])" :active="request()->routeIs($item['route'])"
                    class="block w-full text-white px-4 py-2 hover:bg-green-700 relative">
                    <i class="{{ $item['icon'] }} mr-2"></i>
                    {{ __($item['name']) }}

                    {{-- Tambahin badge khusus menu Pesan --}}
                    @if ($item['name'] === 'Pesan' && isset($unreadPesanCount) && $unreadPesanCount > 0)
                        <span
                            class="absolute top-1 right-3 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ $unreadPesanCount }}
                        </span>
                    @endif
                </x-nav-link>
            @endforeach
        </div>


        <!-- User Info -->
        <div class="border-t border-green-700 p-4">
            <div class="font-medium">{{ Auth::user()->name }}</div>
            <div class="text-sm text-yellow-200">{{ Auth::user()->email }}</div>

            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" @click="open = false">
                <i class="fa-regular fa-user mr-2"></i>
                {{ __('Kelola Profil') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit(); open = false;">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>
    </aside>

    <!-- Mobile Topbar -->
    <div
        class="sm:hidden fixed top-0 left-0 right-0 bg-green-800 text-white flex items-center justify-between h-16 px-4 shadow-lg">
        <button @click="open = true" class="p-2 rounded-md hover:bg-green-700">
            <!-- Hamburger -->
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-8 w-auto fill-current text-white" />
        </a>
    </div>

    <!-- Mobile Sidebar + Overlay -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex">
        <!-- Overlay -->
        <div @click="open = false" class="fixed inset-0 bg-black bg-opacity-50" x-transition.duration.0ms>
        </div>

        <!-- Sidebar Mobile -->
        <div class="relative w-64 bg-green-800 text-white h-full shadow-lg flex flex-col"
            x-transition:enter="transform transition ease-out duration-200" x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in duration-150"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

            <!-- Close Button -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-green-700">
                <span class="font-bold">Menu</span>
                <button @click="open = false" class="text-yellow-400 hover:text-white">
                    ✕
                </button>
            </div>

            <!-- Menu Items -->
            <div class="flex-1 overflow-y-auto py-4 space-y-1">
                @foreach ($menuItems as $item)
                    <x-responsive-nav-link :href="route($item['route'])" :active="request()->routeIs($item['route'])" @click="open = false">
                        <i class="{{ $item['icon'] }} mr-2"></i>
                        {{ __($item['name']) }}
                    </x-responsive-nav-link>
                @endforeach
            </div>

            <!-- User Info -->
            <div class="border-t border-green-700 p-4">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-sm text-yellow-200">{{ Auth::user()->email }}
                </div>

                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" @click="open = false" class="mt-4">
                    {{ __('Kelola Profil') }}
                </x-responsive-nav-link>



                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit(); open = false;">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
