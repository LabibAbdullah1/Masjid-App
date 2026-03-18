@extends('layouts.app')

@section('header', 'Protocol Response')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30 animate-pulse">
                        <i class="fa fa-comment-dots text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Eksekusi Balasan</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Feedback Loop Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16 space-y-12">
                {{-- Original Message Display --}}
                <div class="glass-card bg-primary/5 rounded-[2rem] p-8 border border-primary/10 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <i class="fa fa-quote-left text-9xl"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center font-black">
                            {{ substr($pesan->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-black text-lg tracking-tight">{{ $pesan->user->name }}</div>
                            <div class="text-[10px] font-black uppercase tracking-widest opacity-40">
                                Transmitted: {{ $pesan->created_at->format('d.m.Y // H:i') }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xl font-bold italic opacity-80 leading-relaxed">
                        "{{ $pesan->pesan }}"
                    </p>
                </div>

                {{-- Reply Form --}}
                <form action="{{ route('admin.pesan.update', $pesan->id) }}" method="POST" class="space-y-12">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Administrative Response Payload</span>
                        </label>
                        <div class="relative group">
                            <textarea name="feedback" rows="5" placeholder="Formulate response protocol..."
                                      class="textarea textarea-lg w-full p-8 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-bold text-lg rounded-3xl" 
                                      required autofocus>{{ old('feedback', $pesan->feedback) }}</textarea>
                            <div class="absolute right-6 bottom-6 opacity-10 group-focus-within:opacity-100 transition-opacity">
                                <i class="fa fa-paper-plane text-3xl text-primary animate-pulse"></i>
                            </div>
                        </div>
                        @error('feedback') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.pesan.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Abort Link
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Transmit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
