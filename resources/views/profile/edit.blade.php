@extends('layouts.app')

@section('header', 'System Identity')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Futuristic Header --}}
        <div class="glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <i class="fa fa-user-gear text-4xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Profil Identitas Akun</h2>
                    <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Personal Data & Security Protocol</p>
                </div>
            </div>
        </div>

        <div class="space-y-12">
            <!-- Update Profile -->
            <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" data-aos="zoom-in">
                <div class="p-10 lg:p-16">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-10 lg:p-16">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-red-500/10 group/delete" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-10 lg:p-16">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
