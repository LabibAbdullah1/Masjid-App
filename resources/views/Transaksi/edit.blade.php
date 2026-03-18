@extends('layouts.app')

@section('header', 'Modifikasi Transaksi')

@section('content')
    <div class="max-w-4xl mx-auto py-8" data-aos="zoom-in">
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10 group">
            {{-- Futuristic Card Header with Warning/Edit Accent --}}
            <div class="bg-gradient-to-br from-orange-400 to-yellow-600 p-10 text-white relative futuristic-bg">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex items-center gap-6">
                    <div class="p-4 bg-white/20 backdrop-blur-xl rounded-2xl border border-white/30">
                        <i class="fa-solid fa-pen-to-square text-4xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">Edit Data Keuangan</h2>
                        <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Correction & Revision Protocol</p>
                    </div>
                </div>
            </div>

            <div class="p-8 lg:p-12">
                @if ($errors->any())
                    <div class="alert alert-error glass-card text-white mb-8 border-none" data-aos="shake">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                        <div class="flex flex-col">
                            <span class="font-black uppercase text-xs tracking-widest">Update Data Gagal</span>
                            <ul class="text-sm font-bold opacity-80 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        {{-- Tanggal --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Periodization</span>
                            </label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}" 
                                   class="input input-lg bg-base-200/50 border-base-300 focus:border-orange-500 focus:outline-none transition-all font-black text-lg rounded-2xl w-full" required />
                        </div>

                        {{-- Jenis Transaksi --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Classification</span>
                            </label>
                            <select name="jenis" class="select select-lg bg-base-200/50 border-base-300 focus:border-orange-500 focus:outline-none transition-all font-black text-lg rounded-2xl w-full" required>
                                <option value="pemasukan" {{ old('jenis', $transaksi->jenis) == 'pemasukan' ? 'selected' : '' }}>Pemasukan (Income)</option>
                                <option value="pengeluaran" {{ old('jenis', $transaksi->jenis) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran (Expense)</option>
                            </select>
                        </div>

                        {{-- Kategori --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Budget Category</span>
                            </label>
                            <select name="kategori_id" class="select select-lg bg-base-200/50 border-base-300 focus:border-orange-500 focus:outline-none transition-all font-black text-lg rounded-2xl w-full" required>
                                <option value="" disabled>Select Allocation</option>
                                @foreach ($kategoriKeuangan as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $transaksi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Nominal Amount</span>
                            </label>
                            <div class="relative group/input">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 font-black text-xl opacity-20 group-focus-within/input:opacity-100 transition-opacity">Rp</div>
                                <input type="number" name="jumlah" value="{{ old('jumlah', (int)$transaksi->jumlah) }}" step="1" min="0" placeholder="0"
                                       class="input input-lg bg-base-200/50 border-base-300 focus:border-orange-500 focus:outline-none transition-all font-black text-2xl rounded-2xl w-full pl-16 py-8" required />
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-black uppercase text-[10px] tracking-widest opacity-40">Transaction Documentation</span>
                        </label>
                        <textarea name="keterangan" rows="4" placeholder="Update the purpose of this transaction..."
                                  class="textarea textarea-lg bg-base-200/50 border-base-300 focus:border-orange-500 focus:outline-none transition-all font-bold text-lg rounded-2xl w-full p-6" required>{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                    </div>

                    <div class="pt-6">
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-4">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-ghost btn-lg rounded-2xl font-black w-full sm:w-auto px-10 order-2 sm:order-1 transition-all">
                                Discard Changes
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg rounded-2xl font-black w-full sm:w-auto px-12 order-1 sm:order-2 shadow-2xl shadow-orange-500/30 border-none text-white hover:scale-105 transition-all">
                                <i class="fa fa-save mr-2"></i>
                                Save Revisions
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
