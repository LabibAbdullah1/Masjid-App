<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\KategoriKeuangan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    // untuk admin
    public function index(Request $request)
    {
        $kategoriId = $request->input('kategori_id');

        $query = Transaksi::query();

        if ($kategoriId && $kategoriId != 'semua') {
            $query->where('kategori_id', $kategoriId);
        }

        $totalPemasukan = (clone $query)->where('jenis', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $query)->where('jenis', 'Pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $transaksis = (clone $query)->with('kategori')->latest()->paginate(10);

        $kategoriList = KategoriKeuangan::all();

        $totalPerKategori = Transaksi::select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->orderByDesc('total')
            ->get();

        $kategoriAktif = null;

        if ($kategoriId && $kategoriId !== 'semua') {
            $kategoriAktif = KategoriKeuangan::find($kategoriId);
        }

        return view('transaksi.index', compact(
            'transaksis',
            'kategoriList',
            'kategoriId',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'totalPerKategori',
            'kategoriAktif',
        ));
    }

    // untuk tampilan ke umum
    public function umumindex(Request $request)
    {
        $kategoriId = $request->input('kategori_id');

        $query = Transaksi::query();

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($kategoriId) {
            $transaksiss = Transaksi::where('kategori_id', $kategoriId)->get();
        } else {

            $transaksiss = Transaksi::where('kategori_id', 1)->get();
        }
        $kategoriList = KategoriKeuangan::all();
        $activeKategoriName = 'Semua Kategori';
        if ($kategoriId) {
            $activeKategori = $kategoriList->firstWhere('id', $kategoriId);
            if ($activeKategori) {
                $activeKategoriName = $activeKategori->nama_kategori;
            }
        }
        $kategoriAktif = KategoriKeuangan::where('status', 'aktif')->first();
        $transaksi = Transaksi::where('kategori_id', $kategoriAktif->id)->get();


        $totalPemasukan = (clone $query)->where('jenis', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $query)->where('jenis', 'Pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $transaksis = (clone $query)->with('kategori')->latest()->paginate(10);

        $kategoriList = KategoriKeuangan::all();

        $totalPerKategori = Transaksi::select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->orderByDesc('total')
            ->get();

        return view('umum.transaksi', compact(
            'transaksis',
            'transaksiss',
            'kategoriList',
            'kategoriId',
            'totalPemasukan',
            'totalPengeluaran',
            'activeKategoriName',
            'saldo',
            'totalPerKategori'
        ));
    }

    //cetak pdf file
    public function cetakPDF(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kategoriId = $request->kategori_id; // Ambil kategori aktif dari request

        // Cek apakah kategori dipilih
        if (!$kategoriId) {
            return redirect()->back()->with('error', 'Silakan pilih kategori terlebih dahulu sebelum mencetak PDF.');
        }

        // Ambil data kategori aktif
        $activeKategori = KategoriKeuangan::find($kategoriId);
        if (!$activeKategori) {
            return redirect()->back()->with('error', 'Kategori yang dipilih tidak ditemukan.');
        }

        $activeKategoriName = $activeKategori->nama_kategori;

        // Ambil data keuangan hanya untuk kategori aktif
        $keuangan = Transaksi::where('kategori_id', $kategoriId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Jika tidak ada data keuangan, beri notifikasi
        if ($keuangan->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data keuangan untuk kategori ini pada bulan dan tahun yang dipilih.');
        }

        // Hitung total pemasukan & pengeluaran sesuai kategori aktif
        $totalPemasukan = $keuangan->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Generate PDF
        $pdf = PDF::loadView('transaksi.cetak', compact(
            'keuangan',
            'bulan',
            'tahun',
            'activeKategoriName',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir'
        ));

        return $pdf->stream('laporan-keuangan-' . $activeKategoriName . '-' . $bulan . '-' . $tahun . '.pdf');
    }

    // buat data kauangan
    public function create()
    {
        $kategoriKeuangan = KategoriKeuangan::all();

        return view('transaksi.create', compact('kategoriKeuangan'));
    }

    // simpan data keuangan
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_keuangan,id',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Transaksi::create($validatedData);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // edit data keuangan
    public function edit(Transaksi $transaksi)
    {
        $kategoriKeuangan = KategoriKeuangan::all();

        return view('transaksi.edit', compact('transaksi', 'kategoriKeuangan'));
    }

    // update data kuangan
    public function update(Request $request, Transaksi $transaksi)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_keuangan,id',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $transaksi->update($validatedData);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    //hapus data keuangan
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
