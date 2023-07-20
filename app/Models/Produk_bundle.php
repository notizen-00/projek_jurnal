<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_bundle extends Model
{
    use HasFactory;
    public $guard=[];
    protected $table='detail_bundle';

    public function scopegetstokproduk($query,$id_produk)
    {

        $data = $query->where('product_id',$id_produk)->get();

        $stok = [];
        foreach($data as $i)
        {
            $stok[$i->sub_product_id] = \Helper::get_stok_product($i->sub_product_id);
        }

        return $stok;

    }

    public function scopegetRuleBundle($query, $id_produk)
    {
        $data = $query->where('product_id', $id_produk)->get();
    
        $stok = []; // Inisialisasi array stok
    
        foreach ($data as $i) {
            $stok[$i->sub_product_id] = $i->jumlah_produk;
        }
    
        return $stok;
    }
}
