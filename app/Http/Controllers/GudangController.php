<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Gudang;
use App\Events\HelloEvent;
use App\Models\Produk;
use App\Models\Produk_bundle;
class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|max:255',
            'keterangan' => 'nullable|max:200',
            'alamat'=>'required'
            
        ]);
       
        $gudang = new Gudang();

        $gudang->nama_gudang = $request->nama_gudang;
        $gudang->keterangan = $request->keterangan;
        $gudang->status_gudang = 0;
        $gudang->alamat = $request->alamat;
        if($gudang->save()){

                $response = array(
                    'status'=>200,
                    'message'=>'gudang '.$request->nama_gudang.' telah di simpan',
                    'icon'=>'sukses'
                );
                
        }else{
            $response = array(
                'status'=>201,
                'message'=>'gudang '.$request->nama_gudang.' telah di gagal di simpan',
                'icon'=>'danger'
            );

        }
        $data_gudang  = Gudang::WithProduk()->get();
        event(new HelloEvent($data_gudang));
        echo json_encode($response);
        
    }

    public function info_product($product_id,$gudang_id)
    {

        $cek_produk = Produk::checkstatus($product_id);
        if($cek_produk == 'single'){
        $data = Stok::productbygudang($product_id,$gudang_id);
        }else if($cek_produk == 'bundle'){
            
            $stok_produk = Produk_bundle::getstokproduk($product_id);

           
            $rule_bundle = Produk_bundle::getrulebundle($product_id);
           
            $data = \Transaksi_helper::getStokBundle($stok_produk,$rule_bundle);
            
        }
        echo json_encode($data);
    }
    public function detail($id)
    {   
        $data = Stok::Leftjoin('gudang','transaksi_stok.gudang_id','=','gudang.id')
                                ->Leftjoin('product','transaksi_stok.product_id','=','product.id')
                                ->select(\DB::raw('product.nama_produk,gudang.nama_gudang,transaksi_stok.*'))    
                                ->where('transaksi_stok.gudang_id',$id)
                                ->get();
                           
      ob_start();
     
                                ?>
<?php foreach($data as $i){ ?>
<tr>
    <td><?= $i->id ?></td>
    <td><?= $i->nama_produk ?></td>
    <td><?= $i->no_transaksi ?></td>
    <td><?= $i->jumlah_barang?></td>
    <td><?= \Transaksi_helper::get_status_transaksi_gudang($i->status_transaksi) ?></td>
    <td>Total asset</td>
    <td><?= $i->created_at ?></td>

</tr>
<?php  } ?>
<?php
                                
                                $html_output = ob_get_clean();
                                
                                echo $html_output;

        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
