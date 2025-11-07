<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class StandartPallet extends Model
{
    protected $table = 'standar_rak_pallet';
    protected $primaryKey = 'id';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori_barang', 'uom', 'kapasitas',
        'isi_per_pallet', 'isi_dus_per_pallet', 'berat_dus', 'berat_per_pallet',
        'deskripsi', 'nama_lorong', 'tanggal_berlaku', 'status'
    ];
}
