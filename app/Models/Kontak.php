<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    public $guarded= [];
    protected $table="kontak";


  
    public function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
    public function getSaldoAttribute($value)
    {
            return $this->rupiah($value);

    }

    public function scopeGetNamaKontak($query,$id)
    {

        $data = $query->where('id',$id)->first();

        return $data->nama_kontak;

    }

    public function scopeGetAlamatKontak($query,$id)
    {
        $data = $query->where('id',$id)->first();

        
        if(empty($data->alamat)){
            return '-';
        }else{
            return $data->alamat;
        }   
    }

    public function scopeDataSales($query)
    {

        return $query->where('tipe_kontak',3)->get();
    }
    public function scopeDataPemasok($query)
    {

        return $query->where('tipe_kontak',2)->get();
    }

  
}
