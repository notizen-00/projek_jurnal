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

<<<<<<< HEAD
  
=======
    public function getTipe()
    {
        return $this->tipe;

    }
>>>>>>> d745a393 (test merge)


   
}