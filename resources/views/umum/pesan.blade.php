@extends('layouts.app')

@section('title', 'Pesan & Saran')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        
        {{-- Futuristic Header --}}
        <div class="futuristic-bg p-8 md:p-12 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter uppercase mb-2">
                    Communication Hub
                </h1>
                <p class="text-white/70 font-bold uppercase text-[10px] md:text-xs tracking-[0.4em]">Integrated Feedback & Protocol Interface</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            
            {{-- Message History --}}
            <div class="space-y-6">
                <div class="flex items-center justify-between px-4">
                    <h2 class="text-xl font-black uppercase tracking-widest text-base-content/60">Transmission History</h2>
                    <span class="badge badge-primary font-black uppercase text-[10px] tracking-widest p-3">{{ $pesanAktif->count() }} Records</span>
                </div>

                @forelse ($pesanAktif as $pesan)
                    <div class="glass-card rounded-[2rem] p-8 border-white/5 relative group hover:border-primary/20 transition-all duration-300">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-3 bg-base-200 rounded-2xl border border-base-300">
                                <i class="fa fa-envelope-open-text text-primary text-xl"></i>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] font-black uppercase tracking-widest opacity-40 block mb-1">Status Protocol</span>
                                @if ($pesan->feedback)
                                    <span class="badge badge-success font-black uppercase text-[9px] tracking-widest p-2">RESOLVED</span>
                                @else
                                    <span class="badge badge-warning font-black uppercase text-[9px] tracking-widest p-2">PENDING</span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-primary opacity-60">Message Payload</span>
                                <p class="text-base-content font-bold mt-1 leading-relaxed">{{ $pesan->pesan }}</p>
                            </div>

                            @if ($pesan->feedback)
                                <div class="mt-6 p-6 rounded-2xl bg-success/5 border border-success/20 relative overflow-hidden">
                                    <div class="absolute top-0 right-0 p-2 opacity-10">
                                        <i class="fa fa-reply-all text-4xl"></i>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-success">Admin Response</span>
                                    <p class="text-base-content font-bold mt-2 text-sm italic">"{{ $pesan->feedback }}"</p>
                                    <div class="mt-4 pt-4 border-t border-success/10 flex items-center gap-2">
                                        <i class="fa fa-clock text-[10px] opacity-40"></i>
                                        <span class="text-[9px] font-black uppercase opacity-40">Responded: {{ optional($pesan->dibalas_pada)->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Hover Action --}}
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            <form action="{{ route('umum.pesan.destroy', $pesan->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Initiate record deletion protocol?')"
                                    class="w-8 h-8 rounded-full bg-error/10 text-error hover:bg-error hover:text-white transition-all flex items-center justify-center">
                                    <i class="fa fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="glass-card rounded-[2rem] p-12 text-center border-dashed border-2 border-base-300">
                        <i class="fa fa-terminal text-4xl opacity-20 mb-6"></i>
                        <h3 class="text-lg font-black opacity-40 uppercase tracking-widest">No Active Transmissions</h3>
                    </div>
                @endforelse
            </div>

            {{-- New Message Portal --}}
            <div class="lg:sticky lg:top-8">
                <div class="card bg-base-100 shadow-2xl rounded-[2.5rem] border border-base-200 overflow-hidden">
                    <div class="card-body p-8 md:p-12">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="p-4 bg-primary text-primary-content rounded-2xl shadow-lg">
                                <i class="fa fa-paper-plane text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black tracking-tight text-base-content">New Transmission</h2>
                                <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40">Initiate Protocol Response</p>
                            </div>
                        </div>

                        <form action="{{ route('umum.pesan.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-black uppercase tracking-widest text-[10px] opacity-60">Feedback Content</span>
                                </label>
                                <textarea name="pesan" id="pesan" rows="6" 
                                    placeholder="Enter system feedback or community protocol suggestions..."
                                    class="textarea textarea-bordered border-2 focus:border-primary rounded-2xl font-bold bg-base-200/50 focus:bg-base-100 transition-all focus:outline-none">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="text-xs text-error mt-2 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-full rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl group transition-all">
                                Send Transmission
                                <i class="fa fa-bolt ml-2 group-hover:scale-125 transition-transform text-yellow-400"></i>
                            </button>
                        </form>

                        <div class="mt-8 p-6 rounded-3xl bg-base-200/50 border border-base-300 text-center">
                            <p class="text-[11px] font-bold opacity-60 leading-relaxed italic">
                                "Saran dan kritik Anda adalah input berharga bagi optimalisasi pelayanan Masjid."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
