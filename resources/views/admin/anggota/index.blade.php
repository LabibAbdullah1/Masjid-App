@extends('layouts.app')

@section('header', 'Manajemen Anggota')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Header & Stats Highlight --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Welcome Tile --}}
            <div class="lg:col-span-2 glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                    <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                        <i class="fa fa-users-gear text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">Database Jamaah</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Personnel Management System</p>
                    </div>
                    <div class="md:ml-auto">
                        <a href="{{ route('admin.anggota.create') }}" class="btn btn-white bg-white/20 hover:bg-white text-white hover:text-primary rounded-2xl border-none shadow-xl px-8 transition-all hover:scale-105">
                            <i class="fa fa-plus-circle mr-2"></i> Tambah Anggota
                        </a>
                    </div>
                </div>
            </div>

            {{-- Counter Tile --}}
            <div class="glass-card rounded-[2.5rem] p-8 border border-primary/20 flex flex-col items-center justify-center text-center">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40 mb-2">Authenticated Members</span>
                <div class="text-5xl font-black text-primary flex items-baseline gap-2">
                    <span id="total-anggota">{{ $totalAnggota }}</span>
                    <span class="text-sm opacity-40">Jamaah</span>
                </div>
                <div class="mt-4 flex items-center gap-2 text-[10px] font-bold opacity-60">
                    <i class="fa fa-circle-check text-success"></i>
                    CLOUD SYNCHRONIZED
                </div>
            </div>
        </div>

        {{-- Filter & Search Action Bar --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="relative w-full md:w-1/2 group">
                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-primary opacity-40 group-focus-within:opacity-100 transition-opacity">
                    <i class="fa fa-search text-xl"></i>
                </div>
                <input type="text" id="search" placeholder="Search by name, email, or digital signature..."
                    class="input input-lg w-full pl-16 bg-base-100/50 backdrop-blur-sm border-base-200 focus:border-primary focus:outline-none rounded-2xl font-bold shadow-sm transition-all">
            </div>
            
            <div class="flex gap-2 w-full md:w-auto">
                <button class="btn btn-ghost rounded-2xl font-black px-6">
                    <i class="fa fa-filter-list mr-2 opacity-40"></i> Filter
                </button>
                <button class="btn btn-outline rounded-2xl border-2 px-6">
                    <i class="fa fa-download mr-2 opacity-40"></i> Export
                </button>
            </div>
        </div>

        {{-- Table Display with Glassmorphism --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-primary/5 text-primary/60 font-black uppercase text-[10px] tracking-[0.2em]">
                            <th class="py-8 pl-10">Identifier</th>
                            <th>Identity Detail</th>
                            <th>Contact Endpoint</th>
                            <th class="text-center pr-10">Administrative Control</th>
                        </tr>
                    </thead>
                    <tbody id="anggota-table" class="divide-y divide-base-200">
                        @forelse ($umums as $umum)
                            <tr class="hover:bg-primary/5 transition-all group">
                                <td class="py-10 pl-10">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-base-200 text-base-content/40 w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">
                                            #{{ $loop->iteration + ($umums->currentPage() - 1) * $umums->perPage() }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span class="text-lg font-black tracking-tight group-hover:text-primary transition-colors">{{ $umum->name }}</span>
                                        <span class="text-[9px] font-black uppercase opacity-40 tracking-[0.2em] mt-1">Verified Member</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2 font-bold opacity-60">
                                        <i class="fa fa-envelope-open text-xs text-primary/40"></i>
                                        {{ $umum->email }}
                                    </div>
                                </td>
                                <td class="text-center pr-10">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.anggota.edit', $umum->id) }}"
                                           class="btn btn-square btn-ghost text-warning hover:bg-warning/10 transition-colors">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.anggota.delete', $umum->id) }}" method="POST"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-square btn-ghost text-error hover:bg-error/10 transition-colors">
                                                <i class="fa-solid fa-trash-can text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-32 text-center">
                                    <div class="flex flex-col items-center gap-6 opacity-20">
                                        <i class="fa fa-users-slash text-9xl"></i>
                                        <span class="text-2xl font-black uppercase tracking-[0.4em]">Zero Assets Detected</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-10 bg-base-200/20" id="pagination-links">
                {{ $umums->links() }}
            </div>
        </div>
    </div>

    {{-- Live Search AJAX Integration --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const anggotaTable = document.getElementById('anggota-table');
            const totalAnggota = document.getElementById('total-anggota');

            searchInput.addEventListener('keyup', function() {
                const keyword = this.value;

                fetch(`{{ route('admin.anggota.index') }}?search=${keyword}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        anggotaTable.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach((item, index) => {
                                anggotaTable.innerHTML += `
                                    <tr class="hover:bg-primary/5 transition-all group border-b border-base-200">
                                        <td class="py-10 pl-10">
                                            <div class="flex items-center gap-4">
                                                <div class="bg-base-200 text-base-content/40 w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">
                                                    #${index + 1}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex flex-col">
                                                <span class="text-lg font-black tracking-tight group-hover:text-primary transition-colors">${item.name}</span>
                                                <span class="text-[9px] font-black uppercase opacity-40 tracking-[0.2em] mt-1">Found Asset</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2 font-bold opacity-60">
                                                <i class="fa fa-envelope-open text-xs text-primary/40"></i>
                                                ${item.email}
                                            </div>
                                        </td>
                                        <td class="text-center pr-10">
                                            <div class="flex justify-center gap-3">
                                                <a href="/admin/anggota/${item.id}/edit" class="btn btn-square btn-ghost text-warning hover:bg-warning/10 transition-colors">
                                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                                </a>
                                                <form action="/admin/anggota/${item.id}" method="POST" class="delete-form inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-square btn-ghost text-error hover:bg-error/10 transition-colors">
                                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>`;
                            });
                        } else {
                            anggotaTable.innerHTML = `
                                <tr>
                                    <td colspan="4" class="py-32 text-center">
                                        <div class="flex flex-col items-center gap-6 opacity-20">
                                            <i class="fa fa-search-minus text-9xl"></i>
                                            <span class="text-2xl font-black uppercase tracking-[0.4em]">No Match Found</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }

                        totalAnggota.textContent = data.length;
                    });
            });
        });
    </script>
@endsection
