<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Al-Falah</title>

    {{-- logo --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('/favicon1.svg') }}">

    <!-- Tailwind CDN -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans antialiased text-black bg-cover bg-center bg-fixed bg-no-repeat"
    style="background-image: url('{{ asset('images/masjid-bg.jpg') }}');">

    {{-- mian --}}
    <section class=" min-h-screen flex flex-col">
        {{-- Overlay --}}
        <div class="overlay flex flex-col flex-1" id="beranda">
            {{-- Navbar --}}
            <nav
                class=" bg-green-800/70 backdrop-blur-lg shadow-xl p-4 flex justify-between items-center fixed w-full top-0 z-20 transition-all duration-300 transform translate-y-0">
                <div class="flex items-center">
                    <span class="text-xl font-extrabold md:text-3xl text-yellow-300 dark:text-yellow-400 font-serif">
                        Masjid Al-Falah
                    </span>
                </div>
                {{-- Desktop Menu Start --}}
                <div class="hidden md:flex space-x-6 z-10 font-bold">
                    <a href="#beranda"
                        class="text-white hover:text-yellow-400 transition-colors duration-300 ease-in-out transform hover:scale-110">Beranda</a>
                    <a href="#tentang"
                        class="text-white hover:text-yellow-400 transition-colors duration-300 ease-in-out transform hover:scale-110">Tentang</a>
                    <a href="#kegiatan"
                        class="text-white hover:text-yellow-400 transition-colors duration-300 ease-in-out transform hover:scale-110">Kegiatan</a>
                    <a href="#kontak"
                        class="text-white hover:text-yellow-400 transition-colors duration-300 ease-in-out transform hover:scale-110">Kontak</a>
                </div>
                {{-- Desktop menu End --}}
                {{-- Mobile Tombol menu  --}}
                <div class="md:hidden">
                    <button id="menu-button" class="text-white focus:outline-none transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7">
                            </path>
                        </svg>
                    </button>
                </div>
                {{-- Mobile Tombol Menu End --}}
            </nav>

            {{-- Mobile Menu Dropdown Start --}}
            <div id="mobile-menu"
                class="hidden md:hidden bg-green-800/70 backdrop-blur-lg shadow-xl p-4 space-y-4 fixed w-full top-16 z-[40]">
                <a href="#beranda"
                    class="block text-center text-white hover:bg-green-700 p-2 rounded-md transition-colors font-bold text-lg">Beranda</a>
                <a href="#tentang"
                    class="block text-center text-white hover:bg-green-700 p-2 rounded-md transition-colors font-bold text-lg">Tentang</a>
                <a href="#kegiatan"
                    class="block text-center text-white hover:bg-green-700 p-2 rounded-md transition-colors font-bold text-lg">Kegiatan</a>
                <a href="#kontak"
                    class="block text-center text-white hover:bg-green-700 p-2 rounded-md transition-colors font-bold text-lg">Kontak</a>
            </div>
            {{-- Mobile Menu Dropdown End --}}
            {{-- End Navbar --}}

            {{-- Hero Content Start--}}
            <div class="flex-1 flex flex-col justify-center items-center text-center px-6 " data-aos="fade-up"
                data-aos-delay="300">
                <h2 class="text-4xl md:text-6xl font-extrabold mb-4 text-yellow-300 drop-shadow-lg">
                    Selamat Datang di Masjid Al-Falah
                </h2>
                <p class="max-w-2xl text-lg md:text-xl text-black font-semibold">
                    Masjid Al-Falah adalah pusat ibadah, pembelajaran, dan kebersamaan umat Islam.
                    Bergabunglah dengan kami dalam kegiatan keagamaan dan sosial.
                </p>
                <div class="mt-6 flex gap-4" data-aos="fade-up" data-aos-delay="500">
                    @auth
                        {{-- Kalau user sudah login --}}
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-3 bg-yellow-400 text-gray-900 font-bold rounded-lg shadow-xl hover:bg-yellow-300 transition-all hover:scale-105">
                            Dashboard System
                        </a>
                    @endauth

                    @guest
                        {{-- Kalau user belum login --}}
                        <a href="{{ route('login') }}"
                            class="px-5 py-3 bg-yellow-400 text-gray-900 font-bold rounded-lg shadow-xl hover:bg-yellow-300 transition-all hover:scale-105">
                            Access Portal
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-3 bg-white/10 backdrop-blur-md border-2 border-yellow-400 text-yellow-400 font-bold rounded-lg shadow-xl hover:bg-yellow-400 hover:text-gray-900 transition-all hover:scale-105">
                            Register Identity
                        </a>
                    @endguest
                </div>

                {{-- Financial Transparency Bar (NEW) --}}
                <div class="mt-12 w-full max-w-4xl mx-auto hidden md:block" data-aos="fade-up" data-aos-delay="700">
                    <div class="glass-card p-6 rounded-3xl flex items-center justify-between gap-8 border-yellow-400/20">
                        <div class="flex flex-col items-start">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-yellow-500 mb-1">Financial Transparency</span>
                            <span class="text-xs font-bold text-white/80">Laporan Kas: {{ $financialSummary['kategoriName'] }}</span>
                        </div>
                        <div class="flex items-center gap-10">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400">Total Pemasukan</span>
                                <span class="text-xl font-black text-white">Rp {{ number_format($financialSummary['totalPemasukan'], 0, ',', '.') }}</span>
                            </div>
                            <div class="w-px h-8 bg-white/10"></div>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black uppercase tracking-widest text-rose-400">Total Pengeluaran</span>
                                <span class="text-xl font-black text-white">Rp {{ number_format($financialSummary['totalPengeluaran'], 0, ',', '.') }}</span>
                            </div>
                            <div class="w-px h-8 bg-white/10"></div>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black uppercase tracking-widest text-yellow-400">Saldo Akhir</span>
                                <span class="text-xl font-black text-white">Rp {{ number_format($financialSummary['saldo'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mobile Financial Transparency (Minimalist) --}}
                <div class="mt-8 grid grid-cols-1 gap-3 w-full md:hidden mb-10" data-aos="fade-up" data-aos-delay="700">
                    <div class="glass-card p-4 rounded-2xl border-emerald-500/30">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400">Income</span>
                            <span class="text-lg font-black text-white">Rp {{ number_format($financialSummary['totalPemasukan'] / 1000, 0) }}k</span>
                        </div>
                    </div>
                    <div class="glass-card p-4 rounded-2xl border-rose-500/30">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black uppercase tracking-widest text-rose-400">Expense</span>
                            <span class="text-lg font-black text-white">Rp {{ number_format($financialSummary['totalPengeluaran'] / 1000, 0) }}k</span>
                        </div>
                    </div>
                    <div class="glass-card p-4 rounded-2xl border-yellow-500/40">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black uppercase tracking-widest text-yellow-400">Balance</span>
                            <span class="text-lg font-black text-white text-yellow-100">+ Rp {{ number_format($financialSummary['saldo'] / 1000, 0) }}k</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tentang --}}
    <section id="tentang" class="bg-white/90 text-slate-900 py-20 px-6 md:px-16 fade-in-up border-t border-base-200">
        <div class="max-w-5xl mx-auto text-center" data-aos="fade-up">
            {{-- Masjid --}}
            <h3 class="text-4xl font-black mb-8 text-green-700 tracking-tighter uppercase">Tentang Masjid Al-Falah</h3>
            <p class="leading-relaxed text-lg mb-6 font-medium opacity-80">
                Masjid <span class="font-black text-green-800 underline decoration-yellow-400 decoration-4">Al-Falah</span> berdiri sejak tahun 1980 dan telah menjadi pusat
                peribadatan, pembinaan akhlak, serta kegiatan sosial keagamaan masyarakat sekitar. Dengan semangat
                kebersamaan, masjid ini berperan aktif dalam mendukung terciptanya lingkungan yang islami, damai, dan
                penuh dengan nilai ukhuwah Islamiyah.
            </p>
            <div class="grid md:grid-cols-2 gap-6 mt-10 text-left">
                {{-- Visi --}}
                <div class="bg-green-100/50 p-8 rounded-3xl shadow-lg border border-green-200 group hover:bg-green-100 transition-colors">
                    <h4 class="text-2xl font-black mb-3 text-green-800 flex items-center gap-3">
                        <i class="fa fa-eye opacity-40"></i> Visi Utama
                    </h4>
                    <p class="font-bold text-green-900/70">Menjadi masjid yang makmur, aktif, dan bermanfaat bagi masyarakat dalam membangun ukhuwah Islamiyah.</p>
                </div>
                {{-- Misi --}}
                <div class="bg-green-100/50 p-8 rounded-3xl shadow-lg border border-green-200 group hover:bg-green-100 transition-colors">
                    <h4 class="text-2xl font-black mb-3 text-green-800 flex items-center gap-3">
                        <i class="fa fa-bullseye opacity-40"></i> Misi Protokol
                    </h4>
                    <ul class="space-y-2 font-bold text-green-900/70">
                        <li class="flex items-start gap-2"><i class="fa fa-check-circle mt-1 text-green-600"></i> Peningkatan kualitas ibadah jamaah.</li>
                        <li class="flex items-start gap-2"><i class="fa fa-check-circle mt-1 text-green-600"></i> Pusat pendidikan Al-Qur’an terpadu.</li>
                        <li class="flex items-start gap-2"><i class="fa fa-check-circle mt-1 text-green-600"></i> Penyelenggaraan program ekonomi umat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Kegiatan --}}
    <section id="kegiatan" class="bg-slate-50 py-20 px-6 md:px-16 border-y border-base-200">
        <div class="max-w-6xl mx-auto" data-aos="fade-up">
            <h3 class="text-4xl font-black mb-12 text-slate-900 text-center tracking-tighter uppercase">Kegiatan Ecosystem</h3>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @php
                    $kegiatans = [
                        ['title' => 'Kajian Rutin', 'desc' => 'Tafsir Al-Qur’an & Hadits bersama ulama terpercaya.', 'icon' => 'fa-book-open-reader'],
                        ['title' => 'Digital TPA', 'desc' => 'Pembelajaran Al-Qur’an modern untuk lintas generasi.', 'icon' => 'fa-children'],
                        ['title' => 'Bakti Sosial', 'desc' => 'Program santunan & pemberdayaan ekonomi warga.', 'icon' => 'fa-hands-holding-heart'],
                        ['title' => 'Seminar IPTEK', 'desc' => 'Edukasi kesehatan & pelatihan skill teknologi.', 'icon' => 'fa-microchip'],
                        ['title' => 'Youth Squad', 'desc' => 'Diskusi & olahraga pembinaan generasi muda islami.', 'icon' => 'fa-user-group'],
                        ['title' => 'Ramadhan Hub', 'desc' => 'Pesantren kilat & buka puasa bersama jamaah.', 'icon' => 'fa-moon'],
                    ];
                @endphp
                @foreach ($kegiatans as $k)
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-100 hover:border-green-500 transition-all group hover:-translate-y-2">
                        <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:bg-green-600 group-hover:text-white transition-all shadow-sm">
                            <i class="fa {{ $k['icon'] }} text-xl"></i>
                        </div>
                        <h4 class="text-xl font-black mb-3 text-slate-900">{{ $k['title'] }}</h4>
                        <p class="text-sm font-bold text-slate-500 leading-relaxed">{{ $k['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section id="kontak" class="bg-white py-20 px-6 md:px-16">
        <div class="max-w-5xl mx-auto" data-aos="fade-up">
            <div class="text-center mb-12">
                <h3 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">Hubungi Kami</h3>
                <p class="font-bold text-slate-500 mt-2">Saluran aspirasi dan informasi Masjid Al-Falah.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-start">
                {{-- Info Kontak --}}
                <div class="space-y-6">
                    <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100">
                        <h4 class="text-2xl font-black mb-6 text-slate-900 border-b border-slate-200 pb-4">Digital Identity</h4>
                        <ul class="space-y-5">
                            <li class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600 border border-slate-100">
                                    <i class="fa fa-location-dot"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black uppercase opacity-40">Location Index</span>
                                    <span class="font-bold text-sm">Pekanbaru, Riau, Indonesia</span>
                                </div>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600 border border-slate-100">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black uppercase opacity-40">Support Line</span>
                                    <span class="font-bold text-sm">(022) 1234567</span>
                                </div>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600 border border-slate-100">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black uppercase opacity-40">Email Domain</span>
                                    <span class="font-bold text-sm">info@masjidal-falah.or.id</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Form Kontak --}}
                <div class="bg-slate-900 p-8 md:p-10 rounded-[2.5rem] shadow-2xl text-white">
                    <h4 class="text-2xl font-black mb-8">Kirim Transmisi</h4>
                    <form action="{{ auth()->check() ? route('umum.pesan.create') : route('login') }}" method="GET"
                        class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text text-white/40 font-black text-[9px] uppercase tracking-widest">Sender Name</span></label>
                                <input type="text" name="nama" required class="input bg-white/5 border-white/10 text-white rounded-xl focus:border-green-500 font-bold focus:outline-none">
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text text-white/40 font-black text-[9px] uppercase tracking-widest">Email Identity</span></label>
                                <input type="email" name="email" required class="input bg-white/5 border-white/10 text-white rounded-xl focus:border-green-500 font-bold focus:outline-none">
                            </div>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text text-white/40 font-black text-[9px] uppercase tracking-widest">Message Content</span></label>
                            <textarea name="pesan" rows="3" required class="textarea bg-white/5 border-white/10 text-white rounded-xl focus:border-green-500 font-bold focus:outline-none"></textarea>
                        </div>
                        <button type="submit"
                            class="btn btn-green bg-green-600 hover:bg-green-500 text-white border-none rounded-2xl w-full font-black uppercase tracking-widest mt-4">
                            Send Broadcast
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-950 text-slate-400 py-10 px-6 border-t border-white/5">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col items-center md:items-start">
                <span class="text-2xl font-black text-white italic tracking-tighter">Masjid Al-Falah</span>
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-green-500 mt-1">Islamic Digital Ecosystem</span>
            </div>
            <div class="text-xs font-bold opacity-40">
                &copy; {{ date('Y') }} Masjid Al-Falah Pekanbaru. System Operationalized.
            </div>
        </div>
    </footer>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // durasi animasi dalam ms
            easing: 'ease-out', // tipe easing
            once: true,
            mirror: true
        });

        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            // Toggle class 'hidden' untuk menampilkan atau menyembunyikan menu
            mobileMenu.classList.toggle('hidden');
        });

        // Tutup menu saat link diklik
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
