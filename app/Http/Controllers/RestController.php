<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\penjualan;
use App\Models\Produk;
use App\Models\Account;
use App\Models\Kontak;
use App\Models\Retur;
use App\Models\Detail_pembelian;
use App\Models\detail_penjualan;
use App\Helpers\Pembelian_helper;
use Illuminate\Support\Facades\Validator;
use DB;

class RestController extends Controller
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
        //
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
    public function getDataTransaksi(Request $request)
    {   

        $no_transaksi = e($request->input('no_transaksi'));
        $data = Transaksi::with('kontak')->with('detail_pembelian')->where('no_transaksi',$no_transaksi)->first();
        $pembelian = Pembelian::where('no_transaksi',$no_transaksi)->first();
        $id_pembelian = $pembelian->id;
        $sisa_tagihan = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$id_pembelian);
        $response[] = [
            'data'=>$data,
            'sisa_tagihan'=>$sisa_tagihan
        ]; 
        return response()->json($response);

    }

    public function getDataPenjualan(Request $request)
    {   

        $no_transaksi = e($request->input('no_transaksi'));
        $data = Transaksi::with('kontak')->with('detail_penjualan')->where('no_transaksi',$no_transaksi)->first();
        $penjualan = penjualan::where('no_transaksi',$no_transaksi)->first();
        $id_penjualan = $penjualan->id;
        $sisa_tagihan = \Penjualan_helper::get_sisa_tagihan($no_transaksi,$id_penjualan);
        $response[] = [
            'data'=>$data,
            'sisa_tagihan'=>$sisa_tagihan
        ]; 
        return response()->json($response);

    }

    public function getApiRetur(Request $request)
    {

        $id = e($request->input('id_pembelian'));

        
        $data['data_pembelian'] = Pembelian::with('gudang')->where('id',$id)->first();
        $no_transaksi = $data['data_pembelian']->no_transaksi;
        $data_pembayaran = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();
        $data['detail_pembayaran'] = $data_pembayaran[0]->pembayaran;
        $data['pembelian_belum_bayar'] = Pembelian::where('status_pembelian',1)->count('total');
        if(empty($data['detail_pembayaran'][0]->uid_pembayaran)){
        
            $data['sisa_tagihan'] = $data['data_pembelian']->total;
            $data['total_pembayaran'] = 0;
          
        }else{
            $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
            $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
            $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
            $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
            $idp = $data['data_pembelian']->id;
    
            $data['sisa_tagihan'] = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$idp);
            $data['total_pembayaran'] = \Pembelian_helper::get_total_pembayaran($no_transaksi,$idp);
           

        }
    
        $data['kontak'] = Kontak::findOrFail($data['data_pembelian']->kontak_id);
        // Cek Retur Data
        $Mretur = new Retur();
        $data['detail_pembelian'] = detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();

        return response()->json($data);


    }

    //product 
    public function getDataProduct(Request $request)
    {

        $id = e($request->input('id_product'));
        $qty = e($request->input('qty'));

        $response = Produk::with('unit_produk')->where('id',$id)->get();

        ob_start();

        ?>
     <?php foreach($response as $i){ ?>
            <tr>
               
                <td><input type="hidden" name="idp[]" value="<?= $i->id ?>"/><?= $i->id ?></td>
                <td><?= $i->nama_produk ?></td>
                <td><input type="hidden" name="qty[]" value="<?= $qty ?>" /><?= $qty ?></td>
                <td><?= $i->unit_produk->nama_unit ?></td>
                <td><?= $i->harga_jual ?></td>
                <td><?= \Helper::rupiah(intval(str_replace(['Rp.', '.', ','], '', $i->harga_jual)) * $qty) ?></td>
                <td><i class="fas fa-trash text-danger hapus_baris"></i></td>
                 </a>
            </tr>
     <?php } ?>
        <?php
     $html_output = ob_get_clean();

     echo $html_output;


    }

    public function getDataModalBundle($id){

        $response = Produk::with('unit_produk')->where('id',$id)->get();

        ob_start();

        ?>
     <?php foreach($response as $i){ ?>
            <tr>
              
                <td><?= $i->nama_produk ?> (<?= $i->unit_produk->nama_unit ?>)</td>
                <td><input type="text" class="form-control qty_produk" name="qty_produk" /></td>
            
               
            </tr>
     <?php } ?>
        <?php
     $html_output = ob_get_clean();

     echo $html_output;

    }
    public function data_product_search(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|max:255',
          ]);
        
          if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request.'], 400);
          }
        
          $term = e($request->input('term'));
        
          $data_produk = Produk::select('nama_produk', 'id')
            ->where(function ($query) use ($term) {
            $query->whereRaw('LEFT(nama_produk, 2) = ?', [substr($term, 0, 2)])
            ->orWhere(function ($query) use ($term) {
                $query->whereRaw('LEFT(nama_produk, 2) != ? AND SUBSTRING(nama_produk, 3) LIKE ?', [substr($term, 0, 2), '%' . substr($term, 2) . '%']);
            });
             })
            ->get();
             $response = array();
            foreach($data_produk as $i){
                    $response[] = array("value"=>$i->nama_produk,"label"=>$i->id);
            }
          return response()->json($response);

    }

    //retur
    public function getDataRetur(Request $request)
    {   

        $id = e($request->input('id_pembelian'));

        $data['data_pembelian'] = Pembelian::with('gudang')->where('id',$id)->first();
        $no_transaksi = $data['data_pembelian']->no_transaksi;
        $data_pembayaran = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();
        $data['detail_pembayaran'] = $data_pembayaran[0]->pembayaran;
        $data['pembelian_belum_bayar'] = Pembelian::where('status_pembelian',1)->count('total');
        if(empty($data['detail_pembayaran'][0]->uid_pembayaran)){
        
            $data['sisa_tagihan'] = $data['data_pembelian']->total;
            $data['total_pembayaran'] = 0;
          
        }else{
            $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
            $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
            $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
            $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
            $idp = $data['data_pembelian']->id;
    
            $data['sisa_tagihan'] = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$idp);
            $data['total_pembayaran'] = \Pembelian_helper::get_total_pembayaran($no_transaksi,$idp);
           

        }
    
        $data['kontak'] = Kontak::findOrFail($data['data_pembelian']->kontak_id);
        // Cek Retur Data
        $Mretur = new Retur();
        $data['detail_pembelian'] = detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();

        ob_start();

        ?>
      <?php foreach($data['detail_pembelian'] as $i){ ?>
        <tr>
            <td style="width:17%;" class="anak">
                <input type="hidden" name="jenis_retur" value="faktur" />
                <input type="hidden" name="id_produk[]"
                    value="<?= $i->detail_produk->id ?>">
                <?= $i->detail_produk->nama_produk ?>
            </td>

            <td style="width: 5%;">
                <?= $i->qty ?>
                <input type="hidden" name="qty" value="<?= $i->qty ?>" />
            </td>
            <td style="width: 5%;">
                <?php 
                    $qty_limit = $i->qty -
                    $Mretur->get_qty_retur($data['data_pembelian']->no_transaksi,$i->product_id);
                ?>

                <?= $qty_limit ?>

                <input type="hidden" name="qty_limit" value="<?= $qty_limit ?>" />
            </td>
            <td style="width: 5%;"><input type="number" class="form-control"
                    name="qty_retur[]" value="0"></td>
            <td style="width: 7%;">
                <?= \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) ?>
            </td>
            <td class="text-right">
                <input type="text" class="form-control text-right align-right "
                    readonly name="harga_satuan"
                    value="<?= \Helper::rupiah($i->harga_satuan) ?>" />
                <input type="hidden" name="harga_satuan_int[]"
                    class="harga_satuan_int" value="<?= $i->harga_satuan ?>" />
            </td>
            <td class="text-right"><?= $i->pajak_id ?> </td>
            <td>
                <input type="text"
                    class="form-control form-control-sm text-right font-weight-bold subtotal"
                    style="height:30px; font-size:smaller; padding-top:3px;"
                    name="subtotal[]" placeholder="" value="0" />
                <input type="hidden" name="subtotal_int[]" class="subtotal_int"
                    value="0">
            </td>
            <td>
               <i class="hapus_row fas fa-trash text-danger"></i> 
            </td>

        </tr>
     <?php } ?>
        <?php
     $html_output = ob_get_clean();

     echo $html_output;
        // return view('pembelian.pembelian_retur_show',$data);   

    }

    public function data_retur_search(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|max:255',
          ]);
        
          if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request.'], 400);
          }
        
          $term = e($request->input('term'));
          $id_supplier = e($request->input('supplier'));
        
          $transaksi = Pembelian::select('no_referensi', 'id')
            ->where('kontak_id', $id_supplier)
            ->where(function ($query) use ($term) {
            $query->whereRaw('LEFT(no_referensi, 2) = ?', [substr($term, 0, 2)])
            ->orWhere(function ($query) use ($term) {
                $query->whereRaw('LEFT(no_referensi, 2) != ? AND SUBSTRING(no_referensi, 3) LIKE ?', [substr($term, 0, 2), '%' . substr($term, 2) . '%']);
            });
             })
            ->get();
             $response = array();
            foreach($transaksi as $i){
                    $response[] = array("value"=>$i->no_referensi,"label"=>$i->id);
            }
          return response()->json($response);

    }


    public function data_transaksi_search(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'required|string|max:255',
          ]);
        
          if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request.'], 400);
          }
        
         
          $id_supplier = e($request->input('id_supplier'));
        
    //       $transaksi = Pembelian::select('no_referensi', 'no_transaksi','id')
    // ->where('kontak_id', $id_supplier)
    // ->where(function ($query) use ($term) {
    //     $query->whereRaw('LEFT(no_referensi, 2) = ?', [substr($term, 0, 2)])
    //         ->orWhere(function ($query) use ($term) {
    //             $query->whereRaw('LEFT(no_referensi, 2) != ? AND SUBSTRING(no_referensi, 3) LIKE ?', [substr($term, 0, 2), '%' . substr($term, 2) . '%']);
    //         });
    // })
    // ->whereIn('status_pembelian', [1, 4])
    // ->get();

             $response = array();
            // foreach($transaksi as $i){
            //         $response[] = array("value"=>$i->no_referensi,"label"=>$i->no_transaksi,'id'=>$i->id);
            // }

            $response = Pembelian::where('kontak_id', $id_supplier)
            ->where('nama_transaksi', 'Faktur Pembelian')
            ->get();         
                

            if($response->isEmpty()){

                $data_response = [];
            }else{
                foreach($response as $i)
                {
                    if($i->sisa_tagihan == 0){
                            $data_response = [];
                    }else{
    
                        $data_response[] = [
                            'no_referensi' => $i->no_referensi,
                            'no_transaksi' => $i->no_transaksi,
                            'sisa_tagihan' => $i->sisa_tagihan,
    
                        ];
                    }
                  
                }

            }
           
          return response()->json($data_response);

    }

    public function data_penjualan_search(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'required|string|max:255',
          ]);
        
          if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request.'], 400);
          }
        
         
          $id_supplier = e($request->input('id_supplier'));
        
    //       $transaksi = Pembelian::select('no_referensi', 'no_transaksi','id')
    // ->where('kontak_id', $id_supplier)
    // ->where(function ($query) use ($term) {
    //     $query->whereRaw('LEFT(no_referensi, 2) = ?', [substr($term, 0, 2)])
    //         ->orWhere(function ($query) use ($term) {
    //             $query->whereRaw('LEFT(no_referensi, 2) != ? AND SUBSTRING(no_referensi, 3) LIKE ?', [substr($term, 0, 2), '%' . substr($term, 2) . '%']);
    //         });
    // })
    // ->whereIn('status_pembelian', [1, 4])
    // ->get();

             $response = array();
            // foreach($transaksi as $i){
            //         $response[] = array("value"=>$i->no_referensi,"label"=>$i->no_transaksi,'id'=>$i->id);
            // }
            $response = penjualan::where('kontak_id',$id_supplier)->get();
          return response()->json($response);

    }

    public function getData(Request $request)
    {
        $filter = $request->input('filter');
        $topSoldProducts = detail_penjualan::join('penjualan', 'penjualan.id', '=', 'detail_penjualan.penjualan_id')
    ->select('detail_penjualan.product_id', 'product.nama_produk', DB::raw('SUM(detail_penjualan.qty) as total_qty'))
    ->join('product', 'detail_penjualan.product_id', '=', 'product.id')
    ->groupBy('detail_penjualan.product_id', 'product.nama_produk')
    ->orderByDesc('total_qty')
    ->limit(5);

// Produk dengan jumlah terendah terjual
$bottomSoldProducts = Produk::leftJoin('detail_penjualan', 'product.id', '=', 'detail_penjualan.product_id')
    ->select('product.id', 'product.nama_produk', DB::raw('COALESCE(SUM(detail_penjualan.qty), 0) as total_qty'))
    ->groupBy('product.id', 'product.nama_produk')
    ->orderBy('total_qty')
    ->limit(5);

// Gabungkan hasil query
$products = $topSoldProducts->union($bottomSoldProducts)->get();
        // Query data from Transaksi and DetailTransaksi
    

        // Apply filter based on the selected filter type
      

        return response()->json($products);
    }

}
