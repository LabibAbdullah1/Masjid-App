<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth transition-all duration-500" x-data="{ 
    theme: localStorage.getItem('theme') || 'light',
    toggleTheme() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        localStorage.setItem('theme', this.theme);
    }
}" :data-theme="theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIM Masjid') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon1.svg') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/myscript.js') }}"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-base-200 text-base-content min-h-screen"
    x-data="flashNotification()">

    <div class="drawer lg:drawer-open min-h-screen">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col">
            {{-- Modern Futuristic Navbar --}}
            <div class="navbar bg-base-100/80 backdrop-blur-md border-b border-base-200 sticky top-0 z-30 px-4">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                
                <div class="flex-1">
                    <div class="hidden lg:block">
                        <span class="text-sm font-black uppercase tracking-widest opacity-40">Islamic Digital Ecosystem</span>
                    </div>
                </div>

                <div class="flex-none gap-2">
                    {{-- Theme Toggle --}}
                    <button @click="toggleTheme()" class="btn btn-ghost btn-circle">
                        <template x-if="theme === 'light'">
                            <i class="fa-solid fa-moon text-xl"></i>
                        </template>
                        <template x-if="theme === 'dark'">
                            <i class="fa-solid fa-sun text-xl text-yellow-400"></i>
                        </template>
                    </button>
                    
                    {{-- Notifications --}}
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <i class="fa-solid fa-bell text-xl"></i>
                                <span class="badge badge-xs badge-primary indicator-item"></span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Page Header with Linear Gradient --}}
            @isset($header)
                <div class="futuristic-bg text-white px-4 py-12 mb-6 shadow-2xl overflow-hidden relative">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="max-w-7xl mx-auto relative z-10" data-aos="fade-right">
                        <h1 class="text-4xl lg:text-5xl font-black tracking-tighter">{{ $header }}</h1>
                        <p class="mt-2 text-white/80 font-bold uppercase text-xs tracking-[0.3em]">Masjid Digital Hub</p>
                    </div>
                </div>
            @endisset

            {{-- Main Content Space --}}
            <main class="flex-grow p-4 lg:p-8 relative">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            <footer class="footer footer-center p-10 bg-base-300/50 backdrop-blur-sm text-base-content rounded mt-auto border-t border-base-200">
                <div>
                    <div class="p-4 bg-primary/10 rounded-full mb-4">
                        <i class="fa fa-mosque text-3xl text-primary"></i>
                    </div>
                    <p class="font-black text-lg tracking-tight">
                        {{ config('app.name', 'SIM Masjid') }}
                    </p> 
                    <p class="text-xs opacity-50 font-bold uppercase">Modernizing Faith Through Technology</p>
                    <p class="text-xs mt-4">© {{ date('Y') }} - Excellence in Mosque Management</p>
                </div>
            </footer>
        </div>

        {{-- Sidebar --}}
        <div class="drawer-side z-40 shadow-2xl">
            <label for="my-drawer" class="drawer-overlay"></label>
            @include('layouts.navigation')
        </div>
    </div>

    <x-loading />
    @include('partials.notification')
    @stack('scripts')

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
            });

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    this.submit();
                });
            });
        });

        document.addEventListener('alpine:init', () => {
            @if (session('success'))
                Alpine.store('notification').showSuccess("{{ session('success') }}");
            @endif

            @if (session('error'))
                Alpine.store('notification').showError("{{ session('error') }}", false);
            @endif
        });
    </script>
</body>
</html>
