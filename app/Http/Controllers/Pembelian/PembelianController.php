<?php

namespace App\Http\Controllers\Pembelian;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Pembelian;
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
class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
    }

    public function index()
    {
        $data['title'] = 'Halaman Pembelian';
        $data['pembelian_faktur'] = Pembelian::where('tipe_pembelian',1)->with('kontak')->get();
        $data['pembelian_pesanan'] = Pembelian::getpemesanan();
        $data['data_pembayaran'] = Pembayaran::with('transaksi')->get();

        // $data['pembelian_belum_bayar'] = \Pembelian_helper::get_sisa_tagihan_all();
        $data['pembelian_lunas'] = Pembelian::where('status_pembelian',3)->sum('total');
       
        $url=route('pembelian.index');
      
        return view('pembelian.pembelian_index',$data);


    }

    public function datatable()
    {
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

    public function get_data()
    {

        $data = Pembelian::get();
        ob_start();
    
    ?>
<?php foreach($data as $i){ ?>
<tr>
    <td><?= $i->tgl_transaksi ?></td>
    <td class="nav-item"><a class="text-primary nav-widget" data-transaksi="<?= $i->no_transaksi ?>"
            data-id="<?= $i->id ?>" href="<?= route('pembelian.show',$i->id) ?>"><?=  $i->no_transaksi ?></a>
            <br>
                                                                        <span class="badge badge-info"><i
                                                                                class="fas fa-tag"></i>
                                                                            <?= $i->no_referensi ?></span>
    </td>
    <td><?= $i->kontak->nama_panggilan ?></td>
    <td><?= $i->tgl_jatuh_tempo ?></td>
    <td><?= \Transaksi_helper::get_status_name($i->status_pembelian) ?>
    </td>
    <td><?= \Helper::rupiah(\Pembelian_helper::get_sisa_tagihan($i->no_transaksi,$i->id)) ?>
    </td>
    <td><?= \Helper::rupiah($i->total) ?></td>

</tr>
<?php  } ?>
<?php
    
    $html_output = ob_get_clean();
    
    echo $html_output;
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function baru()
    {

      
            $data['title'] = 'Buat Pembelian Baru';
            $data['produk'] = Produk::where('tipe_produk',1)->get();
            $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
            $data['gudang'] = Gudang::get();
    
         
            return view('pembelian.pembelian_invoice',$data);
      
       
    }

    public function penagihan($id)
    {
        
        return view('pembelian.pembelian_penagihan',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $status_transaksi = 'penagihan';
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

       

        if($tipe_pembelian == 1){
                
                $nomor_transaksi = \Pembelian_helper::generate_nomor_transaksi($tipe_pembelian);
                $nama_transaksi = \Pembelian_helper::get_tipe_pembelian_name($tipe_pembelian);
                $akun_transaksi = \Pembelian_helper::generate_account_transaksi();
                
              

            $data_transaksi = array(
                'nama_transaksi' => $nama_transaksi,
                'kontak_id'=>$kontak,
                'tgl_transaksi'=>$tgl_transaksi,
                'metode_pembayaran'=>$metode_pembayaran,
                'no_transaksi'=>$nomor_transaksi,
                'alamat_penagihan'=>$alamat,
                'memo'=>$memo,
                'lampiran'=>$lampiran,
                'pajak'=>$pajak,
                'total'=>$total,
                'status_transaksi'=>'penagihan'
            );
            
         
            $transaksi_id = Transaksi::insertGetId($data_transaksi);

            $detail_transaksi = [
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'1-10500',
                    'debit'=>$pajak,
                    'kredit'=>0
                ],
                [
                 'transaksi_id'=>$transaksi_id,
                 'akun_transaksi'=>$request->akun_transaksi_kredit,
                 'debit'=>0,
                 'kredit'=>$total   
                ]

            ];
   
            $detail_transaksi = Detail_transaksi::insert($detail_transaksi);

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
                'tipe_pembelian'=>1,
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

            $product_detail_transaksi[] =
            [
                'transaksi_id'=>$transaksi_id,
                'akun_transaksi'=>$request->akun_transaksi_debit,
                'debit'=>$arr['subtotal'][$x],
                'kredit'=>0
            ];
        }

        $product_detail_transaksi_insert = Detail_transaksi::insert($product_detail_transaksi);
        $detail_pembelian_insert = Detail_pembelian::insert($detail_pembelian);

        $detail_transaksi_stok_insert = Transaksi_stok::insert($detail_transaksi_stok);
     
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
        $no_transaksi = $data['detail']->no_transaksi;   
        $data_pembayaran = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();
        $data['detail_transaksi'] = Transaksi::where('no_transaksi',$no_transaksi)->firstOrFail();
       
        $data['detail_pembayaran'] = $data_pembayaran[0]->pembayaran;
 
        $data['kontak'] = Kontak::findOrFail($kontak_id);
        $data['pembelian_belum_bayar'] = Pembelian::where('status_pembelian',1)->count('total');

        if(empty($data['detail_pembayaran'][0]->uid_pembayaran)){

            $idp = $data['detail']->id;
            $data['sisa_tagihan'] = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$idp);
            $data['total_pembayaran'] = 0;
          
        }else{
            $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
            $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
            $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
            $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
            $idp = $data['detail']->id;
    
            $data['sisa_tagihan'] = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$idp);
            $data['total_pembayaran'] = \Pembelian_helper::get_total_pembayaran($no_transaksi,$idp);
           

        }

        $Mretur = new Retur();
        $data['data_retur'] = $Mretur->get_data_retur($no_transaksi);
        $data['total_retur'] = Retur::where('no_transaksi', $no_transaksi)->sum('jumlah_transaksi');

        $data['data_memo'] = Memo::where('nomor_transaksi', $no_transaksi)->get();
        $data['total_memo'] = Memo::where('nomor_transaksi', $no_transaksi)->sum('jumlah_pembayaran');

        $url=url('pembelian/'.$id);
        $data_event = [
            'nama_widget'=>$no_transaksi,
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
        return view('pembelian.pembelian_show',$data);
     
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

    public function retur_index($id = NULL)
    {

        if($id == NULL)
        {
            $url=url('pembelian/retur');
            $data_event = [
                'nama_widget'=>'Retur Pembelian',
                'url_widget'=>$url,
                'status_widget'=>'1'
            ];
            event(new WidgetGenerate($data_event));
            $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
            return view('pembelian.pembelian_retur',$data);
        }else{
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

            $url=url('pembelian/retur/'.$id);
            $data_event = [
                'nama_widget'=>'Retur Pembelian - '.$id,
                'url_widget'=>$url,
                'status_widget'=>'1'
            ];
            event(new WidgetGenerate($data_event));
        
            $data['kontak'] = Kontak::findOrFail($data['data_pembelian']->kontak_id);
            // Cek Retur Data
            $data['Mretur'] = new Retur();
            $data['detail_pembelian'] = detail_pembelian::with('detail_produk')->where('pembelian_id',$id)->get();
            $data['supplier'] = Kontak::where('tipe_kontak',2)->get();

            return view('pembelian.pembelian_retur_show',$data);   
        }

    }

    public function retur_data()
    {

        $data_response = Retur::with('transaksi')->get();

        return response()->json($data_response);

    }

    public function retur_list()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
        return view('pembelian.retur.retur_list',$data);

    }

    public function retur_new()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
        $data['data_pembelian'] = Pembelian::all();

        return view('pembelian.retur.retur_new',$data);

    }
   

    public function retur_show($id)
    {

        $data['detail_retur'] = Retur::findOrFail($id);

        return view('pembelian.pembelian_retur_detail',$data);

    }

    public function retur_store(Request $request)
    {

        DB::beginTransaction();

        try {
            $uid_retur = \Pembelian_helper::generate_nomor_transaksi_retur();
            $det_pembelian = Pembelian::findOrFail($request->id_pembelian);
    
            $no_transaksi = $det_pembelian->no_transaksi;
    
            // $akun_kredit = $request->akun_transaksi_kredit;
    
            $akun_debit = '2-20100';
            $akun_kredit = '1-10200';
                  
            $arr = array(
                'harga_satuan_int' => $request->harga_satuan_int,
                'subtotal' => $request->subtotal_int,
                'idp' =>$request->id_produk,
                'qty'=>$request->qty_retur,
                'pajak_retur'=>$request->pajak_retur_int
                
             );
             $data_transaksi = array(
                'nama_transaksi' => 'Retur',
                'kontak_id'=>$request->id_kontak,
                'tgl_transaksi' => date('Y-m-d'),
                'no_transaksi' => $uid_retur,
                'memo'=>$request->memo,
                'total'=>$request->total_retur,
                'pajak'=>$request->pajak_retur,
                'status_transaksi' => 'retur',
            );
    
             $transaksi = Transaksi::insert($data_transaksi);
             $last_t  = Transaksi::latest('id')->first();
           
             $transaksi_id = $last_t->id;
    
        
            $pembelian_id = $request->id_pembelian;
            
            if($request->tipe_pajak == 0 ){

            for($x = 0;$x < count($arr['idp']);$x++){
                $detail_retur[] = [
                    'uid_retur' =>$uid_retur,
                    'no_transaksi' => $no_transaksi,
                    'gudang_id'=>$request->gudang_id,
                    'jumlah_retur'=>$arr['qty'][$x],
                    'product_id'=>$arr['idp'][$x],
                    'harga_retur'=>$arr['harga_satuan_int'][$x],
                    'status_retur'=>$request->status_retur,
                    'jumlah_transaksi'=>$arr['harga_satuan_int'][$x] * $arr['qty'][$x],
                    'pajak_retur'=> $arr['harga_satuan_int'][$x] * $arr['qty'][$x] * 11 / 100,
                    'tipe_pajak'=>$request->tipe_pajak
                ];   
                
                $transaksi_stok[] = [
                    'no_transaksi'=>$uid_retur,
                    'gudang_id'=>$request->gudang_id,
                    'product_id'=>$arr['idp'][$x],
                    'jumlah_barang'=>$arr['qty'][$x],
                    'status_transaksi'=>2

                ];
                
                $data_kredit[] = [
                    'transaksi_id' =>$transaksi_id,
                    'akun_transaksi'=>'1-10200',
                    'debit'=>0,
                    'kredit'=>\Pembelian_helper::get_average_price($arr['idp'][$x]) * $arr['qty'][$x],
                ];

                $count_persediaan[] = \Pembelian_helper::get_average_price($arr['idp'][$x]) * $arr['qty'][$x];
            }
                $sum_persediaan = array_sum($count_persediaan);
                $total_persediaan =   $request->total_retur - $request->pajak_retur - $sum_persediaan ;
                $data_persediaan = 
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'8-80100',
                    'debit'=>0,
                    'kredit'=>$total_persediaan 

                ];
                $data_kredit_pajak = 
                [
                    'transaksi_id' =>$transaksi_id,
                    'akun_transaksi'=>'1-10500',
                    'debit'=>0,
                    'kredit'=>$request->pajak_retur
                ];
           
            $insert_retur = Retur::insert($detail_retur);

            $insert_transaksi_stok = Transaksi_stok::insert($transaksi_stok);
    
            $data_debit=
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'2-20100',
                    'debit'=>$request->total_retur,
                    'kredit'=>0
                ];
          
    
            Detail_transaksi::insert($data_kredit);
            Detail_transaksi::insert($data_persediaan);
            Detail_transaksi::insert($data_kredit_pajak);
            Detail_transaksi::insert($data_debit);
            
            $cek_mem = $request->total_retur - $request->sisa_tagihan;
            $cek_mem = abs($cek_mem);
            $status_pembelian = $request->status_pembelian;


            if($cek_memo != 0 ){
                $no_transaksi_memo = \Pembelian_helper::generate_nomor_transaksi_memo();

                $data_transaksi_memo = [
                        'nama_transaksi' => 'Debit Memo',
                        'kontak_id'=>$request->id_kontak,
                        'tgl_transaksi' => date('Y-m-d'),
                        'no_transaksi' => $no_transaksi_memo,
                        'memo'=>$request->memo,
                        'total'=>$cek_memo,
                        'pajak'=>'',
                        'status_transaksi' => 'Debit Memo',
                ];
                
                $insert_transaksi_memo  = Transaksi::insert($data_transaksi_memo);
                $last_transaksi_memo  = Transaksi::latest('id')->first();
           
                $transaksi_memo_id = $last_transaksi_memo->id;

                $detail_transaksi_memo = [
                    [
                        'transaksi_id'=>$transaksi_memo_id,
                        'akun_transaksi'=>'1-10100',
                        'kredit'=>0,
                        'debit'=>$cek_memo
                ],[
                    'transaksi_id'=>$transaksi_memo_id,
                    'akun_transaksi'=>'2-20100',
                    'kredit'=>$cek_memo,
                    'debit'=>0
                ]
                ];

                $insert_detail_transaksi_memo = Detail_transaksi::insert($detail_transaksi_memo);

                //insert memo 

                $data_memo = [
                    'uid_memo'=>$no_transaksi_memo,
                    'nomor_transaksi'=>$no_transaksi,
                    'jumlah_pembayaran'=>$cek_memo,
                    'tanggal_pembayaran'=>date('Y-m-d')
                ];

                $insert_memo = Memo::insert($data_memo);
                
              

            }

            // $cek_pembayaran = Pembayaran::where('')

            }else if($request->tipe_pajak == 1){
                for($x = 0;$x < count($arr['idp']);$x++){
                    $detail_retur[] = [
                        'uid_retur' =>$uid_retur,
                        'no_transaksi' => $no_transaksi,
                        'gudang_id'=>$request->gudang_id,
                        'jumlah_retur'=>$arr['qty'][$x],
                        'product_id'=>$arr['idp'][$x],
                        'harga_retur'=>$arr['harga_satuan_int'][$x],
                        'status_retur'=>$request->status_retur,
                        'jumlah_transaksi'=>$arr['harga_satuan_int'][$x] * $arr['qty'][$x],
                        'pajak_retur'=> round(100/111 * $arr['harga_satuan_int'][$x] * $arr['qty'][$x],2),
                        'tipe_pajak'=>$request->tipe_pajak
                    ];   
                    
                    $transaksi_stok[] = [
                        'no_transaksi'=>$uid_retur,
                        'gudang_id'=>$request->gudang_id,
                        'product_id'=>$arr['idp'][$x],
                        'jumlah_barang'=>$arr['qty'][$x],
                        'status_transaksi'=>2
    
                    ];
                    
                    $data_kredit[] = [
                        'transaksi_id' =>$transaksi_id,
                        'akun_transaksi'=>'1-10200',
                        'debit'=>0,
                        'kredit'=>\Pembelian_helper::get_average_price($arr['idp'][$x]) * $arr['qty'][$x],
                    ];

                    $count_persediaan[] = \Pembelian_helper::get_average_price($arr['idp'][$x]) * $arr['qty'][$x];
                }

                $sum_persediaan = array_sum($count_persediaan);
                $total_persediaan = $request->total_retur - $request->pajak_retur - $sum_persediaan ;

                $data_persediaan = 
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'8-80100',
                    'debit'=>abs($total_persediaan),
                    'kredit'=>0 

                ];
                    $data_kredit_pajak = 
                    [
                        'transaksi_id' =>$transaksi_id,
                        'akun_transaksi'=>'1-10500',
                        'debit'=>0,
                        'kredit'=>$request->pajak_retur
                    ];
               
                $insert_retur = Retur::insert($detail_retur);
    
                $insert_transaksi_stok = Transaksi_stok::insert($transaksi_stok);
        
                $data_debit=
                    [
                        'transaksi_id'=>$transaksi_id,
                        'akun_transaksi'=>'2-20100',
                        'debit'=>$request->total_retur,
                        'kredit'=>0
                    ];
              
        
                Detail_transaksi::insert($data_kredit);
                Detail_transaksi::insert($data_persediaan);
                Detail_transaksi::insert($data_kredit_pajak);
                Detail_transaksi::insert($data_debit);

                $cek_mem  = $request->total_retur - $request->sisa_tagihan;
                
                $cek_memo = abs($cek_mem);
                $status_pembelian = $request->status_pembelian;
                if($cek_memo != 0 ){
                    $no_transaksi_memo = \Pembelian_helper::generate_nomor_transaksi_memo();
    
                    $data_transaksi_memo = [
                            'nama_transaksi' => 'Debit Memo',
                            'kontak_id'=>$request->id_kontak,
                            'tgl_transaksi' => date('Y-m-d'),
                            'no_transaksi' => $no_transaksi_memo,
                            'memo'=>$request->memo,
                            'total'=>$cek_memo,
                            'pajak'=>'',
                            'status_transaksi' => 'Debit Memo',
                    ];
                    
                    $insert_transaksi_memo  = Transaksi::insert($data_transaksi_memo);
                    $last_transaksi_memo  = Transaksi::latest('id')->first();
               
                    $transaksi_memo_id = $last_transaksi_memo->id;
    
                    $detail_transaksi_memo = [
                        [
                            'transaksi_id'=>$transaksi_memo_id,
                            'akun_transaksi'=>'1-10100',
                            'kredit'=>0,
                            'debit'=>$cek_memo
                    ],[
                        'transaksi_id'=>$transaksi_memo_id,
                        'akun_transaksi'=>'2-20100',
                        'kredit'=>$cek_memo,
                        'debit'=>0
                    ]
                    ];
    
                    $insert_detail_transaksi_memo = Detail_transaksi::insert($detail_transaksi_memo);

                    $data_memo = [
                        'uid_memo'=>$no_transaksi_memo,
                        'nomor_transaksi'=>$no_transaksi,
                        'jumlah_pembayaran'=>$cek_memo,
                        'tanggal_pembayaran'=>date('Y-m-d')
                    ];
    
                    $insert_memo = Memo::insert($data_memo);
                    
    
                }



            }




        
            
            DB::commit();
    
            $data_response = [
              
                'id'=>$request->id_pembelian,
                'no_transaksi'=>$uid_retur,
                'message'=>'Retur Pembelian telah berhasil di tambah dengan nomor : '.$uid_retur,
                'status'=>200
            ];
    
            echo json_encode($data_response);
        } catch (\Exception $e) {
            DB::rollback();
    
            $data_response = [
                'message' => $e->getMessage(),
                'status' => 500
            ];
    
            return response()->json($data_response);
        }
    }

    public function pembayaran_list()
    {

        return view('pembelian.pembayaran.pembayaran_list');
    }
    public function pembayaran_data()
    {

        $data_response = Pembayaran::detailpembayaran();
       
        // dd(Pembayaran::detailpembayaran());
        // dd($data_response);

        echo json_encode($data_response);

    }

    public function pembayaran_new()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
        $data['transaksi'] = Pembelian::all();
        return view('pembelian.pembayaran.pembayaran_new',$data);
    }
    public function pembayaran_pembelian($id){

        $data['detail'] = Pembelian::findOrFail($id);
        $kontak_id = $data['detail']->kontak_id;
        $data['total'] = \Helper::rupiah($data['detail']->total);
        $data['detail_kontak'] = Detail_pembelian::with('detail_produk')->where('pembelian_id', $id)->get();
        $data['supplier'] = Kontak::findOrFail($kontak_id);
        $idp = $data['detail']->id;
        $no_transaksi = $data['detail']->no_transaksi;
        $data['sisa_tagihan'] = \Pembelian_helper::get_sisa_tagihan($no_transaksi,$idp);
        return view('pembelian.pembelian_payment',$data);
    }

    public function pembayaran_store(Request $request)
    {   

       
        $nomor_transaksi = \Pembelian_helper::generate_nomor_transaksi_pembayaran();

        $akun_kredit = $request->akun_transaksi_kredit;

        $arr_pembayaran = [
            'nomor_transaksi'=>$request->no_transaksi_pembelian,
            'jumlah_pembayaran'=>$request->jumlah_pembayaran
        ];

        for($x = 0;$x < count($arr_pembayaran['nomor_transaksi']);$x++){
            
                $data_pembayaran[] = [
                    'uid_pembayaran'=>$nomor_transaksi,
                    'nomor_transaksi'=>$arr_pembayaran['nomor_transaksi'][$x],
                    'jumlah_pembayaran'=>$arr_pembayaran['jumlah_pembayaran'][$x]
                ];
             
        }
        

        $akun_debit = '2-20100';

        $data_transaksi = array(
            'nama_transaksi' => 'Kirim Pembayaran',
            'kontak_id'=>$request->id_kontak,
            'tgl_transaksi' => date('Y-m-d'),
            'metode_pembayaran' => $request->cara_pembayaran,
            'no_transaksi' => $nomor_transaksi,
            'memo'=>$request->memo,
            'total'=>$request->total,
            'status_transaksi' => 'pembayaran',
            'tag'=>$request->tag
        );

        $insert_transaksi = Transaksi::insertGetId($data_transaksi);

        $transaksi_id = $insert_transaksi;

        $data_detail = [
            [
            'transaksi_id'=>$transaksi_id,
            'akun_transaksi'=>$akun_debit,
            'debit'=>$request->total,
            'kredit'=>0
            ],
            [
             'transaksi_id'=>$transaksi_id,
             'akun_transaksi'=>$akun_kredit,
             'debit'=>0,
             'kredit'=>$request->total   
            ]

        ];


        $insert_detail = Detail_transaksi::insert($data_detail);
        
       
$noTransaksiArray = $arr_pembayaran['nomor_transaksi'];
$jumlahPembayaranArray = $arr_pembayaran['jumlah_pembayaran'];

foreach ($noTransaksiArray as $key => $noTransaksi) {
    $cek_status = Transaksi::where("no_transaksi", $noTransaksi)->get();
    $pembelian = Pembelian::where("no_transaksi", $noTransaksi)->first();
    $pembayaran = Pembayaran::where('nomor_transaksi', $noTransaksi)->get();

    $sisa_tagihan = \Pembelian_helper::get_sisa_tagihan($noTransaksi, $pembelian->id);
    $balance = $sisa_tagihan - $jumlahPembayaranArray[$key];

    if ($balance == 0) {
        // Update status of purchase to 3 (fully paid)
        $pembelian->status_pembelian = 3;
    } elseif ($pembelian->status_pembelian != 3) {
        // Update status of purchase to 4 (installment payment)
        $pembelian->status_pembelian = 4;
    }

    // Save the changes to the purchase
    $pembelian->save();

    if (($pembelian->status_pembelian == 4 || $pembelian->status_pembelian == 1) && $balance == 0) {
        // Update status of purchase to 3 (fully paid)
        $pembelian->status_pembelian = 3;
    }

    // Save the changes to the purchase for each specific no_transaksi
    $pembelian->where("no_transaksi", $noTransaksi)->update(['status_pembelian' => $pembelian->status_pembelian]);
}


        
        // $data_pembayaran = array(
        //     'uid_pembayaran' => $nomor_transaksi,
        //     'nomor_transaksi'=>$request->no_transaksi_pembelian,
        //     'jumlah_pembayaran'=>$request->jumlah_pembayaran,
        // );

        $insert_pembayaran = Pembayaran::insert($data_pembayaran);
       
        $data_response = [
            'url'=>'pembelian/pembayaran/list',
            'id'=>$pembelian->id,
            'no_transaksi'=>$nomor_transaksi,
        ];

        echo json_encode($data_response);

    }

    public function pembayaran_show($id)
    {

        $data['detail_pembayaran'] = Pembayaran::findOrFail($id);
        $data['transaksi_induk'] = Transaksi::where('no_transaksi',$data['detail_pembayaran']->nomor_transaksi)->get();
        $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran']->uid_pembayaran)->get();
        $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
        $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
        // dd($data['data_transaksi'][0]->id);
        $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
   
        return view('pembelian.pembayaran_show',$data);

    }

    public function pembayaran_edit($id)
    {
        $data['detail_pembayaran'] = Pembayaran::findOrFail($id);

        dd($data);
    }

    public function memo_show($id)
    {

        dd(Memo::findOrFail($id));
    }

    public function reset_pembelian()

    {
        Detail_pembelian::truncate();
        Pembelian::truncate();
        Pembayaran::truncate();
        Detail_transaksi::truncate();
        Transaksi_stok::truncate();
        Transaksi::truncate();
        Memo::truncate();
        Retur::truncate();

        $data = [
            'message'=>'data pembelian berhasil di reset',
        ];
    return response()->json($data, Response::HTTP_OK);
        
    }
}
