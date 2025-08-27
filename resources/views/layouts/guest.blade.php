<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIM Masjid') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon1.svg') }}">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- style and javascript --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-cover bg-center bg-fixed bg-no-repeat"
    style="background-image: url('{{ asset('images/masjid-bg.jpg') }}'); font-sans antialiased min-h-screen text-gray-800 dark:text-gray-100 selection:bg-emerald-400 selection:text-white
    transition-colors duration-500 ease-in-out">
    @guest
        <main class="flex items-center justify-center min-h-screen">
            <div class="mx-auto">
                {{ $slot }}
            </div>
        </main>
    @endguest

    @auth
        <div class="min-h-screen flex flex-col">

            {{-- Sidebar & Navigation --}}
            @include('layouts.navigation')

            {{-- Wrapper Konten --}}
            <div class="flex flex-col flex-1 sm:ml-64 mt-16 sm:mt-0">
                {{-- Page Header --}}
                @isset($header)
                    <header class="bg-gradient-to-r from-green-700 to-green-500 text-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{-- Page Content --}}
                <main class="flex-grow max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8 ">
                    @yield('content')
                </main>

                {{-- Footer --}}
                <footer class="bg-green-700 text-white mt-8">
                    <div
                        class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 sm:pl-[calc(1rem+16rem)] flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
                        <p class="text-sm">&copy; {{ date('Y') }} SIM Masjid. All rights reserved.</p>
                        <p class="text-sm">Dibuat dengan <span class="text-yellow-300">❤</span> untuk memakmurkan masjid</p>
                    </div>
                </footer>
            </div>
        </div>
    @endauth
    <x-loading />
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        const loadingElement = document.getElementById('global-loading');
        const loadingBar = document.getElementById('loading-bar');
        const loadingText = document.getElementById('loading-text');
        let progress = 0;
        let interval = null;

        // Tampilkan loading
        function showLoading() {
            if (!loadingElement) return;

            loadingElement.classList.remove('hidden');
            progress = 0;
            loadingBar.style.width = '0%';
            loadingText.textContent = 'Memuat halaman...';

            // Simpan status loading ke localStorage
            localStorage.setItem('isLoading', 'true');

            // Jalankan animasi progress
            interval = setInterval(() => {
                if (progress < 95) {
                    progress += 10;
                    loadingBar.style.width = progress + '%';
                }
            }, 300);
        }

        // Sembunyikan loading
        function hideLoading() {
            if (!loadingElement) return;

            // Penuhkan bar, ganti teks
            loadingBar.style.width = '100%';
            loadingText.textContent = 'Selesai!';

            // Beri delay biar smooth
            setTimeout(() => {
                loadingElement.classList.add('hidden');
                clearInterval(interval);
                localStorage.removeItem('isLoading');
            }, 400);
        }

        // Pasang event ke semua form
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    showLoading();
                });
            });

            // Pasang event ke semua link (opsional)
            document.querySelectorAll('a').forEach(link => {
                const href = link.getAttribute('href');
                if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
                    link.addEventListener('click', () => {
                        showLoading();
                    });
                }
            });
        });

        // Saat halaman selesai dimuat → sembunyikan loading
        window.addEventListener('load', () => {
            if (localStorage.getItem('isLoading')) {
                hideLoading();
            }
        });

        // Untuk form delete
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    showLoading();
                    this.submit();
                });
            });
        });


        AOS.init({
            duration: 800, // durasi animasi dalam ms
            easing: 'ease-out', // tipe easing
            once: true,
            mirror: false
        });
    </script>
</body>

</html>
