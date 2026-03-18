<section class="space-y-12">
    <header class="flex items-center gap-6 p-8 bg-primary/5 rounded-[2rem] border border-primary/10 mb-10">
        <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-white shadow-xl shadow-primary/20">
            <i class="fa fa-id-card text-2xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-black tracking-tight text-white mb-1">
                {{ __('Informasi Identitas') }}
            </h2>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40">
                {{ __('Update your profile identifiers and contact link.') }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-10">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Nama -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Profile Alias / Name</span>
                </label>
                <div class="relative group">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                        <i class="fa fa-user-tag text-lg"></i>
                    </div>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="input input-lg w-full pl-16 bg-base-300/30 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                           required autofocus autocomplete="name" />
                </div>
                @error('name') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Communication Node (Email)</span>
                </label>
                <div class="relative group">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                        <i class="fa fa-envelope text-lg"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="input input-lg w-full pl-16 bg-base-300/30 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                           required autocomplete="username" />
                </div>
                @error('email') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-6 p-6 glass-card border-warning/20 bg-warning/5 rounded-2xl">
                        <p class="text-xs font-bold text-warning flex items-center gap-3">
                            <i class="fa fa-triangle-exclamation text-lg"></i>
                            {{ __('Verification protocol required.') }}
                        </p>
                        <button form="send-verification" class="mt-4 btn btn-xs btn-warning btn-outline rounded-lg font-black tracking-widest uppercase">
                            {{ __('Re-trigger Verification') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-3 text-[9px] font-black uppercase tracking-widest text-success animate-pulse">
                                {{ __('New link dispatched to transmission node.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-6 pt-6 border-t border-white/5">
            <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black px-12 futuristic-bg border-none text-white hover:scale-105 transition-all">
                Update Identity
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="flex items-center gap-2 text-success font-black uppercase text-[10px] tracking-widest">
                    <i class="fa fa-check-double scale-125"></i>
                    {{ __('Node Updated Successfully') }}
                </div>
            @endif
        </div>
    </form>
</section>
