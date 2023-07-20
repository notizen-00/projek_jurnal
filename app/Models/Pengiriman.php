<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';


    public function scopeGetDataPengiriman($query)
    {

        return $query->join('transaksi','pengiriman.uid_pengiriman','=','transaksi.no_transaksi')
                     ->join('kontak','transaksi.kontak_id','=','kontak.id')
                     ->groupBy('transaksi.id')
                     ->select('pengiriman.id as pengiriman_id','transaksi.id as transaksi_id','pengiriman.uid_pengiriman as no_transaksi','kontak.nama_kontak','transaksi.tgl_transaksi as tgl_transaksi','pengiriman.status_pengiriman as status_pengiriman','transaksi.tag as tag')
                     ->get();
    }

    public function scopeShowDataPengiriman($query,$no_transaksi)
    {

        return $query->join('transaksi','pengiriman.uid_pengiriman','=','transaksi.no_transaksi')
        ->join('kontak','transaksi.kontak_id','=','kontak.id')
        ->where('pengiriman.no_transaksi',$no_transaksi)
        ->groupBy('transaksi.id')
        ->select('pengiriman.id as pengiriman_id','transaksi.id as transaksi_id','pengiriman.uid_pengiriman as no_transaksi','kontak.nama_kontak','transaksi.tgl_transaksi as tgl_transaksi','pengiriman.status_pengiriman as status_pengiriman','transaksi.tag as tag')
        ->get();
    }

    public function detail_produk()
    {
        return $this->belongsTo(Produk::class,'product_id','id');
    }
}
