<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    
    public function pembayaran()
    {

        return $this->hasMany(Pembayaran::class,'nomor_transaksi','no_transaksi');
    }

    public function kontak()
    {
        return $this->hasOne(Kontak::class,'id','kontak_id');
    }

   
    public function detail_transaksi()
    {
        return $this->hasMany(Detail_transaksi::class);
    }

    public function detail_pembelian() 
    {

        return $this->hasOne(Pembelian::class,'no_transaksi','no_transaksi');
    }

    public function detail_penjualan() 
    {

        return $this->hasOne(penjualan::class,'no_transaksi','no_transaksi');
    }

    
}
