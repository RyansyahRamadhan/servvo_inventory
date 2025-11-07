<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    public $incrementing = true;
 public $timestamps = false; 
    protected $fillable = ['nama_gudang'];
}
