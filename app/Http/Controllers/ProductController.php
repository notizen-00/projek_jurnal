<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Kategori;
use App\Models\Account;
use App\Models\DetailProduk;
use App\Models\Produk;
use App\Models\Gudang;
use App\Models\Produk_bundle;
use App\Models\Detail_bundle;
use App\Models\Stok;
use App\Models\Pajak;
use Session;
use App\Events\WidgetGenerate;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {


        $data['product'] = Produk::with('DetailProduk')->with('kategori_produk')->with('unit_produk')->get();
        $data['gudang'] = Gudang::withproduk()->get();
        $data['jumlah_barang'] = Produk::all()->count();
        $data['stok_habis'] = 0;

        $data['stok_hampir_habis'] = 0;
        $url=route('product.index');
        $data_event = [
            'nama_widget'=>'produk',
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
     
        return view('product.product_index',$data);
        // \Helper::get_stok_produk_all();
    }

    public function data(){

        $model = Pembelian::where('tipe_pembelian',1)->with('kontak')->get();
        // dd($model);
        $data = DataTables::of($model)
                ->addColumn('html_notransaksi', function ($model) {
                 return '<a class="text-primary nav-widget" data-transaksi="'.$model->no_transaksi.'" data-id="'.$model->id.'" href="'.route('pembelian.show', $model->id).'">'.$model->no_transaksi.'</a>';
             })
            ->editColumn('kontak', function($model) {
            return $model->kontak->nama_kontak;
            })
            ->editColumn('total', function($model) {
                return \Helper::rupiah($model->total);
                })
            ->addColumn('sisa_tagihan',function($model){
                return \Helper::rupiah(\Pembelian_helper::get_sisa_tagihan($model->no_transaksi,$model->id));
            })
            ->addColumn('status',function($model){
                return \Transaksi_helper::get_status_name($model->status_pembelian);
            })
            ->editColumn('tag',function($model){
                return '<span class="badge badge-primary"> <i class="fas fa-tag"></i> '. $model->tag .'</span>';
            })
            ->rawColumns(['status','tag','html_notransaksi'])
         ->toJson();

         return $data;
    }
    public function info($id,$status)
    {
        if($status == 'beli'){
            $data = Produk::with('unit_produk')->with('pajaks_beli')->where('id',$id)->first();

        }else if($status == 'jual')
        {

            $cek_tipe = Produk::checkstatus($id);

            if($cek_tipe == 'single'){

                $data = Produk::with('unit_produk')->with('pajaks_jual')->where('id',$id)->first();

            }else if($cek_tipe == 'bundle'){

                $data = Produk::with('unit_produk')->where('id',$id)->first();

            }
        }
      
      
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['unit'] = Unit::all();
        $data['kategori'] = Kategori::all();
        $data['akun_pembelian'] = Account::where('kategori_akun_id',9)->get();
        $data['akun_penjualan'] = Account::where('kategori_akun_id',8)->get();
        $data['akun_persediaan_barang'] = Account::where('kategori_akun_id',3)->get();
        $data['pajak'] = Pajak::all();
        return view('product.product_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar'=>'nullable|mimes:jpg,png,bmp,jpeg|file',
            'nama_produk'=>'required|max:100|unique:product',
            'kode_barang'=>'nullable|min:4',
            'kategori'=>'nullable',
            'unit'=>'nullable',
            'deskripsi'=>'nullable|max:100|min:4',
            'harga_beli'=>'nullable|required_if:jenis_produk,1|integer',
            'harga_jual'=>'nullable|required_if:jenis_produk,1|integer',
            'akun_pembelian'=>'required',
            'akun_penjualan' =>'required',
            'akun_persediaan_barang'=>'nullable',
            'batas_minimum'=>'nullable|integer',
            'pajak_beli'=>'nullable',
            'pajak_jual'=>'nullable',
            'jenis_produk'=>'required|in:1,2',
            'harga_jual_bundle'=>'nullable|required_if:jenis_produk,2',
            'idp'=>'nullable|required_if:jenis_produk,2',
            'qty'=>'nullable|required_if:jenis_produk,2',
            'diskon'=>'nullable|required_if:jenis_produk,2'
        ]);

        if($request->jenis_produk == 1){

            $produk = new Produk();
        if($request->hasFile('gambar')){
             $request->gambar->store('public/images');
            $path = $request->gambar->store('');
            $produk->image_produk = $path;
        }else{
            $produk->image_produk = '';
        }
        $produk->nama_produk = $request->nama_produk;
        $produk->kode_produk = $request->kode_barang;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->unit_produk_id = $request->unit;
        $produk->kategori_produk_id = $request->kategori;
        $produk->batas_minimum = $request->batas_minimum;
        $produk->deskripsi = $request->deskripsi;
        $produk->status_produk = 1;
        $produk->pajak_beli = $request->pajak_beli;
        $produk->pajak_jual = $request->pajak_jual;
        $produk->save();
        
        $id_produk = $produk->id;

        $detail = new DetailProduk();
        $detail->product_id = $id_produk;
        $detail->akun_pembelian = $request->akun_pembelian;
        $detail->akun_penjualan = $request->akun_penjualan;
        $detail->akun_persediaan_barang = $request->akun_persediaan_barang;

        $detail->save();

        if($produk){

            Session::flash('sukses','Data Produk '.$request->nama_produk.' Berhasil disimpan');
            return redirect('product');
        }else{

            Session::flash('error','Data Produk Gagal Tersimpan');
            return redirect('product.create');
        }

        }else if($request->jenis_produk == 2){

            $harga_jual_bundle = preg_replace('/[^0-9]/', '', $request->harga_jual_bundle);

            $dpp = round(100/111 * $harga_jual_bundle,2);

            if($request->hasFile('gambar')){
                $request->gambar->store('public/images');
               $path = $request->gambar->store('');
               $image_produk = $path;
           }else{
               $image_produk = '';
           }

            $data_bundle = [
                'nama_paket' => $request->nama_produk,
                'harga_bundle' => $harga_jual_bundle,
                'status_bundle' => 'aktif',
                'diskon'=>$request->diskon,
                'dpp'=>$dpp

            ];

            $data_produk = [
                'nama_produk' => $request->nama_produk,
                'harga_jual'=> $harga_jual_bundle,
                'tipe_produk' => $request->jenis_produk,
                'kategori_produk_id' => $request->kategori,
                 'status_produk'=>1,
                 'diskon'=>$request->diskon,
                 'dpp'=>$dpp,
                 'kode_produk'=>$request->kode_barang,
                 'unit_produk_id'=>$request->unit,
                 'batas_minimum'=>1,
                 'image_produk'=>$image_produk
                 
            ];

            $bundle_id = Produk::insertGetId($data_produk);

            $arr_detail_produk = [
                    'idp' => $request->idp,
                    'qty' => $request->qty
            ];

            // $bundle_id = Produk_bundle::insertGetId($data_bundle);


            for($x = 0;$x < count($arr_detail_produk['idp']);$x++){
                $detail_bundle[] = [
                    'product_id'=>$bundle_id,
                    'sub_product_id'=>$arr_detail_produk['idp'][$x],
                    'jumlah_produk'=>$arr_detail_produk['qty'][$x]
                ];   
            }

            $insert_detail_bundle = Detail_bundle::insert($detail_bundle);

            if($insert_detail_bundle){

                Session::flash('sukses','Data Produk bundle '.$request->nama_produk.' Berhasil disimpan');
                return redirect('product');
            }else{
    
                Session::flash('error','Data Produk bundle Gagal Tersimpan');
                return redirect('product.create');
            }



        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['detail'] =  Produk::with('pajaks_jual')->with('pajaks_beli')->where('id', $id)->first();
                            // dd($data['detail']->pajaks_jual);
        $data_akun_pembelian = DetailProduk::with('akun_pembelian_code')->where('product_id', $id)->get();
        $data['kode_pembelian'] = $data_akun_pembelian[0]->akun_pembelian_code->kode_akun;
        $data['akun_pembelian'] = "(".$data_akun_pembelian[0]->akun_pembelian_code->kode_akun.") - ".$data_akun_pembelian[0]->akun_pembelian_code->nama_akun;

        $data_akun_penjualan = DetailProduk::with('akun_penjualan_code')->where('product_id', $id)->get();
        $data['kode_penjualan'] = $data_akun_penjualan[0]->akun_penjualan_code->kode_akun;
        $data['akun_penjualan'] = "(".$data_akun_penjualan[0]->akun_penjualan_code->kode_akun.") - ".$data_akun_penjualan[0]->akun_penjualan_code->nama_akun;
        $url=url('product/'.$id);
        $data_event = [
            'nama_widget'=>$data['detail']->nama_produk,
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
        return view('product.product_show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['detail'] = Produk::findOrFail($id);
        $data['unit'] = Unit::all();
        $data['pajak'] = Pajak::all();
        $data['kategori'] = Kategori::all();
        $data['akun_pembelian'] = Account::where('kategori_akun_id',9)->get();
        $data['akun_penjualan'] = Account::where('kategori_akun_id',8)->get();
        $data['akun_persediaan_barang'] = Account::where('kategori_akun_id',3)->get();
        return view('product.product_edit',$data);
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


    public function getDataBundle()
    {

        $data = Produk_bundle::all();

        ob_start();
    
        ?>

            <?php foreach($data as $i){ ?>
                <tr>
                    <td></td>
                    <td><?= $i->kode_produk ?></td>
                    <td><?= $i->nama_paket ?> <br> <span class="badge badge-success">Bundle</span></td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= \Helper::rupiah($i->harga_bundle) ?></td>
                </tr>
            <?php } ?>

        <?php
        
        $html_output = ob_get_clean();
        
        echo $html_output;

    }
}