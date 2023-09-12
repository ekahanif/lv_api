<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'id_barang'];

    public function getData(){
        $order = DB::table('orders')
        ->join('barangs', 'orders.id_barang', '=' ,'barangs.id')
        ->join('customers', 'orders.id_customer', '=' ,'customers.id')
        ->get();
        return $order;
    }
}
