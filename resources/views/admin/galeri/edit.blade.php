@extends('layouts.app')

@section('header', 'Media Modification')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30">
                        <i class="fa fa-sliders text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Modifikasi Aset</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Resource Update Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        {{-- Nama --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">System Descriptor</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                    <i class="fa fa-signature text-lg"></i>
                                </div>
                                <input type="text" name="nama" value="{{ old('nama', $galeri->nama) }}" placeholder="Update descriptor..."
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                       required autofocus />
                            </div>
                            @error('nama') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                        </div>

                        {{-- File Update --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Update Source File (Optional)</span>
                            </label>
                            <div class="relative group">
                                <input type="file" name="gambar"
                                       class="file-input file-input-bordered file-input-primary w-full bg-base-200/50 rounded-2xl focus:outline-none transition-all font-black" />
                            </div>
                            <p class="text-[9px] font-black uppercase opacity-30 mt-2 ml-2 tracking-widest italic">Leave blank to retain current resource</p>
                            @error('gambar') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Current Preview --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Existing Resource Preview</span>
                        </label>
                        <div class="relative aspect-video rounded-[2rem] overflow-hidden border-2 border-primary/20 bg-black/5 group/preview">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->nama }}"
                                 class="w-full h-full object-contain p-4 group-hover/preview:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 flex items-center gap-3">
                                <div class="p-2 bg-primary text-white rounded-lg shadow-lg">
                                    <i class="fa fa-file-image"></i>
                                </div>
                                <span class="text-white font-black uppercase text-[10px] tracking-widest">Active Data Segment</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Cancel Protocol
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Apply Modification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
