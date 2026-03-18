@extends('layouts.app')

@section('header', 'Jadwal Ceramah')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Header & Action Bar --}}
        <div class="glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <i class="fa fa-calendar-days text-4xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Protocol Dakwah Hub</h2>
                    <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Spiritual Event Synchronization</p>
                </div>
                <div class="md:ml-auto">
                    <a href="{{ route('admin.jadwal-ceramah.create') }}" class="btn btn-white bg-white/20 hover:bg-white text-white hover:text-primary rounded-2xl border-none shadow-xl px-8 transition-all hover:scale-105">
                        <i class="fa fa-plus-circle mr-2"></i> Tambah Jadwal
                    </a>
                </div>
            </div>
        </div>

        {{-- Table Display --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-primary/5 text-primary/60 font-black uppercase text-[10px] tracking-[0.2em]">
                            <th class="py-8 pl-10">Event Instance</th>
                            <th>Resource (Penceramah)</th>
                            <th>Core Theme</th>
                            <th>Temporal Coordinate</th>
                            <th class="text-center pr-10">Administrative Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($jadwal as $item)
                            <tr class="hover:bg-primary/5 transition-all group">
                                <td class="py-10 pl-10">
                                    <div class="bg-base-200 text-base-content/40 w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">
                                        #{{ $loop->iteration + ($jadwal->currentPage() - 1) * $jadwal->perPage() }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span class="text-lg font-black tracking-tight group-hover:text-primary transition-colors">{{ $item->penceramah }}</span>
                                        <span class="text-[9px] font-black uppercase opacity-40 tracking-[0.2em] mt-1 text-primary">Keynote Speaker</span>
                                    </div>
                                </td>
                                <td class="font-bold opacity-70 italic max-w-xs truncate">
                                    "{{ $item->judul }}"
                                </td>
                                <td>
                                    <div class="flex flex-col gap-1">
                                        <div class="badge badge-outline border-primary/20 font-black text-[10px] tracking-widest px-4 py-3">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d M Y') }}
                                        </div>
                                        <div class="flex items-center gap-2 text-xs font-bold opacity-40 ml-1">
                                            <i class="fa fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center pr-10">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.jadwal-ceramah.edit', $item->id) }}"
                                           class="btn btn-square btn-ghost text-warning hover:bg-warning/10 transition-colors">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.jadwal-ceramah.destroy', $item->id) }}" method="POST"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-square btn-ghost text-error hover:bg-error/10 transition-colors">
                                                <i class="fa-solid fa-trash-can text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-32 text-center">
                                    <div class="flex flex-col items-center gap-6 opacity-20">
                                        <i class="fa fa-calendar-xmark text-9xl"></i>
                                        <span class="text-2xl font-black uppercase tracking-[0.4em]">Zero Events Logged</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-10 bg-base-200/20">
                {{ $jadwal->links() }}
            </div>
        </div>
    </div>
@endsection
