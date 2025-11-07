<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubRak extends Model
{
    protected $table = 'sub_rak';
        public $timestamps = false;
   protected $fillable = [
    'nama_rak',
    'kode_sub_rak',
    'label_full',
    'kapasitas',
    'kapasitas_tersedia',
];


    public function rak()
    {
        return $this->belongsTo(Rak::class, 'nama_rak', 'nama_rak');
    }
}
