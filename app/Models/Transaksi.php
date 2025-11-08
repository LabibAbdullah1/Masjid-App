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
}
