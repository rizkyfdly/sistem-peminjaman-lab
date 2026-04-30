<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopBarang extends Model
{
    use HasFactory;

    protected $table = 'sop_barang';

    protected $fillable = [
        'barang_id',
        'isi_sop',
    ];

    // relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}