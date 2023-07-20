<?php
namespace App\Services\Pembelian\Tipe;

use App\Interfaces\Pembelian\TipePembelianInterface;

class PemesananService implements TipePembelianInterface

{

    protected $tipe;


    public function __construct($tipe = 'pemesanan')
    {
        $this->tipe = $tipe;
    }

    public function getTipe()
    {

        return $this->tipe;
    }
    
}