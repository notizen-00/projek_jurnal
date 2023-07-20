<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class PageController extends Controller
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
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {   
        $data['title'] = "Halaman ".$page;
        if (view()->exists("pages.{$page}")) {

            $data['total_saldo'] = Account::getsaldo('1-10001');
            $data['total_persediaan_barang'] = abs(round(Account::getsaldo('1-10200'),2));
            return view("pages.{$page}",$data);
        }

        return abort(404);
    }
}
