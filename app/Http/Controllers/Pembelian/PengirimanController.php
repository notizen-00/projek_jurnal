<?php

namespace App\Http\Controllers\Pembelian;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Pembelian;
use App\Models\PemesananPembelian;
use App\Models\Detail_pembelian;
use App\Models\Pengiriman;
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
class PengirimanController extends Controller
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

        $model = Pengiriman::getdatapengiriman();
        // dd($model);
        $data = DataTables::of($model)
                ->addColumn('html_notransaksi', function ($model) {
                 return '<a class="text-primary nav-widget" data-transaksi="'.$model->no_transaksi.'" data-id="'.$model->transaksi_id.'" href="'.route('pembelian_pengiriman.show', $model->transaksi_id).'">'.$model->no_transaksi.'</a>';
             })
            ->editColumn('status_pengiriman',function($model){
                return \Transaksi_helper::getstatuspengiriman($model->status_pengiriman);
            })
            ->editColumn('tag',function($model){
                return '<span class="badge badge-primary"> <i class="fas fa-tag"></i> '. $model->tag .'</span>';
            })
            ->rawColumns(['status_pengiriman','tag','html_notransaksi'])
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

       
        $uid_pengiriman = \Pembelian_helper::generate_nomor_transaksi($request->input('tipe_pembelian'));
        $nama_transaksi = \Pembelian_helper::get_tipe_pembelian_name($request->input('tipe_pembelian'));
        
        $pemesanan = Pembelian::where('no_transaksi',$request->no_transaksi_pemesanan)->first();
        $uid_pembelian = $pemesanan->uid_pembelian;
        
        $detail_produk = array(
            'id_produk' => $request->input('id_produk'),
            'jumlah_pengiriman' => $request->input('qty'),

        );

        $tipe_pajak = \Pembelian_helper::get_tipe_pajak_notransaksi($request->input('no_transaksi_pemesanan'));


        $data_pembelian = 
        [
            'uid_pembelian' => $uid_pembelian,
            'kontak_id'=>$request->kontak_id,
            'gudang_id'=>$request->gudang_id,
            'tgl_transaksi'=>date('Y-m-d'),
            'tgl_jatuh_tempo'=>$pemesanan->tgl_jatuh_tempo,
            'syarat_pembayaran'=>$pemesanan->syarat_pembayaran,
            'nama_transaksi'=>'Pengiriman Pembelian',
            'no_transaksi'=>$uid_pengiriman,
            'status_pembelian'=>1,
            'no_referensi'=>$request->no_referensi,
            'pesan'=>$request->pesan,
            'memo'=>$request->memo,
            'tag'=>$request->tag,
            'tipe_pembelian'=>3
        ];

        Pembelian::insert($data_pembelian);

        $data_transaksi = [
            'nama_transaksi'=>$nama_transaksi,
            'kontak_id'=>$request->kontak_id,
            'tgl_transaksi'=>date('Y-m-d'),
            'no_transaksi'=>$uid_pengiriman,
            'alamat_penagihan'=>Kontak::getAlamatKontak($request->kontak_id),
            'memo'=>$request->input('memo'),
            'pesan'=>$request->pesan,
            'status_transaksi'=>'pengiriman pembelian',
            'tag'=>$request->tag,
        ];

        $insert_data_transaksi = Transaksi::insertGetId($data_transaksi);

        for($x = 0; $x < count($detail_produk['id_produk']); $x++){

            $data_pengiriman[] = array(
                    'product_id' => $detail_produk['id_produk'][$x],
                    'jumlah_kirim'=>$detail_produk['jumlah_pengiriman'][$x],
                    'jumlah_transaksi'=>\Pembelian_helper::getHargaPembelianPemesananByProduk($request->no_transaksi_pemesanan,$detail_produk['id_produk'][$x]),
                    'uid_pengiriman'=>$uid_pengiriman,
                    'gudang_id'=>$request->input('gudang_id'),
                    'no_transaksi'=>$request->input('no_transaksi_pemesanan'),
                    'status_pengiriman'=>1,
                    'tipe_pajak'=>$tipe_pajak
            );

            $data_debit[] = array(
                    'transaksi_id'=>$insert_data_transaksi,
                    'akun_transaksi'=>'1-10200',
                    'debit'=>\Pembelian_helper::getHargaPembelianPemesananByProduk($request->no_transaksi_pemesanan,$detail_produk['id_produk'][$x]),
                    'kredit'=>0

            );

            $detail_transaksi_stok[] = [
                'product_id'=>$detail_produk['id_produk'][$x],
                'gudang_id'=>$request->gudang_id,
                'jumlah_barang'=>$detail_produk['jumlah_pengiriman'][$x],
                'no_transaksi'=>$uid_pengiriman,
                'status_transaksi'=>1
            ];

        }

        $insert_pengiriman = Pengiriman::insert($data_pengiriman);

         $data_kredit = [
                'transaksi_id'=>$insert_data_transaksi,
                'akun_transaksi'=>'2-20101',
                'debit'=>0,
                'kredit'=>\Pembelian_helper::getHargaPembelianPemesanan($request->no_transaksi_pemesanan)
        ];

        Detail_transaksi::insert($data_kredit);
        Detail_transaksi::insert($data_debit);
        Transaksi_stok::insert($detail_transaksi_stok);

        if($insert_data_transaksi && $insert_pengiriman )
        {

            $pembelian = new Pembelian;

            $pembelian->where("no_transaksi", $request->no_transaksi_pemesanan)->update(['status_pembelian' => 5]);



            $response = [
                'status'=>200,
                'message'=>'Data Pengiriman dengan Transaksi'.$uid_pengiriman.' Berhasil Di Simpan'

            ];

        }else{

            $response = [
                'status'=>201,
                'message'=>'Data Pengiriman Gagal Di simpan'
            ];

        }
        
        return response()->json($response);
       
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $transaksi = Transaksi::findOrFail($id);
        $uid_pengiriman = $transaksi->no_transaksi;
        $pengiriman = Pengiriman::with('detail_produk')->where('uid_pengiriman', $uid_pengiriman)->get();
        $no_po = $pengiriman[0]->no_transaksi;
        $data_pemesanan = Pembelian::where('no_transaksi',$no_po)->first();
        $id_pemesanan = $data_pemesanan->id;
        
        $data['detail_pengiriman'] = $pengiriman;
        $kontak_id = $data_pemesanan->kontak_id;
        $data['kontak'] = Kontak::findOrFail($kontak_id);
        // $data['pajak'] = PemesananPembelian::getpajak($id);
        return view('pembelian.pengiriman.pengiriman_show', array_merge($data, compact('transaksi','data_pemesanan')));

    }

    public function new($id)
    {
        $data['detail'] = Pembelian::with('gudang')->where('id',$id)->first();
        $kontak_id = $data['detail']->kontak_id;
        $data['detail_pembelian'] = Detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
        $data['kontak'] = Kontak::findOrFail($kontak_id);
        $data['pajak'] = PemesananPembelian::getpajak($id);
        return view('pembelian.pengiriman.pengiriman_new',$data); 

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
