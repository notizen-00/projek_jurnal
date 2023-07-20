<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model
{
    use HasFactory;

    protected $table="account";
    public $guarded = [];

    public function kategori_akun()
    {

        return $this->hasOne(Kategori_akun::class,'id','kategori_akun_id');
    }
    public function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

    public function scopeKodeById($query,$id){

        return $query->select('kode_akun')
                     ->where('id',$id)
                     ->get();
    }

    public function scopeGetSaldo($query,$kode_akun){
        $data = $query->select(DB::raw('CASE WHEN ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit), 1) = 0.1 THEN 0 ELSE ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit)) END as total_saldo'))
        ->leftJoin('detail_transaksi', 'account.kode_akun', '=', 'detail_transaksi.akun_transaksi')
        ->where('account.kode_akun', $kode_akun)
        ->orderBy('account.kode_akun', 'ASC')
        ->groupBy('account.id')
        ->get();
    
    return round($data[0]->total_saldo, 2);
    

    }
    public function scopeDataWithSaldo($query)
    {

        return $query->select('*', 'account.id as id_account', DB::raw('CASE WHEN ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit), 1) = 0.1 THEN 0 ELSE ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit)) END as saldo_akumulatif'))
        ->leftJoin('detail_transaksi', 'account.kode_akun', '=', 'detail_transaksi.akun_transaksi')
        ->orderBy('account.kode_akun', 'ASC')
        ->groupBy('account.id')
        ->get();
    
    }

    public function scopeDataWithSaldoPersediaan($query,$akun_persediaan)
    {

        $data = $query->select(DB::raw('ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit) OVER (ORDER BY detail_transaksi.id), 2) as saldo_akumulatif'))
        ->leftJoin('detail_transaksi', 'account.kode_akun', '=', 'detail_transaksi.akun_transaksi')
        ->where('detail_transaksi.akun_transaksi', $akun_persediaan)
        ->first();
    
    return $data->saldo_akumulatif;
    
    }

    public function scopeDetailAccount($query,$kode_akun)
    {
        // return $query->select('*', DB::raw('CASE WHEN ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit) OVER (ORDER BY detail_transaksi.id), 1) = 0.1 THEN 0 ELSE ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit) OVER (ORDER BY detail_transaksi.id)) END as saldo_akumulatif'))
        // ->leftJoin('detail_transaksi', 'account.kode_akun', '=', 'detail_transaksi.akun_transaksi')
        // ->leftJoin('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
        // ->leftJoin('kontak', 'transaksi.kontak_id', '=', 'kontak.id')
        // ->where('detail_transaksi.akun_transaksi', $kode_akun)
        // ->orderBy('detail_transaksi.id', 'ASC')
        // ->get();
       return $query->select('*', DB::raw('ROUND(SUM(detail_transaksi.debit - detail_transaksi.kredit) OVER (ORDER BY detail_transaksi.id), 2) as saldo_akumulatif'))
    ->leftJoin('detail_transaksi', 'account.kode_akun', '=', 'detail_transaksi.akun_transaksi')
    ->leftJoin('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
    ->leftJoin('kontak', 'transaksi.kontak_id', '=', 'kontak.id')
    ->where('detail_transaksi.akun_transaksi', $kode_akun)
    ->orderBy('detail_transaksi.id', 'ASC')
    ->get();

    
    }

    public function getSaldoAttribute($value)
    {
            return $this->rupiah($value);

    }

    
   

 

}
