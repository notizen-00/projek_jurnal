<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\penjualan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
 
class Penjualan_helper {

    var $kode_akun;
    var $tipe_penjualan;
    
    public static function get_tipe_penjualan_name($tipe_penjualan)
    {   
        if($tipe_penjualan == 1){
            return 'Faktur penjualan';
        }


    }
    public static function get_status_name($status)
    {
        if($status == 1)
        {
            echo "<span class='badge badge-warning bg-warning text-white'>Open</span>";
        }else if($status == 2){
            echo "<span class='badge badge-danger'>Jatuh Tempo</span>";
        }else if($status == 3){
            echo "<span class='badge badge-success'>Lunas</span>";
        }else if($status == 4){
            echo "<span class='badge badge-info'>Cicilan</span>";
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

    public static function generate_account_transaksi()
    {

        $saldo = self::check_saldo_cash();
        
        if($saldo == 0)
        {
            return '2-20100';
        }else{
            return '1-10001';
        }

    }

    public static function get_no_transaksi($tipe_penjualan,$no_transaksi = null)
    {

        $data = penjualan::where('tipe_penjualan',$tipe_penjualan)->latest('id')->first();
        $data_no = penjualan::where('no_transaksi',$no_transaksi)->get();
    if($no_transaksi != null)
    {
        
        if( empty($data_no) || $data_no == NULL ){
            echo 10001;
         }else{
             $cek_no_transaksi = explode('#',$data_no[0]->no_transaksi);
             
            echo $cek_no_transaksi[1];
         }


    }else{
        if( empty($data) || $data == NULL ){
            return $no_transaksi = 10001;
         }else{
             $cek_no_transaksi = explode('#',$data->no_transaksi);
             
            return $no_transaksi = $cek_no_transaksi[1] + 1;
           
         }

    }
        
    }

    public static function generate_nomor_transaksi($tipe_penjualan)
    {


        $nama_transaksi = self::get_tipe_penjualan_name($tipe_penjualan);
        $no_transaksi = self::get_no_transaksi($tipe_penjualan);

        return $nama_transaksi."#".$no_transaksi;

    }

    
    public static function get_no_transaksi_pembayaran()
    {
        $data_pembayaran = Transaksi::where('nama_transaksi','Terima Pembayaran')->latest('id')->first();
        
        if(empty($data_pembayaran))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_pembayaran->no_transaksi);
       
            return $no_transaksi = $cek_no_transaksi[1] + 1;

        }
        
    }

    

    public static function get_no_transaksi_retur()
    {
        $data_retur = Transaksi::where('nama_transaksi','Retur')->latest()->first();
        
        if(empty($data_retur))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_retur->no_transaksi);
             
            return $no_transaksi = $cek_no_transaksi[1] + 1;

        }

    }

    public static function generate_nomor_transaksi_pembayaran()
    {
        $nama_transaksi = 'Terima Pembayaran';
        $no_transaksi = self::get_no_transaksi_pembayaran();

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function generate_nomor_transaksi_retur()
    {
        $nama_transaksi = 'Retur';
        $no_transaksi = self::get_no_transaksi_retur();

        return $nama_transaksi."#".$no_transaksi;

    }

   

    public static function get_total_pembayaran($no_transaksi,$idp)
    {
        $data_penjualan = penjualan::findOrFail($idp);

        $data_transaksi = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();

        $total = $data_penjualan->total;
     
        $data_pembayaran = $data_transaksi[0]->pembayaran;
       
        if(empty($data_pembayaran)){

            return $total;
        }else{
            
            foreach($data_pembayaran as $i){

                $arr[] = $i->jumlah_pembayaran; 
            }

            if(empty($arr)){
                $jumlah_pembayaran = 0;
            }else{
                $jumlah_pembayaran = array_sum($arr);
            }

            return $jumlah_pembayaran;
        }
       

    }

    public static function get_sisa_tagihan($no_transaksi,$idp)
    {

        $data_penjualan = penjualan::findOrFail($idp);

        $data_transaksi = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();

        $total = $data_penjualan->total;
     
        // $data_pembayaran = $data_transaksi[0]->pembayaran;
       
        if(empty($data_transaksi[0]->pembayaran)){

            return $total;
            
        }else{
            
            foreach($data_transaksi[0]->pembayaran as $i){

                $arr[] = $i->jumlah_pembayaran; 
            }
        

            if(empty($arr)){
                $jumlah_pembayaran = 0;
            }else{
                $jumlah_pembayaran = array_sum($arr);
            }

            return $total - $jumlah_pembayaran;
        }
       

    }
}











   
