@extends('layouts.app')

@section('content')
    <div class="space-y-6" data-aos="fade-up">
        {{-- Page Title & Header Actions --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-base-content flex items-center gap-3">
                    <i class="fa fa-wallet text-primary"></i>
                    Manajemen Keuangan
                </h1>
                <p class="text-sm opacity-60 font-bold uppercase tracking-widest mt-1">Laporan Arus Kas Masjid</p>
            </div>
            
            <div class="flex items-center gap-2">
                @if (!empty($kategoriId))
                    <form action="{{ route('transaksi.cetak') }}" method="GET" target="_blank">
                        <input type="hidden" name="bulan" value="{{ request('bulan') ?? date('m') }}">
                        <input type="hidden" name="tahun" value="{{ request('tahun') ?? date('Y') }}">
                        <input type="hidden" name="kategori_id" value="{{ $kategoriId }}">
                        <button type="submit" class="btn btn-outline btn-warning gap-2">
                            <i class="fa fa-file-pdf"></i>
                            Cetak Laporan
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary gap-2 shadow-lg shadow-primary/20">
                    <i class="fa fa-plus"></i>
                    Tambah Transaksi
                </a>
            </div>
        </div>

        {{-- Kategori Tabs --}}
        <div class="bg-base-100 p-2 rounded-xl shadow-sm border border-base-200 overflow-x-auto">
            <div class="tabs tabs-boxed bg-transparent gap-1">
                @foreach ($kategoriList as $kategori)
                    @php
                        $currentKategoriId = request()->input('kategori_id');
                        $isActive = $currentKategoriId == $kategori->id;
                    @endphp
                    <a href="{{ route('transaksi.index', ['kategori_id' => $kategori->id]) }}" 
                       class="tab tab-lg px-6 font-bold transition-all {{ $isActive ? 'tab-active !bg-primary !text-primary-content' : 'hover:bg-base-200' }}">
                        {{ $kategori->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Stats Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="stats shadow bg-base-100 border border-base-200">
                <div class="stat">
                    <div class="stat-title text-success font-bold uppercase text-xs opacity-60">Pemasukan</div>
                    <div class="stat-value text-success">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    <div class="stat-desc font-medium">Berdasarkan filter aktif</div>
                </div>
            </div>
            
            <div class="stats shadow bg-base-100 border border-base-200">
                <div class="stat">
                    <div class="stat-title text-error font-bold uppercase text-xs opacity-60">Pengeluaran</div>
                    <div class="stat-value text-error">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    <div class="stat-desc font-medium">Berdasarkan filter aktif</div>
                </div>
            </div>

            <div class="stats shadow bg-primary text-primary-content border border-primary/20">
                <div class="stat">
                    <div class="stat-title text-primary-content font-bold uppercase text-xs opacity-70">Saldo Akhir</div>
                    <div class="stat-value font-black">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                    <div class="stat-desc text-primary-content opacity-70 font-medium">Kategori: {{ $kategoriAktif->nama_kategori ?? 'Semua' }}</div>
                </div>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="table table-lg w-full">
                        <thead class="bg-base-200/50">
                            <tr>
                                <th class="w-16">No</th>
                                <th>Informasi Transaksi</th>
                                <th>Kategori</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $item)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td class="font-bold opacity-40">
                                        {{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="font-black text-lg">{{ $item->keterangan }}</span>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="badge badge-ghost badge-sm font-bold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                                @if(strtolower($item->jenis) == 'pemasukan')
                                                    <span class="badge badge-success badge-sm text-white font-bold gap-1">
                                                        <i class="fa fa-arrow-down scale-75"></i> Masuk
                                                    </span>
                                                @else
                                                    <span class="badge badge-error badge-sm text-white font-bold gap-1">
                                                        <i class="fa fa-arrow-up scale-75"></i> Keluar
                                                    </span>
                                                @endif
                                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-outline font-bold opacity-70">{{ $item->kategori->nama_kategori }}</div>
                                    </td>
                                    <td class="text-right font-black">
                                        <span class="{{ strtolower($item->jenis) == 'pemasukan' ? 'text-success' : 'text-error' }}">
                                            {{ strtolower($item->jenis) == 'pemasukan' ? '+' : '-' }}
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-square btn-ghost btn-sm text-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-square btn-ghost btn-sm text-error" onclick="return confirm('Hapus transaksi ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center opacity-30">
                                        <div class="flex flex-col items-center gap-4">
                                            <i class="fa fa-folder-open text-6xl"></i>
                                            <span class="font-black uppercase tracking-widest">Tidak ada data transaksi</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- Pagination --}}
            @if($transaksis->hasPages())
                <div class="card-footer p-6 border-t border-base-200">
                    {{ $transaksis->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
