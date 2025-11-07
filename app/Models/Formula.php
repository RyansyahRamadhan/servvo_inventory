<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    protected $table = 'formula';
    protected $fillable = ['kode_formula', 'nama_formula'];

    // Tidak perlu lagi: $primaryKey, $incrementing, $keyType
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(FormulaDetail::class, 'kode_formula', 'kode_formula');
    }
}
