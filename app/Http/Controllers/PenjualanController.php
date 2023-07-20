<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
use App\Models\penjualan;
use App\Models\Account;
use App\Models\Transaksi_stok;
use App\Models\Pembayaran;
use App\Models\Retur;
use App\Models\Gudang;
use App\Models\Komisi;
use App\Models\detail_penjualan;
use App\Events\WidgetGenerate;
use App\DataTables\PenjualanDataTable;
use DB;
use DataTables;
class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Halaman Penjualan';
        $data['penjualan_faktur'] = penjualan::where('tipe_penjualan',1)->with('kontak')->get();
        $data['penjualan_belum_bayar'] = penjualan::where('status_penjualan',1)->sum('total');
        $data['penjualan_lunas'] = penjualan::where('status_penjualan',3)->sum('total');
        $data['komisi'] = Komisi::get();
        $data['sales'] = Kontak::datasales();
        $data['barang'] = Produk::get();
        $data['pemasok'] = Kontak::datapemasok();

      
        return view('penjualan.penjualan_index',$data);
    }

 

    public function datatable()
    {
        $model = penjualan::where('tipe_penjualan',1)->with('kontak')->get();
        // dd($model);
        $data = DataTables::of($model)
                ->addColumn('html_notransaksi', function ($model) {
                 return '<a class="text-primary nav-widget" data-transaksi="'.$model->no_transaksi.'" data-id="'.$model->id.'" href="'.route('penjualan.show', $model->id).'">'.$model->no_transaksi.'</a>';
             })
            ->editColumn('kontak', function($model) {
            return $model->kontak->nama_kontak;
            })
            ->editColumn('total', function($model) {
                return \Helper::rupiah($model->total);
                })
            ->addColumn('sisa_tagihan',function($model){
                return \Helper::rupiah(\Penjualan_helper::get_sisa_tagihan($model->no_transaksi,$model->id));
            })
            ->addColumn('status',function($model){
                return \Transaksi_helper::get_status_name($model->status_penjualan);
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

     public function get_data()
     {
 
         $data = Penjualan::get();
         ob_start();
     
     ?>
<?php foreach($data as $i){ ?>
<tr>
    <td><?= $i->tgl_transaksi ?></td>
    <td class="nav-item"><a class="text-primary nav-widget" data-transaksi="<?= $i->no_transaksi ?>"
            data-id="<?= $i->id ?>" href="<?= route('penjualan.show',$i->id) ?>"><?=  $i->no_transaksi ?></a>
    </td>
    <td><?= $i->kontak->nama_panggilan ?></td>
    <td><?= $i->tgl_jatuh_tempo ?></td>
    <td><?= \Transaksi_helper::get_status_name($i->status_penjualan) ?>
    </td>
    <td><?= \Helper::rupiah(\Penjualan_helper::get_sisa_tagihan($i->no_transaksi,$i->id)) ?>
    </td>
    <td><?= \Helper::rupiah($i->total) ?></td>

</tr>
<?php  } ?>
<?php
     
     $html_output = ob_get_clean();
     
     echo $html_output;
         
     }

     public function baru()
     {

        $data['title'] = 'Buat Penjualan Baru';
        $data['produk'] = Produk::get();
        $data['supplier'] = Kontak::where('tipe_kontak',1)->get();
        $data['karyawan'] = Kontak::where('tipe_kontak',3)->get();
        $data['gudang'] = Gudang::get();
        
      
        $url = url('penjualan/baru');
        $data_event = [
            'nama_widget'=>'faktur penjualan',
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
        return view('penjualan.penjualan_invoice',$data);
     }

    public function create()
    {  

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
        $pajak_id = $request->pajak_id;
        $qty = $request->qty;
        $deskripsi = $request->deskripsi;
        $satuan = $request->satuan;
        $idp = $request->nama_produk;
        $tipe_penjualan = $request->tipe_penjualan;
        $no_transaksi = $request->no_transaksi;
        $tgl_transaksi = $request->tgl_transaksi;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $referensi = $request->no_referensi;
        $lampiran = '';
        $total = $request->total;
        $sisa_tagihan = $request->sisa_tagihan;
        $pajak = $request->pajak;
        
        
        if(empty($request->metode_pembayaran))
        {
            $metode_pembayaran = NULL;
        }else{
            $metode_pembayaran = $request->metode_pembayaran;
        }

       

        if($tipe_penjualan == 1){
                
                $nomor_transaksi = \Penjualan_helper::generate_nomor_transaksi($tipe_penjualan);
                $nama_transaksi = \Penjualan_helper::get_tipe_penjualan_name($tipe_penjualan);
                $akun_transaksi = \Penjualan_helper::generate_account_transaksi();
           
    
                if($status_transaksi == 'penagihan'){
                    $debit = 0;
                    $kredit = $total;
                }
              

            $data_transaksi = array(
                'nama_transaksi' => $nama_transaksi,
                'kontak_id'=>$kontak,
                'tgl_transaksi'=>$tgl_transaksi,
                'metode_pembayaran'=>$metode_pembayaran,
                'no_transaksi'=>$nomor_transaksi,
                'alamat_penagihan'=>$alamat,
                'memo'=>$memo,
                'lampiran'=>$lampiran,
                'total'=>$total,
                'pajak'=>$pajak,
                'tag'=>$request->tag,
                'status_transaksi'=>'penagihan'
            );
            
         
            $transaksi_id = Transaksi::insertGetId($data_transaksi);

            $detail_transaksi = [
                [
                 'transaksi_id'=>$transaksi_id,
                 'akun_transaksi'=>'1-10100',
                 'debit'=>$total,
                 'kredit'=>0   
                ],
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'4-40000',
                    'debit'=>0,
                    'kredit'=>$request->subtotal_akun   

                ],
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'2-20500',
                    'debit'=>0,
                    'kredit'=>$pajak
                ]

            ];
   
            $detail_transaksi_insert = Detail_transaksi::insert($detail_transaksi);

            $data_penjualan = array(
                'kontak_id'=>$kontak,
                'sales_id'=>$request->id_karyawan,
                'tgl_transaksi'=>$tgl_transaksi,
                'tgl_jatuh_tempo'=>$tgl_jatuh_tempo,
                'syarat_pembayaran'=>$syarat_pembayaran,
                'no_transaksi'=>$nomor_transaksi,
                'status_penjualan'=>1,
                'nama_transaksi'=>$nama_transaksi,
                'no_referensi'=>$referensi,
                'pesan'=>$pesan,
                'memo'=>$memo,
                'total'=>$total,
                'lampiran'=>$lampiran,
                'tipe_penjualan'=>1
            );

       $penjualan = penjualan::insertGetId($data_penjualan);
        
        
        $arr = array(
                'harga_satuan_int' => $harga_satuan_int,
                'subtotal' => $subtotal,
                'gudang_id'=>$request->gudang_id,
                'idp' =>$idp,
                'qty'=>$qty,
                'satuan' =>$satuan,
        );

        $penjualan_id = $penjualan;
        $account_id = 0;
        for($x = 0;$x < count($arr['idp']);$x++){
            $detail_penjualan[] = [
               'harga_satuan'=>$arr['harga_satuan_int'][$x],
               'product_id'=>$arr['idp'][$x],
               'jumlah'=>$arr['subtotal'][$x],
               'qty'=>$arr['qty'][$x],
               'penjualan_id'=>$penjualan_id,
               'account_id'=>$account_id
                    ];
                    $detail_transaksi_stok[] = [
                        'product_id'=>$arr['idp'][$x],
                        'gudang_id'=>$arr['gudang_id'][$x],
                        'jumlah_barang'=>$arr['qty'][$x],
                        'no_transaksi'=>$nomor_transaksi,
                        'status_transaksi'=>2
                    ];
                $produk_detail_transaksi[] = [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'1-10200',
                    'debit'=>0,
                    'kredit'=>$arr['qty'][$x] * \Pembelian_helper::get_average_price($arr['idp'][$x])

                ];

                $beban_pokok[] = $arr['qty'][$x] * \Pembelian_helper::get_average_price($arr['idp'][$x]);
        }
            $beban_pokok_akun = [ 
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>'5-50000',
                    'debit'=>array_sum($beban_pokok),
                    'kredit'=>0
                                ];
        $product_detail_transaksi_insert = Detail_transaksi::insert($produk_detail_transaksi);
        $beban_detail_transaksi_insert = Detail_transaksi::insert($beban_pokok_akun);
        $detail_penjualan_insert = detail_penjualan::insert($detail_penjualan);
        $detail_transaksi_stok_insert = Transaksi_stok::insert($detail_transaksi_stok);

     
        if($detail_penjualan_insert){

            $response_this = array(
                'message'=>'data transaksi '.$nomor_transaksi.' berhasil di simpan',
                'status'=>200,
                'id'=>$penjualan_id
            
            );

        //     $data_proses = array(
        //         'akun'=>[$detail_transaksi],
        //         'total'=>$total,
        //         'status_transaksi'=>'faktur_penjualan',
              
        //      );
    
        //      event(new ProsesTransaksi($data_proses));
          
           echo json_encode($response_this);

         
          
        }else{
            $response = array(
                'message'=>'data transaksi gagal di simpan',
                'status'=>201,
                'data_produk'=>$detail_penjualan,
                'data_penjualan'=>$data_penjualan,
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
        $data['detail'] = Penjualan::findOrFail($id);
        $kontak_id = $data['detail']->kontak_id;
        $data['detail_penjualan'] = detail_penjualan::with('detail_produk')->where('penjualan_id',$id)->get();
        $no_transaksi = $data['detail']->no_transaksi;
        $data_pembayaran = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();
        $data['detail_transaksi'] = Transaksi::where('no_transaksi',$no_transaksi)->firstOrFail();
        $data['detail_pembayaran'] = $data_pembayaran[0]->pembayaran;
        $data['kontak'] = Kontak::findOrFail($kontak_id);
        // dd($data_pembayaran[0]->pembayaran);
        if(empty($data['detail_pembayaran'][0]->uid_pembayaran)){
            // $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
            // $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
            // $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
            // $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
            
            $data['sisa_tagihan'] = $data['detail']->total;
            $data['total_pembayaran'] = 0;
          
        }else{
            $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
            $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
            $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
            $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
            $idp = $data['detail']->id;
    
            $data['sisa_tagihan'] = \Penjualan_helper::get_sisa_tagihan($no_transaksi,$idp);
            $data['total_pembayaran'] = \Penjualan_helper::get_total_pembayaran($no_transaksi,$idp);
           

        }
        $url = url('penjualan/'.$id);
        $data_event = [
            'nama_widget'=>$data['detail']->no_transaksi,
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
        return view('penjualan.penjualan_show',$data);
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

    public function retur_data()
    {

        $data_response = Retur::with('transaksi')->get();

        return response()->json($data_response);

    }

    public function retur_list()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',1)->get();
        return view('penjualan.retur.retur_list',$data);

    }

    public function retur_new()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',1)->get();
        $data['data_penjualan'] = penjualan::all();

        return view('penjualan.retur.retur_new',$data);

    }
    public function retur_index($id = NULL)
    {

        if($id == NULL)
        {
            $url=url('penjualan/retur');
            $data_event = [
                'nama_widget'=>'Retur Penjualan',
                'url_widget'=>$url,
                'status_widget'=>'1'
            ];
            event(new WidgetGenerate($data_event));
            $data['supplier'] = Kontak::where('tipe_kontak',1)->get();
            return view('penjualan.penjualan_retur',$data);
        }else{
            $data['data_penjualan'] = penjualan::findOrFail($id);
            $no_transaksi = $data['data_penjualan']->no_transaksi;
            $data_pembayaran = Transaksi::with('pembayaran')->where('no_transaksi',$no_transaksi)->get();
            $data['detail_pembayaran'] = $data_pembayaran[0]->pembayaran;
            $data['penjualan_belum_bayar'] = penjualan::where('status_penjualan',1)->count('total');
            if(empty($data['detail_pembayaran'][0]->uid_pembayaran)){
            
                $data['sisa_tagihan'] = $data['data_penjualan']->total;
                $data['total_pembayaran'] = 0;
              
            }else{
                $data['data_transaksi'] = Transaksi::with('detail_transaksi')->with('kontak')->where('no_transaksi',$data['detail_pembayaran'][0]->uid_pembayaran)->get();
                $akun_debit = $data['data_transaksi'][0]->detail_transaksi[0]->akun_transaksi;
                $akun_kredit = $data['data_transaksi'][0]->detail_transaksi[1]->akun_transaksi;
                $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();
                $idp = $data['data_penjualan']->id;
        
                $data['sisa_tagihan'] = \Penjualan_helper::get_sisa_tagihan($no_transaksi,$idp);
                $data['total_pembayaran'] = \Penjualan_helper::get_total_pembayaran($no_transaksi,$idp);
               
    
            }
            $url=url('penjualan/retur/'.$id);
            $data_event = [
                'nama_widget'=>'Retur Penjualan - '.$id,
                'url_widget'=>$url,
                'status_widget'=>'1'
            ];
            event(new WidgetGenerate($data_event));
        
            $data['kontak'] = Kontak::findOrFail($data['data_penjualan']->kontak_id);
            // Cek Retur Data
            $data['Mretur'] = new Retur();
            $data['detail_penjualan'] = detail_penjualan::with('detail_produk')->where('penjualan_id',$id)->get();
            $data['supplier'] = Kontak::where('tipe_kontak',1)->get();

            return view('penjualan.penjualan_retur_show',$data);   
        }

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
            $uid_retur = \Penjualan_helper::generate_nomor_transaksi_retur();
            $det_penjualan = penjualan::findOrFail($request->id_penjualan);
    
            $no_transaksi = $det_penjualan->no_transaksi;
    
            // $akun_kredit = $request->akun_transaksi_kredit;
    
            $akun_debit = '1-10200';
            $akun_kredit = '1-10200';
                  
            $arr = array(
                'harga_satuan_int' => $request->harga_satuan_int,
                'subtotal' => $request->subtotal_int,
                'idp' =>$request->id_produk,
                'qty'=>$request->qty_retur,
        
             );
             $data_transaksi = array(
                'nama_transaksi' => 'Retur',
                'kontak_id'=>$request->id_kontak,
                'tgl_transaksi' => date('Y-m-d'),
                'no_transaksi' => $uid_retur,
                'memo'=>$request->memo,
                'total'=>$request->total_retur,
                'status_transaksi' => 'retur',
            );
    
             $transaksi = Transaksi::insert($data_transaksi);
             $last_t  = Transaksi::latest('id')->first();
           
             $transaksi_id = $last_t->id;
    
    
            $penjualan_id = $request->id_penjualan;
       
            for($x = 0;$x < count($arr['idp']);$x++){
                $detail_retur[] = [
                    'uid_retur' =>$uid_retur,
                    'no_transaksi' => $no_transaksi,
                    'jumlah_retur'=>$arr['qty'][$x],
                    'product_id'=>$arr['idp'][$x],
                    'harga_retur'=>$arr['harga_satuan_int'][$x],
                    'status_retur'=>$request->status_retur,
                    'jumlah_transaksi'=>$request->total_retur
                ];    
                
                $data_debit[] = [
                    'transaksi_id' =>$transaksi_id,
                    'akun_transaksi'=>$akun_debit,
                    'debit'=>$arr['subtotal'][$x],
                    'kredit'=>0,
                ];
            }
           
            $insert_retur = Retur::insert($detail_retur);
    
            $data_kredit=
                [
                    'transaksi_id'=>$transaksi_id,
                    'akun_transaksi'=>\Transaksi_helper::get_akun_transaksi_kredit('retur-penjualan',$request->total_retur),
                    'debit'=>0,
                    'kredit'=>$request->total_retur
                ];
          
    
            Detail_transaksi::insert($data_kredit);
            Detail_transaksi::insert($data_debit);
            
            DB::commit();
    
            $data_response = [
                'url'=>'penjualan/retur_show/'.$insert_retur,
                'id'=>$insert_retur,
                'message'=>'Data retur berhasil di simpan',
                'no_transaksi'=>$uid_retur,
                'status'=>200
            ];
    
            echo json_encode($data_response);
        } catch (\Exception $e) {
            DB::rollback();
    
            $data_response = [
                'message' => 'Terjadi kesalahan dalam memproses retur',
                'status' => 500
            ];
    
            return response()->json($data_response);
        }
    }

    public function pembayaran_penjualan_list()
    {

        return view('penjualan.pembayaran.pembayaran_list');
    }

    public function pembayaran_penjualan_data()
    {
        $data_response = Pembayaran::detailpembayaranpenjualan();

        echo json_encode($data_response);
    }

    public function pembayaran_new()
    {
        $data['supplier'] = Kontak::where('tipe_kontak',1)->get();
        $data['transaksi'] = Penjualan::all();
        return view('penjualan.pembayaran.pembayaran_new',$data);
    }

    public function pembayaran_penjualan($id){

        $data['detail'] = penjualan::findOrFail($id);
        $kontak_id = $data['detail']->kontak_id;
        $data['total'] = \Helper::rupiah($data['detail']->total);
        $data['detail_kontak'] = detail_penjualan::with('detail_produk')->where('penjualan_id', $id)->get();
        $data['supplier'] = Kontak::findOrFail($kontak_id);
        $idp = $data['detail']->id;
        $no_transaksi = $data['detail']->no_transaksi;
        $data['sisa_tagihan'] = \Penjualan_helper::get_sisa_tagihan($no_transaksi,$idp);
        return view('penjualan.penjualan_payment',$data);
    }

    public function pembayaran_store(Request $request)
    {   

       
        $nomor_transaksi = \Penjualan_helper::generate_nomor_transaksi_pembayaran();
        $akun_debit = $request->akun_transaksi_debit;

        $akun_kredit = '1-10100';

        $arr_pembayaran = [
            'nomor_transaksi'=>$request->no_transaksi_penjualan,
            'jumlah_pembayaran'=>$request->jumlah_pembayaran
        ];

        for($x = 0;$x < count($arr_pembayaran['nomor_transaksi']);$x++){
            
                $data_pembayaran[] = [
                    'uid_pembayaran'=>$nomor_transaksi,
                    'nomor_transaksi'=>$arr_pembayaran['nomor_transaksi'][$x],
                    'jumlah_pembayaran'=>$arr_pembayaran['jumlah_pembayaran'][$x]
                ];
             
        }

        $data_transaksi = array(
            'nama_transaksi' => 'Terima Pembayaran',
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
            $pembelian = penjualan::where("no_transaksi", $noTransaksi)->first();
            $pembayaran = Pembayaran::where('nomor_transaksi', $noTransaksi)->get();
        
            $sisa_tagihan = \Penjualan_helper::get_sisa_tagihan($noTransaksi, $pembelian->id);
            $balance = $sisa_tagihan - $jumlahPembayaranArray[$key];
        
            if ($balance == 0) {
                // Update status of purchase to 3 (fully paid)
                $pembelian->status_penjualan = 3;
            } elseif ($pembelian->status_penjualan != 3) {
                // Update status of purchase to 4 (installment payment)
                $pembelian->status_penjualan = 4;
            }
        
            // Save the changes to the purchase
            $pembelian->save();
        
            if (($pembelian->status_penjualan == 4 || $pembelian->status_penjualan == 1) && $balance == 0) {
                // Update status of purchase to 3 (fully paid)
                $pembelian->status_penjualan = 3;
            }
        
            // Save the changes to the purchase for each specific no_transaksi
            $pembelian->where("no_transaksi", $noTransaksi)->update(['status_penjualan' => $pembelian->status_penjualan]);
        }



         $insert_pembayaran = Pembayaran::insert($data_pembayaran);

         $data_response = [
            'url'=>'penjualan/pembayaran/list',
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
        
        $data['akun_kredit'] = Account::where('kode_akun',$akun_kredit)->get();

        return view('pembelian.pembayaran_show',$data);

    }

    public function pembayaran_edit($id)
    {
        $data['detail_pembayaran'] = Pembayaran::findOrFail($id);

        dd($data);
    }

    public function retur_penjualan($id)
    {
        $data['detail_penjualan'] = penjualan::findOrFail($id);

        dd($data['detail_penjualan']);

    }
}
