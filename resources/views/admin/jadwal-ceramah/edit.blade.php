@extends('layouts.app')

@section('header', 'Modify Event Protocol')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30">
                        <i class="fa fa-calendar-check text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Penyesuaian Jadwal</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Temporal Data Update</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('admin.jadwal-ceramah.update', $jadwalCeramah) }}" method="POST" class="space-y-12">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        {{-- Penceramah --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Identity Key (Penceramah)</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-user-tie text-lg"></i>
                                </div>
                                <input type="text" name="penceramah" value="{{ old('penceramah', $jadwalCeramah->penceramah) }}"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required autofocus />
                            </div>
                        </div>

                        {{-- Tema --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Core Message Theme</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-book-quran text-lg"></i>
                                </div>
                                <input type="text" name="judul" value="{{ old('judul', $jadwalCeramah->judul) }}"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required />
                            </div>
                        </div>

                        {{-- Tanggal --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Temporal Date</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-calendar-day text-lg"></i>
                                </div>
                                <input type="date" name="tanggal" value="{{ old('tanggal', $jadwalCeramah->tanggal) }}"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required />
                            </div>
                        </div>

                        {{-- Waktu --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Execution Time</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-clock text-lg"></i>
                                </div>
                                <input type="time" name="waktu" value="{{ old('waktu', $jadwalCeramah->waktu) }}"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required />
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.jadwal-ceramah.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Abort changes
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Commit Schedule Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
