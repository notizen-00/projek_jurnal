<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    use HasFactory;
    protected $table = 'detail_produk';

    public function product()
    {

        return $this->hasOne(Produk::class);
    }

    public function akun_pembelian_code()
    {
        return $this->hasOne(Account::class,'kode_akun','akun_pembelian');
    }

    public function akun_penjualan_code()
    {
        return $this->hasOne(Account::class,'kode_akun','akun_penjualan');
    }
}
