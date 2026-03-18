<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function Index()
    {
        $user = Auth::user();

        // Calculate standard financial metrics for the mosque
        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'saldo'));
    }
}
