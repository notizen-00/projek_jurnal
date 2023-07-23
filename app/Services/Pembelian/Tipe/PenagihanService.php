<?php
namespace App\Services\Pembelian\Tipe;

use App\Models\Pembelian;
use App\Models\Kontak;
use App\Models\PemesananPembelian;
use App\Interfaces\Pembelian\TipePembelianInterface;
use App\Services\Pembelian\PembelianService;

class PenagihanService implements TipePembelianInterface

{

    protected $pembelianService;


    public function __construct()
    {
        $this->pembelianService = new PembelianService();
    }


    public function NewMethod($id_pengiriman)
    {

        $pengiriman = Pembelian::findOrFail($id_pengiriman);
        $data['kontak'] = Kontak::findOrFail($pengiriman->kontak_id);
        $data['no_pengiriman'] = $pengiriman->no_transaksi;
        $pemesanan = Pembelian::where('uid_pembelian',$pengiriman->uid_pembelian)->where('nama_transaksi','Pemesanan Pembelian')->first();
        $id_pemesanan = $pemesanan->id;
        $data['detail_pembelian'] = $this->pembelianService->getDetailPembelian($id_pemesanan);
        $data['pajak'] = PemesananPembelian::getpajak($id_pemesanan);
        $data['subtotal'] = $this->pembelianService->getSubtotal($id_pemesanan);
        $data['pembelian'] = Pembelian::with('gudang')->where('id',$id_pemesanan)->first();
        
        // $data['pembelian'] = Pembelian::with('gudang')->where('id',$id_pemesanan)->first();
        // $data['detail_pembelian'] = Detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
        // dd($this->pembelianService->getIdPembelian());
        return $data;
    }
    
}