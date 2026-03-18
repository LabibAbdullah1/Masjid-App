{{-- resources/views/umum/ceramah.blade.php --}}
@extends('layouts.app')

@section('title', 'Jadwal Ceramah')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Futuristic Header --}}
        <div class="futuristic-bg p-8 md:p-12 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter uppercase mb-2">
                    Ceramah Schedule
                </h1>
                <p class="text-white/70 font-bold uppercase text-[10px] md:text-xs tracking-[0.4em]">Integrated Spiritual Knowledge System</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($jadwal as $jad)
                <div class="glass-card rounded-[2rem] overflow-hidden group hover:scale-[1.02] transition-all duration-500 border-white/10" data-aos="fade-up">
                    <div class="p-8 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-3 bg-primary/20 rounded-2xl border border-primary/30 group-hover:bg-primary group-hover:text-primary-content transition-colors">
                                <i class="fa fa-mosque text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] font-black uppercase tracking-widest opacity-40 block mb-1">Temporal Index</span>
                                <span class="badge badge-primary font-black uppercase text-[10px] tracking-widest p-3">Live Protocol</span>
                            </div>
                        </div>

                        <h2 class="text-2xl font-black text-base-content tracking-tight mb-4 group-hover:text-primary transition-colors">
                            {{ $jad->judul }}
                        </h2>

                        <div class="space-y-4 mb-8 flex-1">
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-base-200/50 border border-base-200">
                                <i class="fa fa-user-tie text-primary opacity-60"></i>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black uppercase tracking-widest opacity-40">Proponent Source</span>
                                    <span class="font-bold text-sm">{{ $jad->penceramah }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-base-200/50 border border-base-200">
                                <i class="fa fa-calendar-stars text-primary opacity-60"></i>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black uppercase tracking-widest opacity-40">Scheduled Date</span>
                                    <span class="font-bold text-sm">{{ \Carbon\Carbon::parse($jad->tanggal)->translatedFormat('l, d F Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-base-200/50 border border-base-200">
                                <i class="fa fa-clock text-primary opacity-60"></i>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black uppercase tracking-widest opacity-40">Time Offset</span>
                                    <span class="font-bold text-sm">{{ \Carbon\Carbon::parse($jad->waktu)->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>

                        {{-- Countdown Visual --}}
                        <div class="mt-auto pt-6 border-t border-base-300/50" 
                             x-data="countdown('{{ \Carbon\Carbon::parse($jad->tanggal . ' ' . $jad->waktu)->format('Y-m-d H:i:s') }}')" 
                             x-init="start()">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-primary">Countdown Sequence</span>
                                <span class="text-lg font-black tracking-widest font-mono text-base-content" x-text="display"></span>
                            </div>
                            <div class="w-full h-1 bg-base-200 rounded-full mt-2 overflow-hidden">
                                <div class="h-full bg-primary animate-pulse w-2/3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center glass-card rounded-[2rem] border-dashed border-2 border-base-300">
                    <div class="p-4 bg-base-200 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-calendar-xmark text-3xl opacity-20"></i>
                    </div>
                    <h3 class="text-xl font-bold opacity-40 uppercase tracking-[0.2em]">Zero Schedules Detected</h3>
                    <p class="text-sm opacity-30 mt-2 font-bold">Please check back later for spiritual updates.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $jadwal->links() }}
        </div>
    </div>


@endsection
