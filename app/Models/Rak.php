<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    public $timestamps = false;
    protected $primaryKey = 'id_rak';
    public $incrementing = true;

    protected $fillable = [ 'nama_rak', 'nama_lorong', 'kapasitas_total', 'kapasitas_tersedia'];

    public function lorong()
    {
        return $this->belongsTo(Lorong::class, 'nama_lorong', 'nama_lorong');
    }

    public function subRak()
    {
        return $this->hasMany(SubRak::class, 'nama_rak', 'nama_rak');
    }
}

