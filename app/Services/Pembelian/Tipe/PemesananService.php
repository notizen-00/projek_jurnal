<?php
namespace App\Services\Pembelian\Tipe;

use App\Interfaces\Pembelian\TipePembelianInterface;

use App\Services\Pembelian\PembelianService;
class PemesananService implements TipePembelianInterface

{

    protected $pembelianService;


    public function __construct(PembelianService $PembelianService)
    {
        $this->pembelianService = $PembelianService;
    }

    public function getTipe()
    {

        return $this->tipe;
    }

    public function NewMethod($id_pemesanan)
    {

        $pembelian = Pembelian::findOrFail($id_pemesanan);
        $data['kontak'] = Kontak::findOrFail($pembelian->kontak_id);
        $data['pembelian'] = Pembelian::with('gudang')->where('id',$id_pemesanan)->first();
        $data['transaksi']  = Transaksi::with('pembayaran')->where('id',$id_pemesanan)->first();
        dd($this->pembelianService->getIdPembelian());

        return $data;
    }

   
    
}