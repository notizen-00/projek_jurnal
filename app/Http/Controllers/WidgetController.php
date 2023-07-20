<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Widget;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Pembelian;
use App\Models\penjualan;
use App\Models\detail_penjualan;
use App\Models\Detail_pembelian;
use App\Models\Account;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use App\Models\Pembayaran;
use App\Events\ProsesTransaksi; 
use Barryvdh\DomPDF\Facade\Pdf;

class WidgetController extends Controller
{
    public function get_content()
    {


        ob_start();

        // menampilkan data dalam tabel HTML
     
        echo '<ul class="nav">';
        foreach(\Helper::get_widget() as $i){
        echo '<li >';
        echo  '<div class="btn-group mr-2" role="group" aria-label="Second group">';
        echo '<a class="nav-widget btn btn-primary btn-sm"';
        echo 'href="'.$i->url_widget.'">';
        echo '<p>'.$i->nama_widget.'</p>';
         echo '</a>';
         echo '<button type="button" class="btn btn-sm btn-danger close-widget" data-id="'.$i->id.'">';
        echo ' <i  class="nc-icon nc-simple-remove"></i></button>';
         echo   '</div>';
        echo '</li>';
        }
    echo '</ul>';
        // mendapatkan isi output buffer dan menghapusnya
        $html = ob_get_clean();
        
        // menampilkan hasil
        echo $html;
            
        

    }

    public function update_widget(Request $request)
    {

        $id = $request->id;
        
        Widget::where('id',$id)->update(['status_widget'=>0]);

        $data = Widget::where('status_widget',1)->orderBy('created_at','ASC')->first();

        echo $data->url_widget;



    }

    public function cetak_pdf($id,$status)
    {
        // $pdf = Pdf::loadView('pdf.invoice');

        if($status == 1){
            $data['pembelian'] = Pembelian::findOrFail($id);
            $no_transaksi = $data['pembelian']->no_transaksi;
            $data['transaksi'] = Transaksi::where('no_transaksi',$no_transaksi)->get();
            $id_kontak = $data['pembelian']->kontak_id;
            $data['kontak'] = Kontak::findOrFail($id_kontak);
            $data['detail_pembelian'] = Detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
            $detailPembelian = Detail_pembelian::where('pembelian_id', $id)->get();
            $data['subtotal'] = $detailPembelian->sum(function ($item) {
                    return $item->qty * $item->harga_satuan; // Ubah 'jumlah' dan 'harga' sesuai dengan nama kolom yang sesuai di tabel 'DetailPembelian'
            });
            return view('pdf.invoice',$data);
        }else if($status == 2)
        {   
            $data['pembelian'] = Pembelian::findOrFail($id);
            return view('pdf.retur_pembelian',$data);
        }else if($status== 3)
        {
            $data['pembelian'] = penjualan::findOrFail($id);
            $kontak_id = $data['pembelian']->kontak_id;   
            $data['detail_pembelian'] = detail_penjualan::with('detail_produk')->where('penjualan_id',$id)->get();
            $no_transaksi = $data['pembelian']->no_transaksi;
            $data['transaksi'] = Transaksi::where('no_transaksi',$no_transaksi)->get();
            $data['kontak'] = Kontak::findOrFail($kontak_id);

            return view('pdf.invoice', $data);
        }else if($status == 4)
        {

            return view('pdf.pemesanan_pembelian',$data);
        }
        
        // return $pdf->setPaper('letter', 'potrait')->stream('invoice.pdf');
    }
}

?>
