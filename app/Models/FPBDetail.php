<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FPBDetail extends Model
{
   protected $table = 'fpb_detail';

protected $fillable = [
    'no_fpb',
    'kode_barang',
    'nama_barang',
    'qty',
    'rak',
];

public function fpb()
{
    return $this->belongsTo(FPB::class, 'no_fpb', 'no_fpb');
}

}
