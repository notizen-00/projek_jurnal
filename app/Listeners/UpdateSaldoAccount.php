<?php

namespace App\Listeners;

use App\Events\ProsesTransaksi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Account;
use DB;
class UpdateSaldoAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProsesTransaksi  $event
     * @return void
     */
    public function handle(ProsesTransaksi $event)
    {
    
                $status_transaksi = $event->data_proses['status_transaksi'];

                if($status_transaksi == 'faktur_pembelian'){

                    $akun_kredit = $event->data_proses['akun_transaksi_kredit'];
                    $akun_debit = $event->data_proses['akun_transaksi_debit'];
                   
                    $total = $event->data_proses['total'];
                    $saldo_kredit = \Transaksi_helper::get_saldo_transaksi_kredit($akun_kredit,$total,$status_transaksi,$status_transaksi);
                    $saldo_debit = \Transaksi_helper::get_saldo_transaksi_debit($akun_debit,$total,$status_transaksi,$status_transaksi);
                    $kategori_kredit = Account::where('kode_akun',$akun_kredit)->get();
                    $nama_akun_kredit = $kategori_kredit[0]->nama_akun;
                    $kategori_debit = Account::where('kode_akun',$akun_debit)->get();
                    $nama_akun_debit = $kategori_debit[0]->nama_akun;
                   
                
                    $data_proses = [
                            [
                            'kode_akun'=>$akun_kredit,
                            'saldo'=>$saldo_kredit,
                            'nama_akun'=>$nama_akun_kredit,
                            ],
                            [
                            'kode_akun'=>$akun_debit,
                            'saldo'=>$saldo_debit, 
                            'nama_akun'=>$nama_akun_debit,
                            ]                        
                    ];
                  
                //    $data_handle =  Account::upsert($data_proses,['kode_akun','nama_akun'],['saldo']);
                    
                //    return $data_handle;

                    
                }
             
         
    }
}
