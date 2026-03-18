@extends('layouts.app')

@section('header', 'Media Ingestion')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30 animate-pulse">
                        <i class="fa fa-camera-viewfinder text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Arsip Visual Baru</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Media Upload Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        {{-- Nama --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Media Descriptor/Title</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-heading text-lg"></i>
                                </div>
                                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Capture event name..."
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required autofocus />
                            </div>
                            @error('nama') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                        </div>

                        {{-- File --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Source Image File</span>
                            </label>
                            <div class="relative group">
                                <input type="file" name="gambar"
                                       class="file-input file-input-bordered file-input-primary w-full bg-base-200/50 rounded-2xl focus:outline-none transition-all font-black" 
                                       required />
                            </div>
                            @error('gambar') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Abort Ingestion
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Commit Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
