<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Komisi;
use App\Services\KomisiServices;
use App\Models\Kontak;
class KomisiController extends Controller
{

    protected $KomisiServices;

    public function __construct(KomisiServices $KomisiServices)
    {
        $this->KomisiServices = $KomisiServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        // $barang = $request->barang;
     
        $data = [
            'periode'=>date('Y-m-d'),
            'barang'=>$request->nama_produk,
            'pamasok'=>'valid',
            'sales'=>$request->id_karyawan
        ];

        $result_komisi = $this->KomisiServices->checkKomisi($data);
        $response = [
            'data_komisi'=>$result_komisi,
            'data_karyawan'=>Kontak::getnamakontak($request->id_karyawan),
            
        ];
        echo json_encode($response);
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
        $validator = Validator::make($request->all(), [
            'nama_komisi' => 'required',
            'rule_periode'=>'required|in:1,2',
            'periode_mulai'=>'nullable|required_if:rule_periode,2',
            'periode_akhir'=>'nullable|required_if:rule_periode,2',
            'rule_sales'=>'required|in:1,2',
            'tenaga_tertentu'=>'nullable|required_if:rule_sales,2',
            'rule_penjualanke'=>'required',
            'rule_barang'=>'required|in:1,2',
            'barang_tertentu'=>'nullable|required_if:rule_barang,2',
            'rule_pemasok'=>'required|in:1,2',
            'pemasok_tertentu'=>'nullable|required_if:rule_pemasok,2',
            'rule_syarat_perhitungan'=>'required|in:1,2,3',
            'rule_sp_2.*'=>'nullable|required_if:rule_syarat_perhitungan,2',
            'rule_sp_3.*'=>'nullable|required_if:rule_syarat_perhitungan,3'


        ],[
            'nama_komisi.required' => 'nama komisi tidak boleh kosong',
            'periode_start.required_if' => 'periode mulai wajib di isi',
            'periode_end.required_if'=>'periode akhir wajib di isi',
            'rule_sp_2.*.required_if'=>'nilai penjualan antara harus di isi semua',
            'rule_sp_3.*.required_if'=>'kuantitas penjualan antara harus di isi semua'
        ]);

      
        //jika rule_komisi 1 maka setting komisi nya nilai tetap dan setting komisi
        //dan setting komisi jika 1 nilainya PerFaktur jika 2 Per Kuantitas Barang

        //jika rule_komisi 2 maka berupa persentase 
        //setting komisi jika 1 persentase dari penilaian penjualan
        //setting komisi jika 2 persentase dari laba kotor 
        
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }


        $rule_periode[] = [
              'rule_periode'=>$request->rule_periode,
              'periode_mulai'=>$request->periode_mulai,
              'periode_akhir'=>$request->periode_akhir
        ]; 

        $data_rule_periode = serialize($rule_periode);

        $rule_sales[] = [
                'rule_sales'=>$request->rule_sales,
                'tenaga_tertentu'=>$request->tenaga_tertentu
        ];

        $data_rule_sales = serialize($rule_sales);

        $rule_penjualanke[] =[
                'rule_penjualanke' => $request->rule_penjualanke
        ]; 

        $data_rule_penjualanke = serialize($rule_penjualanke);
    
        $rule_barang[] = [
                'rule_barang' => $request->rule_barang,
                'barang_tertentu'=>$request->barang_tertentu
        ];
        $data_rule_barang = serialize($rule_barang);

        $rule_pemasok[] = [
                'rule_pemasok'=>$request->rule_pemasok,
                'pemasok_tertentu'=>$request->pemasok_tertentu
        ];
        $data_rule_pemasok = serialize($rule_pemasok);

        $rule_syarat_perhitungan[] = [
                'rule_syarat_perhitungan'=>$request->rule_syarat_perhitungan,
                'rule_sp_2'=>$request->rule_sp_2,
                'rule_sp_3'=>$request->rule_sp_3
        ];

        $data_rule_syarat_perhitungan = serialize($rule_syarat_perhitungan);
        
        $rule_komisi[] = [
                'opsi_komisi'=>$request->opsi_komisi,
                'rule_komisi'=>$request->rule_komisi,
                'setting_komisi'=>$request->setting_komisi
        ];
        $data_rule_komisi = serialize($rule_komisi);
        

        $data_komisi = [
                'rules_periode'=>$data_rule_periode,
                'rules_supplier'=>$data_rule_pemasok,
                'rules_sales'=>$data_rule_sales,
                'rules_barang'=>$data_rule_barang,
                'nama_komisi'=>$request->nama_komisi,
                'rules_perhitungan_id'=>$data_rule_penjualanke,
                'rules_komisi'=>$data_rule_komisi,
                'status'=>0
        ];

       $insert_komisi = Komisi::insert($data_komisi);
        
       if($insert_komisi){
        
           $response = [
                'url'=>'pengaturan',
                'response'=>'sukses'
           ];

           echo json_encode($response);
       }else{

        return  redirect()->route('pengaturan.index')->with('error', 'Data Komisi Gagal di simpan');
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

        $data = $this->KomisiServices->getDataDetail($id);

        return json_encode($data);

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
