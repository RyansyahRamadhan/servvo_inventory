<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lorong extends Model
{
    protected $table = 'lorong';
    protected $primaryKey = 'id_lorong';
    public $incrementing = false;
     public $timestamps = false;
    protected $fillable = ['nama_lorong', 'nama_gudang'];
}


