<?php
namespace App\Services\Pembelian\Tipe;

use App\Models\Pembelian;
use App\Models\Kontak;
use App\Interfaces\Pembelian\TipePembelianInterface;

class PenagihanService implements TipePembelianInterface

{

    protected $tipe;


    public function __construct($tipe = 'Penagihan Pembelian')
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
    
}