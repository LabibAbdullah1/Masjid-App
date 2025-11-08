{{-- resources/views/transaksi/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Transaksi Masjid')

@section('content')
    <div class="bg-green-50/75 dark:bg-green-900 overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-green-700 border"
        data-aos="fade-up">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-3xl font-bold mt-4 text-green-800 dark:text-green-300 tracking-wide">
                <svg class="w-7
                h-7 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h4l3-7 4 14 3-7h4"></path>
                </svg>
                Tambah Transaksi Masjid
            </h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block font-medium text-green-800 dark:text-green-300">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                        value="{{ old('tanggal') }}" **required**>
                    @error('tanggal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori Keuangan --}}
                <div>
                    <label for="kategori_keuangan_id" class="block font-medium text-green-800 dark:text-green-300">Kategori
                        Keuangan</label>
                    <select name="kategori_id" id="kategori_id"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                        required>
                        <option value="">Pilih Kategori Keuangan</option>
                        @foreach ($kategoriKeuangan as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_keuangan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Transaksi --}}
                <div>
                    <label for="jenis" class="block font-medium text-green-800 dark:text-green-300">Jenis
                        Transaksi</label>
                    <select name="jenis" id="jenis"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                        **required**>
                        <option value="pemasukan" {{ old('jenis') == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ old('jenis') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran
                        </option>
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah --}}
                <div>
                    <label for="jumlah" class="block font-medium text-green-800 dark:text-green-300">Jumlah (Rp)</label>
                    <input type="number" name="jumlah" id="jumlah" step="1000" min="0"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                        value="{{ old('jumlah') }}" **required**>
                    @error('jumlah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block font-medium text-green-800 dark:text-green-300">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"**required**>{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('transaksi.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600">Batal</a>
                    <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
