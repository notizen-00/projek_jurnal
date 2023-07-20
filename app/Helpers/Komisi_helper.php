<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Komisi;
 
class Komisi_helper {
 

    public static function get_rule_periode($id) {
        $data = Komisi::getdatarules($id,'rules_periode');
        
        if($data[0]['rule_periode'] == 1){
            return "Berlaku Selamanya";
        }else{
            return $data[0]['periode_mulai']." S/d ".$data[0]['periode_akhir'];
        }
    }

    public static function get_komisi_active()
    {

        $data = Komisi::getdatarules(); 

    }

    public static function get_status_name($nomor)
    {

        if($nomor == 1){
            echo "<span class='badge badge-success'>Aktif</span>";
        }else{
            echo "<span class='badge badge-danger'>Tidak Aktif</span>";
        }
    }

}