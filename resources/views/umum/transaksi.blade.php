{{-- resources/views/umum/transaksi.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        
        {{-- Futuristic Header --}}
        <div class="futuristic-bg p-8 md:p-12 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter uppercase mb-2">
                    Financial Ledger
                </h1>
                <p class="text-white/70 font-bold uppercase text-[10px] md:text-xs tracking-[0.4em]">Mosque Operational Transaction Repository</p>
            </div>
        </div>

        {{-- Category Navigation (Futuristic Tabs) --}}
        <div class="flex flex-wrap justify-center gap-2 p-2 bg-base-300/30 backdrop-blur-md rounded-3xl border border-white/5">
            @foreach ($kategoriList as $kategori)
                @php
                    $isActive = request()->input('kategori_id') == $kategori->id;
                @endphp
                <a href="{{ route('umum.transaksi', ['kategori_id' => $kategori->id]) }}"
                   class="px-6 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all duration-300 {{ $isActive ? 'bg-primary text-primary-content shadow-lg scale-105' : 'hover:bg-base-200 text-base-content/60' }}">
                   {{ $kategori->nama_kategori }}
                </a>
            @endforeach
        </div>

        {{-- Financial Summary Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Income --}}
            <div class="glass-card p-8 rounded-[2rem] border-success/20 overflow-hidden relative group" x-data="counter({{ $totalPemasukan }})" x-init="start()">
                <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-700">
                    <i class="fa fa-arrow-down-to-bracket text-8xl text-success"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-success">Credits / Inflow</span>
                <div class="text-3xl font-black mt-2 tracking-tighter text-base-content">
                    Rp <span x-text="displayCount()">@isset($totalPemasukan){{ number_format($totalPemasukan, 0, ',', '.') }}@else 0 @endisset</span>
                </div>
                <div class="w-full h-1 bg-success/10 rounded-full mt-4 overflow-hidden">
                    <div class="h-full bg-success w-2/3"></div>
                </div>
            </div>

            {{-- Total Expense --}}
            <div class="glass-card p-8 rounded-[2rem] border-error/20 overflow-hidden relative group" x-data="counter({{ $totalPengeluaran }})" x-init="start()">
                <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-700">
                    <i class="fa fa-arrow-up-from-bracket text-8xl text-error"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-error">Debits / Outflow</span>
                <div class="text-3xl font-black mt-2 tracking-tighter text-base-content">
                    Rp <span x-text="displayCount()">@isset($totalPengeluaran){{ number_format($totalPengeluaran, 0, ',', '.') }}@else 0 @endisset</span>
                </div>
                <div class="w-full h-1 bg-error/10 rounded-full mt-4 overflow-hidden">
                    <div class="h-full bg-error w-1/3"></div>
                </div>
            </div>

            {{-- Net Balance --}}
            <div class="glass-card p-8 rounded-[2rem] border-primary/20 overflow-hidden relative group" x-data="counter({{ $saldo }})" x-init="start()">
                <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-700">
                    <i class="fa fa-scale-balanced text-8xl text-primary"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary">Current Liquid Assets</span>
                <div class="text-3xl font-black mt-2 tracking-tighter text-base-content">
                    Rp <span x-text="displayCount()">@isset($saldo){{ number_format($saldo, 0, ',', '.') }}@else 0 @endisset</span>
                </div>
                <div class="w-full h-1 bg-primary/10 rounded-full mt-4 overflow-hidden">
                    <div class="h-full bg-primary w-full"></div>
                </div>
            </div>
        </div>

        {{-- Transaction Ledger --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden border-white/5 shadow-2xl">
            <div class="p-8 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black tracking-tight text-base-content">{{ $activeKategoriName }} Ledger</h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40">System Transaction Logs</p>
                </div>
                <div class="badge badge-primary font-black uppercase text-[10px] tracking-widest p-4">Validated Records</div>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-base-200/50">
                            <th class="font-black uppercase tracking-widest text-[10px] opacity-60">ID</th>
                            <th class="font-black uppercase tracking-widest text-[10px] opacity-60">Timestamp</th>
                            <th class="font-black uppercase tracking-widest text-[10px] opacity-60">Classification</th>
                            <th class="font-black uppercase tracking-widest text-[10px] opacity-60">Quantifier</th>
                            <th class="font-black uppercase tracking-widest text-[10px] opacity-60">Protocol Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($transaksis as $item)
                            <tr class="hover:bg-primary/5 transition-colors duration-300">
                                <td class="font-mono text-xs opacity-40">
                                    #{{ str_pad($loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage(), 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="font-bold text-sm">{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $item->jenis == 'pemasukan' ? 'badge-success' : 'badge-error' }} badge-outline font-black uppercase text-[8px] tracking-[0.2em] px-2">
                                        {{ $item->jenis }}
                                    </span>
                                </td>
                                <td class="font-black tracking-tight {{ $item->jenis == 'pemasukan' ? 'text-success' : 'text-error' }}">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="text-sm font-bold opacity-70">{{ $item->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <i class="fa fa-database text-4xl opacity-10 mb-4 block"></i>
                                    <span class="font-black uppercase tracking-widest opacity-20">Zero Ledger Entries</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $transaksis->withQueryString()->links() }}
        </div>
    </div>
@endsection
