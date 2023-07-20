<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\Detail_transaksi;
use App\Models\Account;
 
class Account_helper {

    var $kode_akun;
    var $tipe_pembelian;
    
    public static function get_tipe_pembelian_name($tipe_pembelian)
    {   
        if($tipe_pembelian == 1){
            return 'Faktur Pembelia';
        }


    }

    public static function get_saldo_akun($kode_akun)
    {

        $data = Detail_transaksi::where('kode_akun', $kode_akun)->get(); 
    }

    public static function get_detail_kode($kode_akun,$status)
    {
        $data = Account::where('kode_akun', $kode_akun)->get();

        if($status = 'nama_akun'){

            return $data[0]->nama_akun;
        }

    }

}











   
