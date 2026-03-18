{{-- resources/views/galeri/public.blade.php --}}
@extends('layouts.app')

@section('title', 'Galeri Masjid')

@section('content')
    <div class="space-y-8" x-data="{ showModal: false, modalImage: '', modalTitle: '' }" data-aos="fade-up">
        
        {{-- Futuristic Header --}}
        <div class="futuristic-bg p-8 md:p-12 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter uppercase mb-2">
                    Visual Archive
                </h1>
                <p class="text-white/70 font-bold uppercase text-[10px] md:text-xs tracking-[0.4em]">Historical Media Repository</p>
            </div>
        </div>

        @if ($galeri->count())
            {{-- Masonry Grid --}}
            <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                @foreach ($galeri as $item)
                    <div class="break-inside-avoid glass-card rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl cursor-pointer group hover:scale-[1.02] transition-all duration-500 border-white/5"
                        @click="showModal = true; modalImage='{{ asset('storage/' . $item->gambar) }}'; modalTitle='{{ $item->nama }}'">
                        
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                class="w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            {{-- Glass Overlay on Hover --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6">
                                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-primary mb-2">Media Insight</span>
                                <h2 class="text-white font-black text-lg leading-tight">{{ $item->nama }}</h2>
                            </div>
                        </div>

                        <div class="p-4 flex items-center justify-between border-t border-white/5">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-40">Capture Index</span>
                            <div class="flex gap-1">
                                <span class="w-1 h-1 bg-primary rounded-full animate-pulse"></span>
                                <span class="w-1 h-1 bg-primary rounded-full animate-pulse [animation-delay:200ms]"></span>
                                <span class="w-1 h-1 bg-primary rounded-full animate-pulse [animation-delay:400ms]"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-20 text-center glass-card rounded-[2.5rem] border-dashed border-2 border-base-300">
                <div class="p-6 bg-base-200 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                    <i class="fa fa-image-slash text-4xl opacity-20"></i>
                </div>
                <h3 class="text-2xl font-black opacity-40 uppercase tracking-[0.2em]">Archive Empty</h3>
                <p class="text-sm opacity-30 mt-2 font-bold italic text-primary">No visual data packets found in the repository.</p>
            </div>
        @endif

        {{-- Data Inspection Modal (Futuristic) --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-[60] flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             style="display: none;">
            
            <div class="absolute inset-0 bg-black/90 backdrop-blur-xl" @click="showModal = false"></div>

            <div class="glass-card rounded-[2.5rem] shadow-2xl max-w-5xl w-full overflow-hidden relative z-10 border-white/20" @click.stop>
                <div class="relative">
                    <img :src="modalImage" :alt="modalTitle" class="w-full max-h-[75vh] object-contain">
                    
                    {{-- Close Trigger --}}
                    <button class="absolute top-6 right-6 w-12 h-12 bg-black/40 backdrop-blur-md rounded-full text-white/80 hover:text-white hover:bg-black/60 transition-all flex items-center justify-center border border-white/10"
                        @click="showModal = false">
                        <i class="fa fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="p-8 bg-black/40 backdrop-blur-md flex flex-col md:flex-row md:items-center justify-between gap-6 border-t border-white/10">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-primary mb-1">Observation Subject</span>
                        <h2 class="text-2xl font-black text-white tracking-tight" x-text="modalTitle"></h2>
                    </div>
                    <div class="flex gap-4">
                        <button @click="showModal = false" class="btn btn-outline border-white/20 text-white rounded-2xl hover:bg-white/10 font-black uppercase tracking-widest text-[10px]">
                            Exit Protocol
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
