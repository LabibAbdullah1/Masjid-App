@extends('layouts.app')

@section('content')
    <div class="space-y-6 md:space-y-8" data-aos="fade-up">
        {{-- Header Welcome --}}
        <div class="hero bg-base-100 rounded-[1.5rem] md:rounded-box shadow-sm border border-base-200 overflow-hidden">
            <div class="hero-content flex-col lg:flex-row gap-4 md:gap-8 p-6 md:p-8 w-full max-w-none justify-start">
                <div class="avatar placeholder">
                    <div class="bg-primary text-primary-content rounded-2xl w-16 md:w-24 shadow-lg">
                        <span class="text-xl md:text-3xl font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div> 
                <div class="text-center lg:text-left">
                    <h1 class="text-2xl md:text-4xl font-black tracking-tight text-base-content mb-1 md:mb-2">
                        Assalamualaikum, <span class="text-primary">{{ Auth::user()->name }}!</span>
                    </h1>
                    <p class="text-sm md:text-lg opacity-70">Selamat datang kembali di <span class="font-bold">Digital Hub</span> Masjid.</p>
                </div>
                <div class="lg:ml-auto flex gap-2">
                    <div class="badge badge-primary badge-outline gap-2 p-3 md:p-4 font-bold text-[10px] md:text-xs">
                        <i class="fa fa-calendar"></i>
                        {{ $jadwal['hijriah'] ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Financial Info Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            {{-- Pemasukan --}}
            <div class="stats glass-card shadow-xl overflow-hidden border border-success/30 hover:scale-[1.02] transition-transform">
                <div class="stat p-4 md:p-6 text-center md:text-left">
                    <div class="stat-title text-minimal text-success/80">Income</div>
                    <div class="stat-value text-success text-lg md:text-3xl">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    <div class="stat-desc font-bold opacity-30 uppercase text-[8px] md:text-[9px] mt-1 tracking-widest leading-none">Monthly Sync</div>
                </div>
            </div>

            {{-- Pengeluaran --}}
            <div class="stats glass-card shadow-xl overflow-hidden border border-error/30 hover:scale-[1.02] transition-transform">
                <div class="stat p-4 md:p-6 text-center md:text-left">
                    <div class="stat-title text-minimal text-error/80">Expense</div>
                    <div class="stat-value text-error text-lg md:text-3xl">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    <div class="stat-desc font-bold opacity-30 uppercase text-[8px] md:text-[9px] mt-1 tracking-widest leading-none">Monthly Sync</div>
                </div>
            </div>

            {{-- Saldo --}}
            <div class="stats glass-card shadow-2xl overflow-hidden futuristic-bg text-white col-span-2 hover:scale-[1.02] transition-transform border-none">
                <div class="stat p-5 md:p-6 relative">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="stat-figure opacity-40 relative z-10 hidden sm:block">
                        <i class="fa fa-wallet text-3xl md:text-4xl"></i>
                    </div>
                    <div class="stat-title font-black uppercase text-[9px] md:text-[10px] tracking-[0.3em] opacity-90 relative z-10">Total Balance Protocol</div>
                    <div class="stat-value text-2xl md:text-4xl relative z-10">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                    <div class="stat-desc font-bold text-white/70 uppercase text-[8px] md:text-[9px] mt-1 tracking-widest relative z-10">Current Net Asset</div>
                </div>
            </div>
        </div>

        {{-- Secondary Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column (Prayers & Quote) --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Prayer Times Card --}}
                <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-xl" data-aos="fade-right">
                    <div class="p-8 lg:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl font-black tracking-tight flex items-center gap-3">
                                    <i class="fa fa-clock text-primary"></i>
                                    Jadwal Sholat Hari Ini
                                </h2>
                                <p class="text-[10px] font-bold uppercase tracking-[0.3em] opacity-40 mt-1">Spiritual Timekeeping System</p>
                            </div>
                            <div class="hidden sm:block">
                                <span class="badge badge-primary font-black uppercase text-[10px] tracking-widest p-4">Precision Mode</span>
                            </div>
                        </div>

                        @if ($jadwal)
                            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
                                @php
                                    $prayerTimes = [
                                        ['name' => 'Imsak', 'time' => $jadwal['timings']['Imsak'], 'color' => 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300'],
                                        ['name' => 'Fajr', 'time' => $jadwal['timings']['Fajr'], 'color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-800/50 dark:text-emerald-300'],
                                        ['name' => 'Sunrise', 'time' => $jadwal['timings']['Sunrise'], 'color' => 'bg-amber-100 text-amber-700 dark:bg-amber-800/50 dark:text-amber-300'],
                                        ['name' => 'Dhuhr', 'time' => $jadwal['timings']['Dhuhr'], 'color' => 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-content'],
                                        ['name' => 'Asr', 'time' => $jadwal['timings']['Asr'], 'color' => 'bg-teal-100 text-teal-700 dark:bg-teal-800/50 dark:text-teal-300'],
                                        ['name' => 'Maghrib', 'time' => $jadwal['timings']['Maghrib'], 'color' => 'bg-orange-100 text-orange-700 dark:bg-orange-800/50 dark:text-orange-300'],
                                        ['name' => 'Isha', 'time' => $jadwal['timings']['Isha'], 'color' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-800/50 dark:text-indigo-300'],
                                    ];
                                @endphp
                                @foreach ($prayerTimes as $prayer)
                                    <div class="flex flex-col items-center p-4 rounded-3xl border border-transparent hover:border-primary transition-all group {{ $prayer['color'] }}">
                                        <span class="text-[9px] font-black uppercase opacity-60 mb-2 leading-none tracking-tighter">{{ $prayer['name'] }}</span>
                                        <span class="text-lg font-black leading-none">{{ $prayer['time'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-error glass-card">
                                <i class="fa fa-circle-exclamation"></i>
                                <span>Gagal sinkronisasi jadwal sholat. Cek koneksi server.</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Inspirasi Harian Card --}}
                <div class="card bg-primary text-primary-content shadow-2xl shadow-primary/30 overflow-hidden relative rounded-[2.5rem]" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-12 -bottom-12 opacity-10">
                        <i class="fa fa-quote-right text-[15rem]"></i>
                    </div>
                    <div class="card-body p-10 lg:p-14">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="p-3 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30">
                                <i class="fa fa-book-quran text-2xl"></i>
                            </div>
                            <h2 class="card-title text-2xl font-black uppercase tracking-tighter">Inspirasi Harian</h2>
                        </div>
                        
                        @if ($quote)
                            <div class="relative z-10">
                                <p class="text-3xl lg:text-4xl font-serif italic leading-tight font-medium">
                                    "{{ $quote->text }}"
                                </p>
                                <div class="h-1 w-20 bg-white/30 my-8 rounded-full"></div>
                                <p class="text-sm font-black tracking-[0.3em] uppercase opacity-80">
                                    — {{ $quote->source }}
                                </p>
                            </div>
                        @else
                            <p class="text-xl opacity-80">Tetaplah berbuat baik, karena setiap kebaikan adalah sedekah.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Events & Gallery --}}
            <div class="space-y-8">
                {{-- Jadwal Ceramah Card --}}
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-6">
                        <h2 class="card-title text-xl font-black flex items-center gap-3 mb-4">
                            <i class="fa fa-calendar-check text-primary"></i>
                            Agenda Ceramah
                        </h2>
                        
                        <div class="space-y-4">
                            @forelse ($jadwalCeramah->take(3) as $jadwal)
                                <div class="flex items-start gap-4 p-4 rounded-xl bg-base-200/50 hover:bg-base-200 transition-colors group">
                                    <div class="flex flex-col items-center justify-center w-12 h-12 rounded-lg bg-base-100 border border-base-200 shadow-sm">
                                        <span class="text-lg font-black leading-none text-primary">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</span>
                                        <span class="text-[10px] uppercase font-bold text-base-content/60">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('M') }}</span>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h3 class="font-bold text-sm truncate group-hover:text-primary transition-colors">{{ $jadwal->judul }}</h3>
                                        <p class="text-xs opacity-60 mt-0.5">Oleh: {{ $jadwal->penceramah }}</p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="badge badge-ghost badge-sm font-bold">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 opacity-40">
                                    <i class="fa fa-calendar-xmark text-4xl mb-2"></i>
                                    <p class="text-sm">Belum ada agenda terdekat</p>
                                </div>
                            @endforelse
                        </div>
                        
                        @if($jadwalCeramah->count() > 0)
                            <div class="card-actions mt-4">
                                <a href="{{ route('umum.ceramah') }}" class="btn btn-ghost btn-sm w-full gap-2">
                                    Lihat Semua Agenda
                                    <i class="fa fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Galeri Mini Card --}}
                <div class="card bg-base-100 shadow-sm border border-base-200 overflow-hidden">
                    <div class="card-body p-6">
                        <h2 class="card-title text-xl font-black flex items-center gap-3 mb-4">
                            <i class="fa fa-camera-retro text-primary"></i>
                            Galeri Terbaru
                        </h2>
                        
                        <div class="grid grid-cols-2 gap-2">
                            @forelse ($galeri->take(4) as $item)
                                <div class="group relative aspect-square rounded-lg overflow-hidden border border-base-200">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                         class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2">
                                        <span class="text-[10px] text-white font-bold truncate">{{ $item->nama }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-10 opacity-40">
                                    <p class="text-sm font-bold">Galeri kosong</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
