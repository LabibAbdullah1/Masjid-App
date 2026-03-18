<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'jenis',
        'tanggal',
        'jumlah',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKeuangan::class, 'kategori_id');
    }

    /**
     * Get centralized financial summary for "Kas Masjid"
     */
    public static function getSummary()
    {
        $kategoriKas = KategoriKeuangan::where('nama_kategori', 'Kas Masjid')->first();
        
        if (!$kategoriKas) {
            return [
                'totalPemasukan' => 0,
                'totalPengeluaran' => 0,
                'saldo' => 0,
                'kategoriName' => 'Kas Masjid'
            ];
        }

        $totalPemasukan = self::where('jenis', 'pemasukan')
            ->where('kategori_id', $kategoriKas->id)
            ->sum('jumlah');

        $totalPengeluaran = self::where('jenis', 'pengeluaran')
            ->where('kategori_id', $kategoriKas->id)
            ->sum('jumlah');

        return [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $totalPemasukan - $totalPengeluaran,
            'kategoriName' => $kategoriKas->nama_kategori
        ];
    }
}
