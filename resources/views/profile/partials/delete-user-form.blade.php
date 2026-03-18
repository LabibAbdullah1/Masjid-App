<section class="space-y-12">
    <header class="flex items-center gap-6 p-8 bg-error/5 rounded-[2rem] border border-error/10 mb-10">
        <div class="w-16 h-16 rounded-2xl bg-error flex items-center justify-center text-white shadow-xl shadow-error/20">
            <i class="fa fa-skull-crossbones text-2xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-black tracking-tight text-white mb-1">
                {{ __('Terminasi Data Permanen') }}
            </h2>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40">
                {{ __('Account deletion protocol - irreversible action.') }}
            </p>
        </div>
    </header>

    <div class="max-w-xl">
        <p class="text-sm font-bold opacity-60 leading-relaxed mb-10">
            {{ __('Once your account is terminated, all associated data segments will be wiped from our core memory banks. Please ensure all critical data has been backed up before proceeding with the purge protocol.') }}
        </p>

        <button type="button" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="btn btn-error btn-lg rounded-2xl font-black px-12 group transition-all hover:scale-105">
            <i class="fa fa-fire mr-3 group-hover:animate-pulse"></i> {{ __('Initiate Purge') }}
        </button>
    </div>

    <!-- Modal Konfirmasi -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="glass-card rounded-[3rem] overflow-hidden border border-white/10 shadow-2xl">
            <form method="POST" action="{{ route('profile.destroy') }}" class="p-10 lg:p-16 space-y-12 bg-base-100">
                @csrf
                @method('delete')

                <div>
                    <h2 class="text-3xl font-black tracking-tighter text-error mb-4">
                        {{ __('Confirm Data Purge?') }}
                    </h2>
                    <p class="text-sm font-bold opacity-60">
                        {{ __('This action will result in permanent data loss. Please authorize using your primary access key.') }}
                    </p>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Primary Access Key (Password)</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-error opacity-20 group-focus-within:opacity-100 transition-opacity">
                            <i class="fa fa-key text-lg"></i>
                        </div>
                        <input type="password" name="password" placeholder="Verify identity..."
                               class="input input-lg w-full pl-16 bg-error/5 border-error/20 focus:border-error focus:outline-none transition-all font-black text-lg rounded-2xl" />
                    </div>
                    @error('password', 'userDeletion') <span class="text-error text-[10px] font-black uppercase mt-2 ml-2 tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end gap-6 pt-6 border-t border-white/5">
                    <button type="button" x-on:click.prevent="$dispatch('close', 'confirm-user-deletion')"
                            class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-12 transition-all">
                        {{ __('Abort Purge') }}
                    </button>
                    <button type="submit" class="btn btn-error btn-lg rounded-2xl font-black w-full sm:w-auto px-16 shadow-2xl shadow-error/30 transition-all hover:scale-105">
                        {{ __('Commit Deletion') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
