<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    public $guard = [];
    protected $table="pembelian";
    

    public function getSisaTagihanAttribute()
{
        $no_transaksi = $this->no_transaksi;
        $id_pembelian = $this->id;

        $sisa_tagihan = \Pembelian_helper::get_sisa_tagihan($no_transaksi, $id_pembelian);

        return $sisa_tagihan;
}

public function scopeGetDetailDeposit($query,$no_transaksi)
{
    return $query->join('pembayaran','pembelian.no_transaksi','=','pembayaran.nomor_transaksi')
                 ->join('transaksi','pembayaran.uid_pembayaran','=','transaksi.no_transaksi')
                ->select('pembayaran.id as id_pembayaran','pembayaran.*','pembelian.*','transaksi.metode_pembayaran')
                ->where('pembayaran.nomor_transaksi',$no_transaksi)
                ->get();

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
