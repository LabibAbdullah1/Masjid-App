<section class="space-y-12">
    <header class="flex items-center gap-6 p-8 bg-primary/5 rounded-[2rem] border border-primary/10 mb-10">
        <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-white shadow-xl shadow-primary/20">
            <i class="fa fa-shield-halved text-2xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-black tracking-tight text-white mb-1">
                {{ __('Protokol Keamanan') }}
            </h2>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40">
                {{ __('Secure authentication override system.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="max-w-3xl space-y-10">
        @csrf
        @method('put')

        <div class="space-y-10">
            {{-- Current Password --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Current Access Key</span>
                </label>
                <div class="relative group">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                        <i class="fa fa-key text-lg"></i>
                    </div>
                    <input type="password" name="current_password" 
                           class="input input-lg w-full pl-16 bg-base-300/30 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                           autocomplete="current-password" />
                </div>
                @error('current_password', 'updatePassword') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                {{-- New Password --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">New Security Vector</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                            <i class="fa fa-lock-open text-lg"></i>
                        </div>
                        <input type="password" name="password" 
                               class="input input-lg w-full pl-16 bg-base-300/30 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                               autocomplete="new-password" />
                    </div>
                    @error('password', 'updatePassword') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Vector Verification</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-20 group-focus-within:opacity-100 transition-opacity">
                            <i class="fa fa-shield-check text-lg"></i>
                        </div>
                        <input type="password" name="password_confirmation" 
                               class="input input-lg w-full pl-16 bg-base-300/30 border-base-300 focus:border-primary focus:outline-none transition-all font-black text-lg rounded-2xl" 
                               autocomplete="new-password" />
                    </div>
                    @error('password_confirmation', 'updatePassword') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 pt-6 border-t border-white/5">
            <button type="submit" class="btn btn-primary btn-lg rounded-2xl font-black px-12 futuristic-bg border-none text-white hover:scale-105 transition-all">
                Update Protocol
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                     class="flex items-center gap-2 text-success font-black uppercase text-[10px] tracking-widest">
                    <i class="fa fa-lock scale-125"></i>
                    {{ __('Vector Secured') }}
                </div>
            @endif
        </div>
    </form>
</section>
