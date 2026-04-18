<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'tanggal_pinjam',
        'jam_pinjam',
        'tanggal_kembali',
        'jam_kembali',
        'status',
        'kondisi_kembali',
        'denda',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke detail peminjaman
    public function detail()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }
}