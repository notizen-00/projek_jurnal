<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Kategori_akun;
use App\Events\WidgetGenerate;
use Illuminate\Support\Facades\DB;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['account'] = Account::datawithsaldo(); 

    // dd(Account::datawithsaldo());
        $url = route('account.index');
        $data_event = [
            'nama_widget'=>'account',
            'url_widget'=>$url,
            'status_widget'=>'1'
        ];
        event(new WidgetGenerate($data_event));    
        return view('account.account_index',$data);
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

     public function info($id)
     {

        $data = Account::findOrFail($id);
        echo json_encode($data);
     }
    public function show($id)
    {   

        // $akun = Account::findOrfail($id);
        $akun = Account::with('kategori_akun')->where('id',$id)->get();
        $kode_akun = $akun[0]->kode_akun;
        $data['data_akun'] = $akun;
        $data['detail_akun'] = Account::detailaccount($kode_akun);
        return view('account.account_show',$data);
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
