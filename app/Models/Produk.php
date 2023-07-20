<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class,'id','product_id');
    }
    
    public function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,NULL,'','.');
    return $hasil_rupiah;
     
    } 


    public function getQtyAttribute()
    {

        return \Helper::get_stok_product($this->id);
    }

    public function pajaks_beli()
    {

        return $this->belongsTo(Pajak::class,'pajak_beli','id');
    }

    public function pajaks_jual()
    {

        return $this->belongsTo(Pajak::class,'pajak_jual','id');
    }

    public function scopeCheckStatus($query,$id)
    {

        $data = $query->where('id',$id)->first();

        if($data->tipe_produk == 1){

            return 'single';
        }else{
            return 'bundle';
        }
    }

    

    public function kategori_produk()
    {

        return $this->belongsTo(Kategori_produk::class);
    }

    public function unit_produk()
    {

        return $this->belongsTo(Unit::class);
    }

   

    public function getHargajualAttribute($value)
    {
        return $this->rupiah($value);
    }
   
}
