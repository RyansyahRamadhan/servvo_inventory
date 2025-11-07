<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOnHand extends Model
{
    protected $table = 'stock_on_hand';
    protected $fillable = ['barang_id','rak_id','qty'];
}
