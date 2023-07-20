<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananPembelian extends Model
{
    use HasFactory;
    public $guard = [];
    protected $table="pembelian";
    


    public function scopedetail_pembelian($query,$id_pembelian)
    {

        return $query->join('detail_pembelian','pembelian.id','=','detail_pembelian.pembelian_id')
                     ->where('detail_pembelian.pembelian_id',$id_pembelian);
    }

    public function scopeGetPajak($query,$id_pembelian)
    {   

        $data_pembelian = $query->where('id',$id_pembelian)->first();

        $data_subtotal = $this->detail_pembelian($id_pembelian)->sum('detail_pembelian.jumlah');

        if($data_pembelian->pajak == 1){

            $pajak = $data_pembelian->total - $data_subtotal;

        }elseif($data_pembelian->pajak == 0){

            $pajak = $data_pembelian->total - $data_subtotal;

        }
        return $pajak;
    }

    public function scopeGetPengiriman($query)
    {

        return $query->where('nama_transaksi','Pengiriman Pembelian')->get();
    }

    public function scopeGetPemesanan($query)
    {
        return $query->join('kontak','pembelian.kontak_id','=','kontak.id')
                    ->where('pembelian.tipe_pembelian',2)
                    ->groupBy('pembelian.id')
                    ->select('pembelian.id as pembelian_id','pembelian.no_transaksi','kontak.nama_kontak','pembelian.status_pembelian','pembelian.total','pembelian.tag','pembelian.tgl_transaksi','pembelian.tgl_jatuh_tempo')
                    ->get();
    }
    public function kontak()
    {

        return $this->hasOne(Kontak::class,'id','kontak_id');
    }

    public function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

    public function gudang()
    {

        return $this->hasOne(Gudang::class,'id','gudang_id');
    }


   

  
}
