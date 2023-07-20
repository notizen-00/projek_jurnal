<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
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
        $data = $query->select(\DB::raw('(SELECT COALESCE(SUM(jumlah_barang), 0) FROM transaksi_stok WHERE product_id = '.$id.' AND status_transaksi = 1 AND gudang_id = '.$gudang_id.') - (SELECT COALESCE(SUM(jumlah_barang), 0) FROM transaksi_stok WHERE product_id = '.$id.' AND status_transaksi = 2 AND gudang_id = '.$gudang_id.') AS stok'))
                ->first();
                  
        if(empty($data->stok)){

            return ['stok'=>0];
        }else{
            return $data;
        }
    }

    public function scopegetStokProduk($query,$id_produk)
    {
        $data = $query->select(\DB::raw('(SELECT COALESCE(SUM(jumlah_barang), 0) FROM transaksi_stok WHERE product_id = '.$id_produk.' AND status_transaksi = 1) - (SELECT COALESCE(SUM(jumlah_barang), 0) FROM transaksi_stok WHERE product_id = '.$id_produk.' AND status_transaksi = 2 ) AS stok'))
        ->first();
          
        if(empty($data->stok)){
            return 0;
            }else{
        return $data->stok;
        }

    }

}
