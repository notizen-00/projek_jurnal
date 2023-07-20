<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_stok extends Model
{
    // use HasFactory;
    // public $guarded= [];
    protected $table="transaksi_stok";


    public function scopeActive($query)
    {
        return $query->where('status_transaksi', 1);
    }
    public function scopeProductByGudang($query,$id,$gudang_id)
    {
        return $query->select(\DB::raw('gudang_id,SUM(jumlah_barang) as total_barang'))
                    ->where('product_id',$id)
                    ->where('gudang_id',$gudang_id)
                    ->GroupBy('product_id')
                    ->get();  

    }

}
