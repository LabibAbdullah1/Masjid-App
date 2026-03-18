@extends('layouts.app')

@section('header', 'Modify Classification')

@section('content')
    <div class="max-w-2xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-10 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex items-center gap-6">
                    <div class="p-4 bg-white/20 backdrop-blur-xl rounded-2xl border border-white/30">
                        <i class="fa fa-folder-tree text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">Penyesuaian Skema</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-1">Classification Update</p>
                    </div>
                </div>
            </div>

            <div class="p-10">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">System Label</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                <i class="fa fa-tag text-lg"></i>
                            </div>
                            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" placeholder="Label name..."
                                   class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                                   required autofocus />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('kategori.index') }}" class="btn btn-ghost rounded-2xl font-black px-8">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary rounded-2xl font-black px-12 futuristic-bg border-none text-white shadow-xl shadow-primary/20 hover:scale-105 transition-all">
                            Apply Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
