<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaksi;
use App\Models\Detail_transaksi;
class JurnalController extends Controller
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

    public function info($id_transaksi)
    {

        $data = Detail_transaksi::join('account','detail_transaksi.akun_transaksi','=','account.kode_akun')
                                    ->where('transaksi_id', $id_transaksi)
                                    ->select('*')
                                    ->get();

        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['title'] = 'Buat Jurnal Umum';
        $data['akun'] = Account::get();
        return view('jurnal.jurnal_create',$data);
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
            
            'pesan'=>'nullable',
           
        ]);
        
    if($request->status_jurnal == 1){
        $status_jurnal = 'pengeluaran';
    }else{
        $status_jurnal = 'pemasukan';
    }
        $no_transaksi = \Transaksi_helper::generate_nomor_transaksi_jurnal();
        $data_transaksi = array(
            'no_transaksi'=>$no_transaksi,
            'nama_transaksi'=>'Jurnal',
            'pesan'=>$request->pesan,
            'status_transaksi'=>'Jurnal-'.$status_jurnal,
            'tgl_transaksi'=>date('Y-m-d'),
            
        );

        $id_transaksi = Transaksi::insertGetId($data_transaksi);

        
        $arr = array(
            'id_akun' => $request->akun,
            'debit' => $request->debit ,
            'kredit' =>$request->kredit,
            'pesan'=>$request->pesan,
        );


    for($x = 0;$x < count($arr['id_akun']);$x++){
        $detail_transaksi[] = [
           'transaksi_id'=>$id_transaksi,
           'akun_transaksi'=>Account::kodebyid($arr['id_akun'][$x])[0]->kode_akun,
           'debit'=>$arr['debit'][$x],
           'kredit'=>$arr['kredit'][$x],
            ];
    }
        $detail_insert = Detail_transaksi::insert($detail_transaksi);

        if($detail_insert){

            $response = array(
                'status' =>200,
                'message' =>'jurnal berhasil di simpan',
                'id_transaksi'=>$id_transaksi
            );
        }else{

            $response = array(
                'status' =>202,
                'message' =>'Jurnal Gagal Di simpan',
                'id_transaksi' =>NULL
            );

        }

        echo json_encode($response);
        
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
