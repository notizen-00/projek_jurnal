<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Widget;

 
class Theme_helper {


    public static function get_submenu($id) {

        $data = Submenu::where('menu_id',$id)->get();
    
        return $data;
    }

  



}