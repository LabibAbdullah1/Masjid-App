@extends('layouts.app')

@section('header', 'Edit Data Anggota')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10 group">
            {{-- Futuristic Header --}}
            <div class="futuristic-bg p-12 text-white relative">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="p-6 bg-white/20 backdrop-blur-xl rounded-[2rem] border border-white/30 animate-pulse">
                        <i class="fa fa-user-edit text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black tracking-tighter">Modifikasi Profil</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.5em] mt-2">Identity Update Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-10 lg:p-16">
                {{-- Form Messages --}}
                @if ($errors->any())
                    <div class="alert alert-error glass-card text-white mb-10 border-none shadow-xl">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                        <ul class="font-black uppercase text-[10px] tracking-widest list-none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.anggota.update', $umums->id) }}" class="space-y-12">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        {{-- Name --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Full Legal Name</span>
                            </label>
                            <div class="relative group/input">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within/input:opacity-100 transition-opacity">
                                    <i class="fa fa-user-tag text-lg"></i>
                                </div>
                                <input type="text" name="name" value="{{ old('name', $umums->name) }}" placeholder="Update full name..."
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" required />
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Digital Coordinate (Email)</span>
                            </label>
                            <div class="relative group/input">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within/input:opacity-100 transition-opacity">
                                    <i class="fa fa-at text-lg"></i>
                                </div>
                                <input type="email" name="email" value="{{ old('email', $umums->email) }}" placeholder="jamaah@masjid.com"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" required />
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Update Encryption Key (Leave blank to keep current)</span>
                            </label>
                            <div class="relative group/input">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within/input:opacity-100 transition-opacity">
                                    <i class="fa fa-key-skeleton text-lg"></i>
                                </div>
                                <input type="password" name="password" placeholder="Min. 8 characters if changing"
                                       class="input input-lg w-full pl-16 bg-base-200/50 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 flex flex-col sm:flex-row items-center justify-end gap-6">
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-2 sm:order-1 transition-all">
                            Cancel Protocol
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black w-full sm:w-auto px-16 order-1 sm:order-2 shadow-2xl shadow-primary/30 futuristic-bg border-none text-white hover:scale-105 transition-all">
                            Execute Profile Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
