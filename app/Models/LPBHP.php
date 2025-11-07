<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LPBHP extends Model
{
    protected $table = 'lpbhp';
    protected $fillable = [
        'no_lpbhp','tanggal_lpbhp','no_fpb','kode_barang','nama_barang','qty'
    ];

    public function details()
    {
        return $this->hasMany(LPBHPDetail::class, 'no_lpbhp', 'no_lpbhp');
    }
    
}

