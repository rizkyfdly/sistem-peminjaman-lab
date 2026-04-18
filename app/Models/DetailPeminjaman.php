<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'barang_id',
        'jumlah',
    ];

    // relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}