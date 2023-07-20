<?php

namespace App\Http\Controllers;

use App\Models\Account;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['title'] = "Dashboard";
        // $data['total_saldo'] = Account::getsaldokas();
        return view('layout.app-frame',$data);
    }
}
