<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang'; // nama tabel
    protected $primaryKey = 'kode_barang'; 
    public $incrementing = false; // karena kode_barang bukan auto-increment
    protected $keyType = 'string'; // jika  kode_barang bertipe string

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'kategori_barang',
    ];
}
