<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Retur extends Model
{
    use HasFactory;
    public $guard = [];
    protected $table = 'retur';

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class,'no_transaksi','no_transaksi');
    }
    public function get_data_retur($no_transaksi)
    {   
        try {
            $data = Retur::select('id','uid_retur','no_transaksi','jumlah_transaksi','created_at')
                ->where('no_transaksi', $no_transaksi)
                ->groupBy('uid_retur','created_at','no_transaksi','jumlah_transaksi')
                ->get();
            return $data;
        } catch (Exception $e) {
            // Handle the exception
            return null;
        }

    }

    public function get_qty_retur($no_transaksi,$product_id)
    {

        $data_retur = Retur::where('product_id',$product_id)->where('no_transaksi',$no_transaksi)->sum('jumlah_retur');
        return $data_retur;
        
    }

    
}
