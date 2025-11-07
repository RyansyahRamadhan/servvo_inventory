<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulaDetail extends Model
{
    use HasFactory;

    protected $table = 'formula_detail';
    public $timestamps = false;

    protected $fillable = ['kode_formula', 'kode_barang', 'nama_barang', 'jumlah'];

    public function formula()
    {
        return $this->belongsTo(Formula::class, 'kode_formula', 'kode_formula');
    }
}
