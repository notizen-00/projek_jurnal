<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Pembelian;
use App\Models\PemesananPembelian;
use App\Models\Detail_pembelian;
use App\Models\Account;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use App\Models\Pembayaran;
use App\Models\Retur;
use App\Models\Gudang;
use App\Models\Transaksi_stok;
use App\Models\Memo;
use App\Events\ProsesTransaksi;
use App\Events\WidgetGenerate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;

class PembelianPemesananController extends Controller
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

    public function datatable()
    {

        $model = Pembelian::getpemesanan();

        // dd($model);
        // dd($model);
        $data = DataTables::of($model)
                ->addColumn('html_notransaksi', function ($model) {
                 return '<a class="text-primary nav-widget" data-transaksi="'.$model->no_transaksi.'" data-id="'.$model->pembelian_id.'" href="'.route('pembelian_pemesanan.show', $model->pembelian_id).'">'.$model->no_transaksi.'</a>';
             })
            ->editColumn('nama_kontak', function($model) {
            return $model->nama_kontak;
            })
            ->editColumn('total', function($model) {
                return \Helper::rupiah($model->total);
                })
                ->addColumn('jumlah_dp',function($model){
                    return \Helper::rupiah(0);
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
    /**
     * Show the form for creating a new resource.
     *
    * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['title'] = 'Buat Pembelian Baru';
        $data['produk'] = Produk::where('tipe_produk',1)->get();
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
        $data['gudang'] = Gudang::get();

        return view('pembelian.pesanan.pesanan_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $status_transaksi = 'pemesanan pembelian';
        $kontak = $request->supplier;
        $alamat = $request->alamat;
        $email = $request->email;
        $gudang = $request->id_gudang;
        $pesan = $request->pesan;
        $memo = $request->memo;
        $syarat_pembayaran = $request->syarat_pembayaran;
        $harga_satuan = $request->harga_satuan;
        $harga_satuan_int = $request->harga_satuan_int;
        $subtotal = $request->subtotal_int;
        $qty = $request->qty;
        $pajak_id = $request->pajak_id;
        $deskripsi = $request->deskripsi;
        $satuan = $request->satuan;
        $idp = $request->nama_produk;
        $tipe_pembelian = $request->tipe_pembelian;
        $no_transaksi = $request->no_transaksi;
        $tgl_transaksi = $request->tgl_transaksi;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $referensi = $request->no_referensi;
        $lampiran = '';
        $total = $request->total;
        $sisa_tagihan = $request->sisa_tagihan;
        $pajak = $request->pajak;

        if ($request->filled('toggle_pajak')) {
            // Checkbox tercentang dan nilainya tidak kosong
            // Lakukan tindakan yang diperlukan
            $tipe_pajak = 0;
        } else {
            // Checkbox tidak tercentang atau nilainya kosong
            // Lakukan tindakan yang diperlukan
            $tipe_pajak = 1;
        }

        $validator = Validator::make($request->all(), [
            'no_referensi' => ['required','min:2','max:15',Rule::unique('pembelian')->where(function ($query) use ($request) {
                return $query->where('kontak_id', $request->supplier);
            })],

        ],[
            'no_referensi.unique' => 'no referensi : <b>'.$request->no_referensi.'</b> pada Supplier : <b>'. Kontak::getnamakontak($request->supplier) .'</b> <br> telah di gunakan',
        ]);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        
        
        if(empty($request->metode_pembayaran))
        {
           $metode_pembayaran = NULL;
        }else{
            $metode_pembayaran = $request->metode_pembayaran;
        }

       

        if($tipe_pembelian == 2){
                
                $nomor_transaksi = \Pembelian_helper::generate_nomor_transaksi($tipe_pembelian);
                $nama_transaksi = \Pembelian_helper::get_tipe_pembelian_name($tipe_pembelian);
                $akun_transaksi = \Pembelian_helper::generate_account_transaksi();
                

            $data_pembelian = array(
                'kontak_id'=>$kontak,
                'gudang_id'=>$gudang,
                'tgl_transaksi'=>$tgl_transaksi,
                'tgl_jatuh_tempo'=>$tgl_jatuh_tempo,
                'syarat_pembayaran'=>$syarat_pembayaran,
                'no_transaksi'=>$nomor_transaksi,
                'status_pembelian'=>1,
                'nama_transaksi'=>$nama_transaksi,
                'no_referensi'=>$referensi,
                'pesan'=>$pesan,
                'memo'=>$memo,
                'total'=>$total,
                'pajak'=>$tipe_pajak,
                'sisa_tagihan'=>$sisa_tagihan,
                'lampiran'=>$lampiran,
                'tipe_pembelian'=>$request->tipe_pembelian,
                'tag'=>$request->tag
            );

       $pembelian = Pembelian::insertGetId($data_pembelian);
        
        
        $arr = array(
                'harga_satuan_int' => $harga_satuan_int,
                'subtotal' => $subtotal,
                'idp' =>$idp,
                'qty'=>$qty,
                'satuan' =>$satuan,
                'pajak_id' =>$pajak_id,
        );

        $pembelian_id = $pembelian;
        $account_id = 0;
        for($x = 0;$x < count($arr['idp']);$x++){
            $detail_pembelian[] = [
               'harga_satuan'=>$arr['harga_satuan_int'][$x],
               'product_id'=>$arr['idp'][$x],
               'jumlah'=>$arr['subtotal'][$x],
               'qty'=>$arr['qty'][$x],
               'pembelian_id'=>$pembelian_id,
               'account_id'=>$account_id,
               'pajak_id'=>$arr['pajak_id'][$x],
                    ];

            $detail_transaksi_stok[] = [
                'product_id'=>$arr['idp'][$x],
                'gudang_id'=>$gudang,
                'jumlah_barang'=>$arr['qty'][$x],
                'no_transaksi'=>$nomor_transaksi,
                'status_transaksi'=>1
            ];

         
        }

        $detail_pembelian_insert = Detail_pembelian::insert($detail_pembelian);

      
     
        if($detail_pembelian_insert){

            $response_this = array(
                'message'=>'data transaksi '.$nomor_transaksi.' berhasil di simpan',
                'status'=>200,
                'id'=>$pembelian_id
            
            );
          
           echo json_encode($response_this);

         
          
        }else{
            $response = array(
                'message'=>'data transaksi gagal di simpan',
                'status'=>201,
                'data_produk'=>$detail_pembelian,
                'data_pembelian'=>$data_pembelian,
                'input_all'=>$request->all()
            );

            echo json_encode($response);
           
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
        $data['detail'] = Pembelian::findOrFail($id);
        $kontak_id = $data['detail']->kontak_id;
        $data['detail_pembelian'] = Detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
        $data['kontak'] = Kontak::findOrFail($kontak_id);
        $data['pajak'] = PemesananPembelian::getpajak($id);
        return view('pembelian.pesanan.pemesanan_show',$data); 
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
