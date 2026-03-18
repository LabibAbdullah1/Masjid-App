@extends('layouts.app')

@section('header', 'Insight Modification')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30">
                        <i class="fa fa-quote-left text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Penyesuaian Narasi</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Insight Update Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('admin.quote.update', $quote->id) }}" method="POST" class="space-y-12">
                    @csrf
                    @method('PUT')
                    
                    {{-- Text Content --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Active Insight Data</span>
                        </label>
                        <div class="relative group">
                            <textarea name="text" rows="5" placeholder="Update spiritual insight content..."
                                      class="textarea textarea-lg w-full p-8 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-bold text-lg rounded-3xl" 
                                      required autofocus>{{ old('text', $quote->text) }}</textarea>
                            <div class="absolute right-6 bottom-6 opacity-10 group-focus-within:opacity-100 transition-opacity">
                                <i class="fa fa-quote-right text-4xl text-primary"></i>
                            </div>
                        </div>
                        @error('text') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                    </div>

                    {{-- Source --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Origin Attribution</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                                <i class="fa fa-feather text-lg"></i>
                            </div>
                            <input type="text" name="source" value="{{ old('source', $quote->source) }}" placeholder="Update source..."
                                   class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" />
                        </div>
                        @error('source') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.quote.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Abort changes
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Commit Insight Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
