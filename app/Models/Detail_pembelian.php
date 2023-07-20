<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pembelian extends Model
{
    use HasFactory;
    protected $table = "detail_pembelian";

    public function detail_produk()
    {
        return $this->belongsTo(Produk::class,'product_id','id');
    }

    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

   
}
