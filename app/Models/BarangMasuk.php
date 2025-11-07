<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    public $timestamps = false;
    protected $fillable = [
        'no_dokumen_masuk',
        'tanggal_masuk',
        'kode_barang',
        'nama_barang',
        'kategori_barang',
        'jumlah',
        'kapasitas',
        'nama_lorong',
        'nama_rak',
    ];
}
