{{-- resources/views/transaksi/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8" data-aos="fade-up">
        {{-- Header --}}
        <h1 class="text-3xl font-bold mb-2 text-center text-green-700">
            <i class="fas fa-money-bill-wave mr-2"></i> Kelola Transaksi
        </h1>
        <p class="text-gray-600 font-semibold text-center mb-6">
            Pilih kategori di bawah untuk menampilkan data sesuai kebutuhan
        </p>

        <div class="flex justify-end mb-4 space-x-3">
            {{-- Tombol Cetak PDF --}}
            @if (!empty($kategoriId))
                <form action="{{ route('transaksi.cetak') }}" method="GET" target="_blank">
                    <input type="hidden" name="bulan" value="{{ request('bulan') ?? date('m') }}">
                    <input type="hidden" name="tahun" value="{{ request('tahun') ?? date('Y') }}">
                    <input type="hidden" name="kategori_id" value="{{ $kategoriId }}">
                    <button type="submit"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        Cetak PDF
                    </button>
                </form>
            @endif

            {{-- Tombol Tambah Transaksi --}}
            <a href="{{ route('transaksi.create') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Tambah Transaksi
            </a>
        </div>

        {{-- Navigasi Kategori --}}
        <nav class="bg-green-600 text-white rounded-t-lg p-4 shadow-lg mb-0" data-aos="fade-up" data-aos-delay="200">
            <ul class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0 items-center justify-center">
                @foreach ($kategoriList as $kategori)
                    @php
                        $currentKategoriId = request()->input('kategori_id');
                        $isActive = $currentKategoriId == $kategori->id;
                        $activeClass = $isActive
                            ? 'bg-yellow-500 text-white'
                            : 'text-white hover:text-yellow-300 hover:bg-green-700';
                    @endphp
                    <li>
                        <a href="{{ route('transaksi.index', ['kategori_id' => $kategori->id]) }}"
                            class="block px-4 py-2 text-md font-semibold transition duration-300 ease-in-out rounded-lg {{ $activeClass }}">
                            {{ $kategori->nama_kategori }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Ringkasan Keuangan --}}
        <div class="bg-white shadow-md p-4 rounded-b-lg mb-6 border-2 border-green-600" data-aos="fade-up"
            data-aos-delay="200">
            <h2 class="text-lg font-semibold mb-3">
                Ringkasan Keuangan: {{ $kategoriAktif->nama_kategori ?? 'Keseluruhan' }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Total Pemasukan -->
                <div x-data="counter({{ $totalPemasukan }})" x-init="start()" class="p-3 bg-green-100 rounded">
                    <span class="block text-sm text-green-700">Total Pemasukan</span>
                    <span class="text-xl font-bold text-green-800">
                        Rp <span x-text="displayCount()"></span>
                    </span>
                </div>

                <!-- Total Pengeluaran -->
                <div x-data="counter({{ $totalPengeluaran }})" x-init="start()" class="p-3 bg-red-100 rounded">
                    <span class="block text-sm text-red-700">Total Pengeluaran</span>
                    <span class="text-xl font-bold text-red-800">
                        Rp <span x-text="displayCount()"></span>
                    </span>
                </div>

                <!-- Saldo -->
                <div x-data="counter({{ $saldo }})" x-init="start()" class="p-3 bg-blue-100 rounded">
                    <span class="block text-sm text-blue-700">Saldo</span>
                    <span class="text-xl font-bold text-blue-800">
                        Rp <span x-text="displayCount()"></span>
                    </span>
                </div>
            </div>
        </div>

        {{-- Tabel Transaksi --}}
        <div class="max-w-full bg-white shadow-lg rounded-lg overflow-x-auto border-2 border-green-600" data-aos="fade-up"
            data-aos-delay="400">
            <table class="min-w-full leading-normal">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            No
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Jenis
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Kategori
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-center text-sm font-semibold uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $item)
                        <tr class="hover:bg-green-50 transition duration-150">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm capitalize">
                                {{ $item->jenis }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm first-letter:uppercase">
                                {{ $item->keterangan }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{-- Tampilkan nama kategori --}}
                                {{ $item->kategori ? $item->kategori->nama_kategori : '-' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('transaksi.edit', $item->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 transition duration-150">
                                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition duration-150">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-5 text-center text-gray-500">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


        {{-- Pagination --}}
        <div class="mt-6">
            {{ $transaksis->withQueryString()->links() }}
        </div>
    </div>
@endsection
