<?php

use Illuminate\Support\Facades\Route;
use App\Events\HelloEvent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	
    return redirect()->route('home');
});

Route::get('/send-event',function(){

	broadcast(new HelloEvent());
});

Route::get('/iframe', function () {
    return view('layout.page_templates.iframe');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth','scheme'=>'https'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);



	Route::get('penjualan/datatable','App\Http\Controllers\PenjualanController@datatable');


	Route::get('penjualan/baru', ['as' => 'penjualan.baru', 'uses' => 'App\Http\Controllers\PenjualanController@baru']);
	Route::get('penjualan/retur/{id?}','App\Http\Controllers\PenjualanController@retur_index');
	Route::post('penjualan/retur_store','App\Http\Controllers\PenjualanController@retur_store');
	Route::get('penjualan/retur_show/{id}','App\Http\Controllers\PenjualanController@retur_show');
	Route::post('pembayaran/penjualan','App\Http\Controllers\PenjualanController@pembayaran_store')->name('pembayaran_penjualan.store');
	Route::get('pembayaran_penjualan/{id}','App\Http\Controllers\PenjualanController@pembayaran_penjualan')->name('pembayaran_penjualan.baru');
	Route::get('penjualan/{id}/retur','App\Http\Controllers\PenjualanController@penjualan_retur')->name('penjualan.retur');
	Route::get('penjualan/pembayaran/new','App\Http\Controllers\PenjualanController@pembayaran_new')->name('pembayaran_penjualan.new');
	Route::get('penjualan/pembayaran/list','App\Http\Controllers\PenjualanController@pembayaran_penjualan_list')->name('pembayaran_penjualan.list');
	Route::get('penjualan/pembayaran/data','App\Http\Controllers\PenjualanController@pembayaran_penjualan_data')->name('pembayaran_penjualan.data');
	Route::get('penjualan/retur/list','App\Http\Controllers\PenjualanController@retur_list')->name('retur_penjualan.list');
	Route::get('penjualan/retur/data','App\Http\Controllers\PenjualanController@retur_data')->name('retur_penjualan.data');
	Route::resource('penjualan','App\Http\Controllers\PenjualanController');
	
	Route::resource('komisi','App\Http\Controllers\KomisiController');



	Route::get('pembelian/datatable','App\Http\Controllers\Pembelian\PembelianController@datatable');

	Route::get('pembelian/reset','App\Http\Controllers\Pembelian\PembelianController@reset_pembelian')->name('pembelian.reset');
	Route::get('pembelian/get_data', ['as' => 'pembelian.get_data', 'uses' => 'App\Http\Controllers\Pembelian\PembelianController@get_data']);
	Route::get('pembelian/baru', ['as' => 'pembelian.baru', 'uses' => 'App\Http\Controllers\Pembelian\PembelianController@baru']);
	Route::get('pembelian/retur/new','App\Http\Controllers\Pembelian\PembelianController@retur_new')->name('pembelian_retur.new');
	Route::get('pembelian/retur/{id}','App\Http\Controllers\Pembelian\PembelianController@retur_index');
	Route::post('pembelian/retur_store','App\Http\Controllers\Pembelian\PembelianController@retur_store');
	Route::get('pembelian/retur_show/{id}','App\Http\Controllers\Pembelian\PembelianController@retur_show')->name('pembelian_retur.show');
	Route::get('pembelian/retur/list','App\Http\Controllers\Pembelian\PembelianController@retur_list')->name('retur.list');
	Route::get('pembelian/retur/data','App\Http\Controllers\Pembelian\PembelianController@retur_data')->name('retur.data');
	Route::get('pembelian/memo_show/{id}','App\Http\Controllers\Pembelian\PembelianController@memo_show')->name('pembelian_memo.show');

	// Route::post('pembelian/pembayaran/new','App\Http\Controllers\PembelianController@pembayaran_store')->name('pembayaran_pembelian.store');
	Route::get('pembelian/pembayaran/new','App\Http\Controllers\Pembelian\PembelianController@pembayaran_new')->name('pembayaran_pembelian.new');
	Route::get('pembayaran_pembelian/{id}','App\Http\Controllers\Pembelian\PembelianController@pembayaran_pembelian')->name('pembayaran_pembelian.baru');
	Route::post('pembayaran/pembelian','App\Http\Controllers\Pembelian\PembelianController@pembayaran_store')->name('pembayaran.store');
	Route::get('pembayaran/{id}','App\Http\Controllers\Pembelian\PembelianController@pembayaran_show')->name('pembayaran.show');
	Route::get('pembayaran/data','App\Http\Controllers\Pembelian\PembelianController@pembayaran_data')->name('pembayaran.data');
	Route::get('pembayaran/{id}/edit','App\Http\Controllers\Pembelian\PembelianController@pembayaran_edit')->name('pembayaran.edit');
	Route::get('pembelian/pembayaran/list','App\Http\Controllers\Pembelian\PembelianController@pembayaran_list')->name('pembayaran.list');

	Route::get('pembelian/penagihan/{id_pengiriman}','App\Http\Controllers\Pembelian\PembelianController@penagihan_baru')->name('pembelian_penagihan.baru');
	Route::resource('pembelian','App\Http\Controllers\Pembelian\PembelianController');
	

	Route::get('pembelian/pemesanan/datatable','App\Http\Controllers\Pembelian\PemesananController@datatable');
	Route::post('pembelian/pemesanan/show_dp/{id_pembayaran}','App\Http\Controllers\Pembelian\PemesananController@store_dp')->name('pembelian_pemesanan.show_dp');
	Route::post('pembelian/pemesanan/dp','App\Http\Controllers\Pembelian\PemesananController@store_dp')->name('pembelian_pemesanan.store_dp');
	Route::get('pembelian/pemesanan/dp/{id_pemesanan}','App\Http\Controllers\Pembelian\PemesananController@create_dp')->name('pembelian_pemesanan.create_dp');
	Route::resource('pembelian_pemesanan','App\Http\Controllers\Pembelian\PemesananController');

	Route::get('pembelian/pengiriman/new/{id}','App\Http\Controllers\Pembelian\PengirimanController@new')->name('pembelian_pengiriman.new');
	Route::get('pembelian/pengiriman/datatable','App\Http\Controllers\Pembelian\PengirimanController@datatable');
	Route::resource('pembelian_pengiriman','App\Http\Controllers\Pembelian\PengirimanController');

	Route::resource('pembelian_penagihan','App\Http\Controllers\Pembelian\PenagihanController');

	

	Route::resource('pengaturan','App\Http\Controllers\PengaturanController');
	Route::resource('pengeluaran','App\Http\Controllers\PengeluaranController');
	Route::resource('unit','App\Http\Controllers\UnitController');
	Route::resource('kategori','App\Http\Controllers\KategoriController');
	Route::get('kontak/info/{id}','App\Http\Controllers\ContacsController@info')->name('kontak.info');
	Route::resource('kontak','App\Http\Controllers\ContacsController');

	Route::get('produk_bundle/get_data','App\Http\Controllers\ProductController@getDataBundle')->name('product_get.bundle');
	Route::get('produk/info/{id}/{status}','App\Http\Controllers\ProductController@info')->name('product.info');
	Route::resource('product','App\Http\Controllers\ProductController');

	Route::resource('kas','App\Http\Controllers\KasController');
	Route::get('account/info/{id}','App\Http\Controllers\AccountController@info')->name('account.info');
	Route::resource('account','App\Http\Controllers\AccountController');
	Route::resource('laporan','App\Http\Controllers\LaporanController');
	Route::get('gudang/detail/{id}','App\Http\Controllers\GudangController@detail');
	Route::get('gudang/info_product/{product_id}/{gudang_id}','App\Http\Controllers\GudangController@info_product');
	// Route::post('gudang/info_prodct','App\Http\Controllers\GudangController')
	Route::resource('gudang','App\Http\Controllers\GudangController');

	Route::get('jurnal/show/{id}','App\Http\Controllers\JurnalController@info');
	Route::resource('jurnal','App\Http\Controllers\JurnalController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	//REST 
	Route::get('ajax/get_data', 'App\Http\Controllers\RestController@getData')->name('chart.product');

	Route::post('ajax/data_transaksi', 'App\Http\Controllers\RestController@data_transaksi_search')->name('ajax.transaksi');
	Route::post('ajax/penjualan/data_transaksi', 'App\Http\Controllers\RestController@data_penjualan_search')->name('ajax.transaksi_penjualan');
	Route::post('ajax/get/data_transaksi', 'App\Http\Controllers\RestController@getDataTransaksi')->name('ajax_get.transaksi');
	Route::post('ajax/get_penjualan/data_transaksi', 'App\Http\Controllers\RestController@getDataPenjualan')->name('ajax_get.penjualan');

	Route::get('ajax/data_product', 'App\Http\Controllers\RestController@data_product_search')->name('ajax.product');
	Route::post('ajax/get/data_product', 'App\Http\Controllers\RestController@getDataProduct')->name('ajax_get.product');
	Route::get('ajax/produk_bundle/modal/{id}','App\Http\Controllers\RestController@getDataModalBundle')->name('ajax_modal.bundle');

	Route::get('ajax/data_retur', 'App\Http\Controllers\RestController@data_retur_search')->name('ajax.retur');
	Route::post('ajax/data_retur/get', 'App\Http\Controllers\RestController@getApiRetur')->name('ajax_data.retur');
	Route::post('ajax/get/data_retur', 'App\Http\Controllers\RestController@getDataRetur')->name('ajax_get.retur');
	
	// Route::get('data/{name}/{argh?}/{column?}','App\Http\Controllers\RestController@get_data')->name('rest.data');
	Route::get('cetak_pdf/{id}/{status}','App\Http\Controllers\WidgetController@cetak_pdf');
	
	Route::get('widget','App\Http\Controllers\WidgetController@get_content')->name('widget.content');
	Route::post('widget/update','App\Http\Controllers\WidgetController@update_widget')->name('widget.update');

	Route::post('komisi/check','App\Http\Controllers\KomisiController@check');
	Route::get('komisi/detail/{id}','App\Http\Controllers\KomisiController@show');
	
	
});

Route::group(['middleware' => 'auth'], function () {

	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

