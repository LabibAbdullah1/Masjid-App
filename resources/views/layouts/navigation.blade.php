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

<div class="flex flex-col h-full bg-base-100/60 backdrop-blur-2xl text-base-content min-h-screen border-r border-base-200/50">
    <!-- Logo & Brand with Moving Background -->
    <div class="p-8 futuristic-bg text-white shadow-lg overflow-hidden relative">
        <div class="absolute inset-0 bg-black/10"></div>
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 relative z-10 transition-transform active:scale-95">
            <div class="p-2 bg-white/20 backdrop-blur-md rounded-xl border border-white/30">
                <i class="fa fa-mosque text-2xl text-white"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-black uppercase tracking-tighter leading-none">
                    {{ config('app.name', 'SIM Masjid') }}
                </span>
                <span class="text-[9px] font-bold uppercase tracking-[0.3em] opacity-80 mt-1">Management Hub</span>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-8 px-4">
        <ul class="menu menu-md w-full gap-2 p-0">
            <li class="menu-title text-[10px] uppercase opacity-30 font-black tracking-[0.2em] mb-4 px-4">Core Ecosystem</li>
            @foreach ($menuItems as $item)
                <li>
                    <a href="{{ route($item['route']) }}" 
                       class="{{ request()->routeIs($item['route']) ? 'active futuristic-bg text-white shadow-lg font-black' : 'hover:bg-primary/10 hover:text-primary font-bold opacity-60 hover:opacity-100' }} flex items-center gap-4 py-4 rounded-2xl transition-all duration-300">
                        <i class="{{ $item['icon'] }} w-6 text-xl text-center"></i>
                        <span class="tracking-tight">{{ __($item['name']) }}</span>
                        
                        @if ($item['name'] === 'Pesan' && isset($unreadPesanCount) && $unreadPesanCount > 0)
                            <span class="badge badge-error badge-sm text-white ml-auto">{{ $unreadPesanCount }}</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- User Profile & Footer Info -->
    <div class="p-4 bg-base-300/30 backdrop-blur-md border-t border-base-200/50">
        <div class="dropdown dropdown-top w-full">
            <div tabindex="0" role="button" class="btn btn-ghost h-auto py-3 w-full flex items-center justify-start gap-4 px-3 rounded-2xl hover:bg-white/10 transition-all border border-transparent hover:border-white/10 group">
                <div class="avatar online placeholder group-hover:scale-110 transition-transform">
                    <div class="bg-primary text-primary-content rounded-xl w-12 shadow-lg ring ring-primary ring-offset-base-100 ring-offset-2">
                        <span class="text-lg font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-start overflow-hidden">
                    <span class="text-sm font-black truncate w-32 tracking-tight">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] font-bold uppercase opacity-40 truncate w-32 tracking-wider">{{ Auth::user()->role ?? 'User' }}</span>
                </div>
                <i class="fa-solid fa-chevron-up ml-auto opacity-20 text-xs"></i>
            </div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-2xl bg-base-100/90 backdrop-blur-xl rounded-2xl w-full mb-3 border border-base-200">
                <li>
                    <a href="{{ route('profile.edit') }}" class="py-3 font-bold">
                        <i class="fa-regular fa-user-circle text-lg text-primary mr-2"></i>
                        {{ __('Update Profile') }}
                    </a>
                </li>
                <div class="divider my-0 opacity-10"></div>
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-error py-3 font-bold">
                        <i class="fa-solid fa-power-off text-lg mr-2"></i>
                        Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
