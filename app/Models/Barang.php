<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori',
        'satuan',
        'stok',
        'kondisi',
        'lokasi',
    ];

    // relasi ke detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    // relasi ke SOP
    public function sop()
    {
        return $this->hasMany(SopBarang::class);
    }
}