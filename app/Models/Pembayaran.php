<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    public $guard = [];
    protected $table="pembayaran";


    public function transaksi()
    {
        return $this->hasOne(Transaksi::class,'no_transaksi','nomor_transaksi');
    }

    public function scopeGetDp($query,$no_transaksi)
    {

        $data = $query->where('nomor_transaksi',$no_transaksi)->sum('jumlah_pembayaran');
        // dd($data);
        if(empty($data)){
            return 0;
        }else{
            return $data;
        }
    
    }
    public function scopeDetailPembayaran($query)
    {
        return $query->Leftjoin('transaksi','transaksi.no_transaksi','=','pembayaran.uid_pembayaran')
                    ->Leftjoin('kontak','transaksi.kontak_id','=','kontak.id')
                    ->where('nomor_transaksi','like','%Faktur Pembelian%')
                    ->get();

    }
    public function scopeDetailPembayaranPenjualan($query)
    {
        return $query->Leftjoin('transaksi','transaksi.no_transaksi','=','pembayaran.uid_pembayaran')
                    ->Leftjoin('kontak','transaksi.kontak_id','=','kontak.id')
                    ->where('nomor_transaksi','like','%Faktur Penjualan%')
                    ->get();
    }
    public function scopeGetDetail($query)
    {

        return $query->select('*')
                    ->LeftJoin('transaksi','pembayaran.uid_pembayaran','=','transaksi.no_transaksi')
                    ->get();
    }



}
