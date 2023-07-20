<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Pembelian;
use App\Models\Detail_pembelian;
use App\Models\Transaksi;
use App\Models\Retur;
use App\Models\Account;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Memo;
use App\Models\Pengiriman;
use App\Models\Stok;
 
class Pembelian_helper {

    var $kode_akun;
    var $tipe_pembelian;
    
    public static function get_tipe_pembelian_name($tipe_pembelian)
    {   
        if($tipe_pembelian == 1){
            return 'Faktur Pembelian';
        }else if($tipe_pembelian == 2){
            return 'Pemesanan Pembelian';
        }else if($tipe_pembelian == 3){
            return 'Pengiriman Pembelian';
        }


    }

    public static function getHargaPembelianPemesanan($no_transaksi)
    {

        $data = Pembelian::join('detail_pembelian','pembelian.id','=','detail_pembelian.pembelian_id')
                            ->where('pembelian.no_transaksi',$no_transaksi)
                            ->sum('jumlah');
        return $data;
    }
    public static function getHargaPembelianPemesananByProduk($no_transaksi,$id_produk)
    {

        $data = Pembelian::join('detail_pembelian','pembelian.id','=','detail_pembelian.pembelian_id')
                            ->where('pembelian.no_transaksi',$no_transaksi)
                            ->where('detail_pembelian.product_id',$id_produk)
                            ->first();
        return $data->jumlah;
    }

    public static function get_tipe_pajak_notransaksi($no_transaksi)
    {

        $data = Pembelian::where('no_transaksi', $no_transaksi)->first();

        return $data->pajak;

    }
    public static function get_status_name($status_pembelian)
    {
        if($status_pembelian == 1)
        {
            echo "<span class='badge badge-warning bg-warning text-white'>Open</span>";
        }else if($status_pembelian == 2){
            echo "<span class='badge badge-danger'>Jatuh Tempo</span>";
        }else if($status_pembelian == 3){
            echo "<span class='badge badge-success'>Lunas</span>";
        }else if($status_pembelian == 4){
            echo "<span class='badge badge-info'>Cicilan</span>";
        }else if($status_pembelian == 5){
            echo "<span class='badge badge-primary'>Close</span>";
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

    public static function get_no_transaksi($tipe_pembelian,$no_transaksi = null)
    {

        $data = Pembelian::where('tipe_pembelian',$tipe_pembelian)->latest('id')->first();
        $data_no = Pembelian::where('no_transaksi',$no_transaksi)->get();
      
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
    public static function generate_nomor_transaksi($tipe_pembelian)
    {


        $nama_transaksi = self::get_tipe_pembelian_name($tipe_pembelian);
        $no_transaksi = self::get_no_transaksi($tipe_pembelian);

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function get_no_transaksi_deposit()
    {

        $data_deposit = Transaksi::where('nama_transaksi','Deposit Pembelian')->latest()->first();
        
        if(empty($data_deposit))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_deposit->no_transaksi);
             
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

    public static function get_no_transaksi_memo()
    {
        $data_retur = Transaksi::where('nama_transaksi','Debit Memo')->latest()->first();
        
        if(empty($data_retur))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_retur->no_transaksi);
             
            return $no_transaksi = $cek_no_transaksi[1] + 1;

        }

    }

    public static function get_no_transaksi_pembayaran()
    {
        $data_pembayaran = Transaksi::where('nama_transaksi','Kirim Pembayaran')->latest()->first();
        
        if(empty($data_pembayaran))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_pembayaran->no_transaksi);
             
            return $no_transaksi = $cek_no_transaksi[1] + 1;

        }
        
    }

    public static function get_no_transaksi_pengiriman()
    {
        $data_pembayaran = Transaksi::where('nama_transaksi','Pengiriman Pembelian')->latest()->first();
        
        if(empty($data_pembayaran))
        {
            return 10001;
        }else{
            $cek_no_transaksi = explode('#',$data_pembayaran->no_transaksi);
             
            return $no_transaksi = $cek_no_transaksi[1] + 1;

        }
        
    }

  

    public static function generate_nomor_transaksi_pembayaran()
    {
        $nama_transaksi = 'Kirim Pembayaran';
        $no_transaksi = self::get_no_transaksi_pembayaran();

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function generate_nomor_transaksi_memo()
    {
        $nama_transaksi = 'Debit Memo';
        $no_transaksi = self::get_no_transaksi_memo();

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function generate_nomor_transaksi_retur()
    {
        $nama_transaksi = 'Retur';
        $no_transaksi = self::get_no_transaksi_retur();

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function generate_nomor_transaksi_deposit()
    {
        $nama_transaksi = 'Deposit Pembelian';
        $no_transaksi = self::get_no_transaksi_deposit();

        return $nama_transaksi."#".$no_transaksi;

    }

    public static function generate_nomor_transaksi_pengiriman()
    {
        $nama_transaksi = 'Pengiriman Pembelian';
        $no_transaksi = self::get_no_transaksi_pengiriman();

        return $nama_transaksi."#".$no_transaksi;
    }

    public static function get_total_pembayaran($no_transaksi,$idp)
    {
        $data_pembelian = Pembelian::findOrFail($idp);

        $data_transaksi = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();

        $total = $data_pembelian->total;
     
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
        $data_pembelian = Pembelian::findOrFail($idp);
        $data_transaksi = Transaksi::with('pembayaran')->where('no_transaksi', $no_transaksi)->get();
        // $data_retur_transaksi = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->sum('');
        $data_retur = Retur::where('no_transaksi', $no_transaksi)->get();
        $data_memo = Memo::where('nomor_transaksi',$no_transaksi)->sum('jumlah_pembayaran');

        $total = $data_pembelian->total;
        $data_pembayaran = $data_transaksi[0]->pembayaran;
    
        $jumlah_pembayaran = 0;
        if (!empty($data_pembayaran)) {
            $arr = [];
            foreach ($data_pembayaran as $pembayaran) {
                $arr[] = $pembayaran->jumlah_pembayaran;
            }
            $jumlah_pembayaran = array_sum($arr);
        }
        
        $pembayaran_total = ($jumlah_pembayaran >= $total) ? $total : $jumlah_pembayaran;
        
        $jumlah_retur = 0;
        if (!empty($data_retur)) {
            $arr = [];
            foreach ($data_retur as $retur) {
                $arr[] = $retur->jumlah_transaksi;
            }
            $jumlah_retur = array_sum($arr);
        }
        
        $retur_total = $jumlah_retur;
        
        if($total - $pembayaran_total == 0 )
        {
            $sisa_tagihan = 0;
        }else{
            
            if($pembayaran_total == 0){
                $sisa_tagihan = round($total - $pembayaran_total - $retur_total ) ;
            }else{
                $sisa_tagihan = round($total - $pembayaran_total - $retur_total + $data_memo) ;
            }
          
        }
        
        
        return round($sisa_tagihan);

    }

    public static function get_sisa_tagihan_all()
{
    $data_pembelian = Pembelian::all();
    $sisa_tagihan = [];

    foreach ($data_pembelian as $pembelian) {
        $data_transaksi = Transaksi::with('pembayaran')->where('no_transaksi', $pembelian->no_transaksi)->get();
        $data_retur = Retur::where('no_transaksi', $pembelian->no_transaksi)->get();
        $data_memo = Memo::where('nomor_transaksi',$pembelian->no_transaksi)->get();
        $total = $pembelian->total;
        $data_pembayaran = $data_transaksi[0]->pembayaran;

        
        $jumlah_pembayaran = 0;
        if (!empty($data_pembayaran)) {
            $arr = [];
            foreach ($data_pembayaran as $pembayaran) {
                $arr[] = $pembayaran->jumlah_pembayaran;
            }
            $jumlah_pembayaran = array_sum($arr);
        }

        $pembayaran_total = ($jumlah_pembayaran >= $total) ? $total : $jumlah_pembayaran;

        $jumlah_retur = 0;
        if (!empty($data_retur)) {
            $arr = [];
            foreach ($data_retur as $retur) {
                $arr[] = $retur->jumlah_transaksi;
            }
            $jumlah_retur = array_sum($arr);
        }

        $jumlah_memo = 0;
        if (!empty($data_memo)) {
            $arr = [];
            foreach ($data_memo as $memo) {
                $arr_memo[] = $memo->jumlah_pembayaran;
            }
            $jumlah_memo = array_sum($arr_memo);
        }



        $retur_total = $jumlah_retur;
       

        // $sisa_tagihan[$pembelian->no_transaksi] = $total - $pembayaran_total - $retur_total;
        $ttotal = $total - $pembayaran_total;
        if($ttotal == 0){

            $sisa_tagihan[$pembelian->no_transkasi] = $total - $pembayaran_total;
        }else{
            $sisa_tagihan[$pembelian->no_transaksi] = $total - $pembayaran_total - $retur_total;

        }
    }

    return array_sum($sisa_tagihan);
}

    public static function get_average_price($id_produk)
    {

        // $total_harga = Detail_pembelian::where('product_id',$id_produk)->sum('jumlah');
        $total_harga = Pembelian::join('detail_pembelian','pembelian.id','=','detail_pembelian.pembelian_id')
                                ->where('pembelian.status_pembelian',5)
                                ->where('pembelian.nama_transaksi','Pemesanan Pembelian')
                                ->where('detail_pembelian.product_id',$id_produk)
                                ->sum('detail_pembelian.jumlah');
        
        // $total_harga = Account::datawithsaldopersediaan('1-10200');
        // $total_stok = \Helper::get_stok_product($id_produk);
        $total_stok_produk = Stok::getstokproduk($id_produk);

        $data_pembelian = Produk::findOrFail($id_produk);
        
        if($total_stok_produk != 0 ){
        $average =  $total_harga / $total_stok_produk;
        
        return round($average,2);
        }else{

            return $data_pembelian->harga_beli;
        }
    }

    

    public static function update_status_pembelian($id_pembelian,$sisa_tagihan)
    {

        $pembelian = Pembelian::findOrFail($id_pembelian);

        if ($sisa_tagihan == 0) {
            $pembelian->status = 3; // Ubah status menjadi "lunas"
            // $pembelian->status = 4; // Jika status menggunakan kode "4"
            $pembelian->save();
    
            return true;
        }
    
        return false;
    }

    public static function get_total_retur($no_transaksi){

        
    }

    public static function get_subtotal($idp)
    {

        $data_pembelian = Detail_pembelian::where($idp);


       

    }


}











   
