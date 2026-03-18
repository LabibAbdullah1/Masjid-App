@extends('layouts.app')

@section('header', 'Visual Archive')

@section('content')
    <div class="space-y-8" data-aos="fade-up" x-data="{ showModal: false, modalImage: '', modalTitle: '' }">
        {{-- Header & Action Bar --}}
        <div class="glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <i class="fa fa-images text-4xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Galeri Media Hub</h2>
                    <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Visual Documentation Protocol</p>
                </div>
                <div class="md:ml-auto">
                    <a href="{{ route('admin.galeri.create') }}" class="btn btn-white bg-white/20 hover:bg-white text-white hover:text-primary rounded-2xl border-none shadow-xl px-8 transition-all hover:scale-105">
                        <i class="fa fa-upload mr-2"></i> Ingest New Media
                    </a>
                </div>
            </div>
        </div>

        {{-- Gallery Grid --}}
        @if ($galeri->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($galeri as $item)
                    <div class="glass-card rounded-[2rem] overflow-hidden border border-white/10 group/card hover:scale-[1.02] transition-all duration-500 shadow-xl" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                        {{-- Image Container --}}
                        <div class="relative aspect-video overflow-hidden bg-black/20">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                 class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-700 cursor-pointer"
                                 @click="modalImage='{{ asset('storage/' . $item->gambar) }}'; modalTitle='{{ $item->nama }}'; showModal=true">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                            
                            {{-- Counter Badge --}}
                            <div class="absolute top-4 left-4 glass-card px-3 py-1 rounded-lg border border-white/20 text-[10px] font-black text-white uppercase tracking-widest">
                                NODE #{{ $loop->iteration + ($galeri->currentPage() - 1) * $galeri->perPage() }}
                            </div>
                        </div>

                        {{-- Metadata & Actions --}}
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="text-lg font-black tracking-tight truncate group-hover/card:text-primary transition-colors">{{ $item->nama }}</h3>
                                <p class="text-[9px] font-black uppercase opacity-40 tracking-[0.2em] mt-1">Stored Media Identifier</p>
                            </div>
                            
                            <div class="flex items-center justify-between gap-4 pt-2 border-t border-white/5">
                                <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                   class="btn btn-sm btn-ghost rounded-xl font-black text-[10px] tracking-widest uppercase flex-1 border border-white/10 hover:border-warning hover:text-warning transition-all">
                                    <i class="fa fa-edit mr-2"></i> Update
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST"
                                      class="delete-form inline flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-ghost rounded-xl font-black text-[10px] tracking-widest uppercase w-full border border-white/10 hover:border-error hover:text-error transition-all">
                                        <i class="fa fa-trash-can mr-2"></i> Wipe
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="p-10">
                {{ $galeri->links() }}
            </div>
        @else
            <div class="py-32 text-center opacity-20" data-aos="fade-up">
                <i class="fa fa-box-open text-9xl"></i>
                <h3 class="text-2xl font-black uppercase tracking-[0.4em] mt-8 text-white">Visual Archive Empty</h3>
            </div>
        @endif

        {{-- Enhanced Modal --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-12 overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <div class="absolute inset-0 bg-black/90 backdrop-blur-2xl" @click="showModal = false"></div>
            
            <div class="relative glass-card rounded-[3rem] overflow-hidden max-w-6xl w-full border border-white/10 shadow-2xl animate-fade-in">
                <button class="absolute top-8 right-8 z-50 btn btn-circle btn-ghost text-white hover:bg-white/10 text-xl" @click="showModal = false">
                    <i class="fa fa-xmark"></i>
                </button>

                <div class="flex flex-col lg:flex-row h-full max-h-[85vh]">
                    <div class="flex-1 bg-black/40 flex items-center justify-center p-4">
                        <img :src="modalImage" :alt="modalTitle" class="max-h-full max-w-full object-contain shadow-2xl rounded-2xl">
                    </div>
                </div>
                
                <div class="p-8 bg-black/40 border-t border-white/5 text-center">
                    <h2 class="text-xl font-black tracking-tight text-white mb-1" x-text="modalTitle"></h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.5em] text-white/40">Visual Meta-Data Record</p>
                </div>
            </div>
        </div>
    </div>
@endsection
