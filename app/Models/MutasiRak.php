<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MutasiRak extends Model {
    protected $table = 'mutasi_rak';
    protected $fillable = ['tanggal','kode_barang','rak_asal_id','rak_tujuan_id','qty','user_id','alasan'];
}
