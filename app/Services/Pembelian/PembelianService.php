<?php
namespace App\Services\Pembelian;

use App\Models\Detail_pembelian;


class PembelianService
{


    public function getSubtotal($id_pemesanan)
    {

        return Detail_pembelian::where('pembelian_id', $id_pemesanan)->sum('jumlah');

    }

    public function getDetailPembelian($id_pemesanan)
    {
        
        return Detail_pembelian::with('detail_produk')->where('pembelian_id',$id_pemesanan)->get();

    }
}

?>