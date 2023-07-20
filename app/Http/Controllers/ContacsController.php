<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Session;
use App\Events\WidgetGenerate;
class ContacsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['semua_tipe'] = Kontak::all();
        $data['karyawan'] = Kontak::where('tipe_kontak',3)->get();
        $data['supplier'] = Kontak::where('tipe_kontak',2)->get();
        $data['pelanggan'] = Kontak::where('tipe_kontak',1)->get();
        $url = route('kontak.index');
        $data_event = [
            'nama_widget'=>'kontak',
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));
        return view('kontak.kontak_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kontak.create_kontak');
    }

    public function info($id)
    {
        $data = Kontak::findOrFail($id);
        echo json_encode($data);
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
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|unique:kontak',
            'no_hp' => 'nullable|unique:kontak|min:12',
            'nama_bank'=>'nullable|min:2',
            'nama_kontak'=>'nullable|unique:kontak|min:3',
            'tipe_kontak'=>'required|integer',
            'nama_panggilan'=>'required|max:50',
            'npwp'=>'nullable|integer|min:9',
            'nama_perusahaan'=>'nullable|min:3',
            'no_identitas'=>'nullable|unique:kontak|max:19|min:5',
            'status_kontak'=>'required',
            'no_rekening'=>'nullable|integer',
            'nama_pemegang_rekening'=>'nullable|max:50'
        ]);
       

        $kontak = Kontak::create($request->all());

        if($request->tipe_kontak == 1){

            $tipe_kontak = 'Pelanggan';
        }else if($request->tipe_kontak == 2){
            $tipe_kontak = 'Supplier';
        }else if($request->tipe_kontak == 3){
            $tipe_kontak = 'Karyawan';
        }

        if($kontak){

            Session::flash('sukses','Data Kontak dengan Tipe:'.$tipe_kontak.' Berhasil disimpan');
            return redirect('kontak');
        }else{

            Session::flash('error','Data Kontak Gagal Tersimpan');
            return redirect('kontak.create');
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
        $data['kontak'] = Kontak::findOrFail($id);

        return view('kontak.show_kontak',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['detail'] = Kontak::findOrFail($id);
        return view('kontak.edit_kontak',$data);
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
        $validated = $request->validate([
            'alamat' => 'nullable|max:255',
            'email' => 'nullable',
            'no_hp' => 'nullable|min:12',
            'nama_bank'=>'nullable|min:2',
            'nama_kontak'=>'nullable|min:3',
            'tipe_kontak'=>'required|integer',
            'nama_panggilan'=>'required|max:50',
            'npwp'=>'nullable|integer|min:9',
            'nama_perusahaan'=>'nullable|min:3',
            'no_identitas'=>'nullable|max:19|min:5|integer',
            'status_kontak'=>'required',
            'no_rekening'=>'nullable|integer',
            'nama_pemegang_rekening'=>'nullable|max:50'
        ]);

       
        $update = Kontak::where('id',$id)->update($request->except('_token','_method'));

        if($request->tipe_kontak == 1){

            $tipe_kontak = 'Pelanggan';
        }else if($request->tipe_kontak == 2){
            $tipe_kontak = 'Supplier';
        }else if($request->tipe_kontak == 3){
            $tipe_kontak = 'Karyawan';
        }

        if($update){

            Session::flash('sukses','Data Kontak dengan Tipe:'.$tipe_kontak.' Berhasil diupdate');
            return redirect()->route('kontak.show',$id);
        }else{

            Session::flash('error','Data Kontak Gagal Terupdate');
            return redirect()->route('kontak.edit',$id);
        }


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
