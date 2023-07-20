<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\detail_penjualan;
use App\Models\Detail_pembelian;
use App\Models\Produk;
use App\Models\Retur;
use App\Models\Widget;

 
class Helper {
    public static function tipe_kontak($value) {
        
        if($value == 1){

            return "<i class='far fa-square bg-danger text-danger ml-5' data-toggle='tooltip' data-placement='top' title='Pelanggan'></i>";
        }else if($value == 2){
            return "<i class='far fa-square bg-warning ml-5' data-toggle='tooltip' data-placement='top' title='Supplier'></i>";
        }else if($value == 3){
             return "<i class='far fa-square bg-success ml-5' data-toggle='tooltip' data-placement='top' title='Karyawan'></i>";
        }
    }

    public static function get_image_produk($image_produk)
    {

        if($image_produk == ''){

            echo asset('adminlte/dist/img/icon-default.jpg');
        }else{
            echo asset('storage/images/'.$image_produk);
        }

    }
    public static function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
    return $hasil_rupiah;
     
    }

    public static function auto_kode($id,$string)
    {
        $nomor_urut = sprintf("%03d", $id);
        return $string . $nomor_urut;
    }

    public static function terbilang($angka) {
        $angka = (float)$angka;
        $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        );
        
        if ($angka < 12) {
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            return $bilangan[$angka - 10] . ' belas';
        } elseif ($angka < 100) {
            return $bilangan[(int)($angka / 10)] . ' puluh ' . $bilangan[$angka % 10];
        } elseif ($angka < 200) {
            return 'seratus ' . self::terbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $bilangan[(int)($angka / 100)] . ' ratus ' . self::terbilang($angka % 100);
        } elseif ($angka < 2000) {
            return 'seribu ' . self::terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return self::terbilang((int)($angka / 1000)) . ' ribu ' . self::terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return self::terbilang((int)($angka / 1000000)) . ' juta ' . self::terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return self::terbilang((int)($angka / 1000000000)) . ' milyar ' . self::terbilang($angka % 1000000000);
        } else {
            return 'tidak terdefinisi';
        }
    }

    public static function filter_value($array, $temp = []) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::filter_value($value, $temp);
            } else {
                if (in_array($value, $temp)) {
                    echo "The value '$value' at key '$key' is a duplicate.\n";
                    return;
                } else {
                    $temp[] = $value;
                }
            }
        }
    }

    public function get_all_data($name_model)
    {
        $model_name = 'App\\Models\\'.$name; 
        $data = $model_name::all();
        return $data;

    }

    public static function get_all_penjualan_retur_stok($id_produk)
    {
        $data = Retur::where('product_id',$id_produk)->where('status_retur',1)->sum('jumlah_retur');
        return $data;
    }

    public static function get_all_pembelian_retur_stok($id_produk)
    {
        $data = Retur::where('product_id',$id_produk)->where('status_retur',0)->sum('jumlah_retur');
        return $data;
    }

    public static function get_all_penjualan_stok($id_produk)
    {

            $data = detail_penjualan::where('product_id',$id_produk)->sum('qty');
            return $data;

    }

    public static function get_all_pembelian_stok($id_produk)
    {

            $data = Detail_pembelian::where('product_id',$id_produk)->sum('qty');
            return $data;

    }



    public static function get_stok_product($id_produk)
    {

        $stok_pembelian = self::get_all_pembelian_stok($id_produk);
        $stok_penjualan = self::get_all_penjualan_stok($id_produk);
        $stok_retur_pembelian = self::get_all_penjualan_retur_stok($id_produk);
        $stok_retur_penjualan = self::get_all_pembelian_retur_stok($id_produk);

        return $stok_pembelian - $stok_retur_pembelian - $stok_penjualan + $stok_retur_penjualan;
    }

    public static function get_widget()
    {

       $data =  Widget::where('status_widget',1)->get();
       return $data;
    }



}