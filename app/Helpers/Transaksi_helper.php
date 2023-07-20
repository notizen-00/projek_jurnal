<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Pembelian;
use App\Models\Account;
 use App\Models\Unit;
 use App\Models\Transaksi;
class Transaksi_helper {
    
    
    public static function get_tipe_pembelian_name($tipe_pembelian)
    {   
        if($tipe_pembelian == 1){
            return 'Faktur Pembelian';
        }
    }

    public static function get_unit_name($id_unit)
    {

        $data = Unit::findOrFail($id_unit);
        return $data->nama_unit;
    }

    public static function get_status_name($status_pembelian)
    {
        if($status_pembelian == 1)
        {
            return "<span class='badge badge-warning bg-warning text-white'>Open</span>";
        }else if($status_pembelian == 2){
            return "<span class='badge badge-danger'>Jatuh Tempo</span>";
        }else if($status_pembelian == 3){
        return "<span class='badge badge-success'>Lunas</span>";
        }else if($status_pembelian == 4){
            return "<span class='badge badge-info'>Cicilan</span>";
        }else if($status_pembelian == 5){
            return "<span class='badge badge-dark'>Closed</span>";
        }
    }

    public static function get_status_transaksi_gudang($status_transaksi)
    {
        if($status_transaksi == 1)
        {
            echo "<span class='badge badge-success bg-success text-white'>Masuk</span>";
        }else if($status_transaksi == 2){
            echo "<span class='badge badge-danger bg-danger text-white'>Keluar</span>";
        }
    }

    public static function get_saldo_transaksi_kredit($kode_akun_kredit,$total,$status_transaksi)
    {   
        $data = DB::table('account')->where('kode_akun',$kode_akun_kredit)->get();

        $saldo = $data[0]->saldo;

        if($status_transaksi == 'faktur_pembelian')
        {
            
            return $saldo + $total;
        
        }
        
    }

    public static function get_saldo_transaksi_debit($kode_akun_debit,$total,$status_transaksi)
    {   
        $data = DB::table('account')->where('kode_akun',$kode_akun_debit)->get();
       
        $saldo = $data[0]->saldo;
        
        if($status_transaksi == 'faktur_pembelian')
        {
            return $saldo + $total;

        }
           
    }

    
    public static function check_saldo_cash()
    {   
        $kode_akun = '1-10001';
        $data = DB::table('account')->where('kode_akun',$kode_akun)->get();
       
        if($data[0]->saldo == 0){
            return 0;
        }else{
            return $data[0]->saldo;
        }

    }


    public static function get_akun_transaksi_kredit($status_transaksi,$total)
    {   
        $cek_cash = self::check_saldo_cash();

        if($status_transaksi == 'kirim-pembayaran')
        {
            if($cek_cash <= $total){
                return '1-10001';
            }else{
                return '';
            }
        }

    }

    public static function get_total_retur($no_retur)
    {

        $data = Transaksi::where('no_transaksi',$no_retur)->first();

        return \Helper::rupiah($data->total);
    }

    public static function get_akun_transaksi_debit($status_transaksi,$total)
    {

        $cek_cash = self::check_saldo_cash();
        if($status_transaksi == 'kirim-pembayaran')
        {
            if($cek_cash <= $total){
                return '1-10001';
            }else{
                return '';
            }
        }else if($status_transaksi == 'retur-pembelian')
        {
            if($cek_cash <= $total){
                return '2-20100';
            }else{
                return '1-10001';
            }

        }
        

    }

    public static function generate_nomor_transaksi_jurnal()
    {
        $nama_transaksi = 'Jurnal';
        $no_transaksi = self::get_no_transaksi_jurnal();
        return $nama_transaksi.'#'.$no_transaksi;
    }

    public static function get_no_transaksi_jurnal()
    {

        $data_jurnal = Transaksi::where('nama_transaksi','Jurnal')->latest('id')->first();

        if(empty($data_jurnal))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_jurnal->no_transaksi);
            return $no_transaksi = $cek_no_transaksi[1] + 1;
        }
    }


    public static function get_status_pajak($nomor)
    {
        if($nomor == 0)
        {

            echo "<b> PPN 11.0%</b>";

        }else if($nomor == 1)
        {

            echo "<b> Termasuk PPN 11.0%</b>";
        }
    }

    public static function getstatuspengiriman($nomor)
    {
        if($nomor == 1){
            return "<span class='badge badge-warning'>Open</span>";
        }else{
            return "<span class='badge badge-dark'>Close</span>";
        }
    }

    public static function getStokBundle($id_produk, $bundle) {
        $availableStock = PHP_INT_MAX; // Mengatur stok tersedia ke nilai maksimum yang sangat besar
        
        foreach ($id_produk as $id => $quantity) {
            // Memeriksa apakah produk dengan ID saat ini ada dalam bundle
            if (isset($bundle[$id])) {
                // Menghitung jumlah bundle yang tersedia berdasarkan stok produk dan jumlah dalam bundle
                $availableBundle = floor($quantity / $bundle[$id]);
                
                // Memperbarui stok tersedia menjadi jumlah bundle terkecil di antara produk dalam bundle
                $availableStock = min($availableStock, $availableBundle);
            } else {
                // Jika produk tidak ada dalam bundle, stok bundle tidak tersedia
                $availableStock = 0;
                break;
            }
        }
        
        return ['stok'=>$availableStock];
    }

   
}











   