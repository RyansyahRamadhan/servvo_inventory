<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LPBHPDetail extends Model
{
    protected $table = 'lpbhp_detail';     // nama tabel
    protected $primaryKey = 'id';          // default 'id', boleh dihapus
    public $incrementing = true;           // auto-increment
    protected $keyType = 'int';            // tipe PK

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'no_lpbhp',
        'nama_rak',
    ];

    // timestamps aktif (created_at, updated_at)
    public $timestamps = true;

    /**
     * Relasi ke header LPBHP.
     * Catatan: relasi berdasarkan no_lpbhp (string) -> no_lpbhp (unique) di tabel lpbhp.
     */
    public function header()
    {
        return $this->belongsTo(LPBHP::class, 'no_lpbhp', 'no_lpbhp');
    }
}
    