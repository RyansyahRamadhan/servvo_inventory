<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FPB extends Model
{
   protected $table = 'fpb';
protected $primaryKey = 'no_fpb';
public $incrementing = false;
protected $keyType = 'string';

protected $fillable = [
    'no_fpb',
    'tanggal_fpb',
    'kode_formula',
    'nama_formula',
    'qty_formula',
];

    public function details()
    {
        return $this->hasMany(FPBDetail::class, 'no_fpb', 'no_fpb');
    }
}
