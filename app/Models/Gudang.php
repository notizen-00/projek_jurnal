<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $table = "gudang";


    public function pembelian()
    {

        return $this->belongsTo(Pembelian::class,'id','gudang_id');
    }


    public function penjualan()
    {

        return $this->belongsTo(penjualan::class,'id','gudang_id');
    }

    public function retur()
    {

        return $this->belongsTo(Retur::class,'id','gudang_id');
    }

    public function scopeWithProduk($query)
    {
        return $query->leftJoin('transaksi_stok','gudang.id','=','transaksi_stok.gudang_id')
                    ->select(\DB::raw('gudang.*,count(DISTINCT transaksi_stok.product_id) as total_produk'))
                    ->where('gudang.status_gudang', 0)
                    ->groupBy('gudang.id');
    }

    public function scopeWhereTransaksi($query,$id)
    {   

        return $query->leftJoin('transaksi_stok', 'gudang.id', '=', 'transaksi_stok.gudang_id')
        ->leftJoin('product', 'transaksi_stok.product_id', '=', 'product.id')
        ->leftJoin('transaksi', 'transaksi_stok.no_transaksi', '=', 'transaksi.no_transaksi')
        ->leftJoin('pembelian', 'transaksi_stok.no_transaksi', '=', 'pembelian.no_transaksi')
        ->leftJoin('penjualan', 'transaksi_stok.no_transaksi', '=', 'penjualan.no_transaksi')
        ->select(\DB::raw('transaksi_stok.*,gudang.*, product.nama_produk,product.id as id_produk,
        CASE 
        WHEN pembelian.no_transaksi IS NOT NULL THEN pembelian.total
        WHEN penjualan.no_transaksi IS NOT NULL THEN penjualan.total
        ELSE NULL 
        END AS data_transaksi    
                '))
        ->where('transaksi_stok.gudang_id', $id);
                     
    }
}
