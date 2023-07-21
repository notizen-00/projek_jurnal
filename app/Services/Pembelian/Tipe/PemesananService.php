<?php
namespace App\Services\Pembelian\Tipe;

use App\Interfaces\Pembelian\TipePembelianInterface;

class PemesananService implements TipePembelianInterface

{

    protected $tipe;


    public function __construct($tipe = 'Pemesanan Pembelian')
    {
        $this->tipe = $tipe;
    }

    public function getTipe()
    {

        return $this->tipe;
    }

    public function NewMethod($id_pembelian)
    {

        $pembelian = Pembelian::findOrFail($id_pembelian);
        $data['kontak'] = Kontak::findOrFail($pembelian->kontak_id);
        $data['pembelian'] = Pembelian::with('gudang')->where('id',$id_pembelian)->first();
        
        return $data;
    }

    public function getDetailPembelian($uid_pemsanan)
    {

        

    }
    
}