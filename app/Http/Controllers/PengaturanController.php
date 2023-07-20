<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pajak;
use App\Models\Komisi;
use App\Models\Kontak;
use App\Models\Produk;
class PengaturanController extends Controller
{

    public function __construct()
    {
        
    }
    public function index()
    {
       
        $data['data_pajak'] = Pajak::get();    
        $data['komisi'] = Komisi::all();
       
        $data['sales'] = Kontak::datasales();
        $data['barang'] = Produk::get();
        $data['pemasok'] = Kontak::datapemasok();
        return view('pengaturan.pengaturan_index',$data);

    }

    
}
