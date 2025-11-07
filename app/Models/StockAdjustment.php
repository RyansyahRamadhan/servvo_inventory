<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    // Pakai tabel yang sudah kamu buat di DB
    protected $table = 'penyesuaian';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'no_dokumen',
        'tanggal',
        'kode_barang',
        'nama_barang',
        'nama_lorong',
        'nama_rak',
        'qty',
        'keterangan',
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal' => 'date',
        'qty'     => 'integer',
    ];

    // Kalau tabelmu tidak punya created_at/updated_at, set false:
    // public $timestamps = false;
}
