@extends('layout.app', [

])

@section('content')
<div class="content-wrapper mt-4">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Laporan</b></h5>
                        </div>

                        <a class=" btn btn-info pt-2" href="#">
                            <i class="nc-icon nc-simple-add"></i>
                            Tindakan

                        </a>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <ul class="nav nav-tabs">
                            <li class="nav-items active" style="border-bottom:2px solid #8ef5f5;"><a class="nav-link "
                                    data-toggle="tab" href="#home">Sekilas Bisnis</a></li>
                            <li class="nav-items"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu_penjualan">Penjualan</a></li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu_pembelian">Pembelian</a></li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu_produk">Produk</a></li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu_aset">Aset</a></li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu_bank">Bank</a></li>


                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="card">

                                    <div class="row mt-4 ml-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info h2">Neraca
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilan apa yang anda miliki
                                                                (aset), apa yang anda hutang (liabilitas), dan apa yang
                                                                anda sudah investasikan pada perusahaan anda (ekuitas).
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Buku Besar
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Laporan ini menampilkan semua
                                                                transaksi yang telah dilakukan untuk suatu periode.
                                                                Laporan ini bermanfaat jika Anda memerlukan daftar
                                                                kronologis untuk semua transaksi .</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title">Laporan Laba Rugi
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan setiap tipe transaksi
                                                                dan jumlah total untuk pendapatan dan pengeluaran anda.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title">Jurnal
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                                Daftar semua jurnal per transaksi yang terjadi dalam
                                                                periode waktu. Hal ini berguna untuk melacak di mana
                                                                transaksi Anda masuk ke masing-masing rekening
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title">Arus Kas
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                                Laporan ini mengukur kas yang telah dihasilkan atau
                                                                digunakan oleh suatu perusahaan dan menunjukkan detail
                                                                pergerakannya dalam suatu periode.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title">Trial Balance
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                                Menampilkan saldo dari setiap akun, termasuk saldo awal,
                                                                pergerakan, dan saldo akhir dari periode yang
                                                                ditentukan.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div id="menu_penjualan" class="tab-pane fade">
                                <div class="card">

                                    <div class="row mt-4 ml-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Daftar Penjualan
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menunjukkan daftar kronologis dari
                                                                semua faktur, pemesanan, penawaran, dan pembayaran Anda
                                                                untuk rentang tanggal yang dipilih.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">penjualan per Pelanggan
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan setiap transaksi
                                                                penjualan untuk setiap pelanggan, termasuk tanggal,
                                                                tipe, jumlah dan total.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Laporan Piutang
                                                                    Pelanggan
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan tagihan yang belum
                                                                dibayar untuk setiap pelanggan, termasuk nomor & tanggal
                                                                faktur, tanggal jatuh tempo, jumlah nilai, dan sisa
                                                                tagihan yang terhutang pada Anda.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Penjualan Per Produk
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                                Menampilkan daftar kuantitas penjualan per produk,
                                                                termasuk jumlah retur, net penjualan, dan harga
                                                                penjualan rata-rata.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                            <div id="menu_pembelian" class="tab-pane fade">
                                <div class="card">

                                    <div class="row mt-4 ml-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Daftar Pembelian
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menunjukkan daftar kronologis dari semua pembelian, pemesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Pembelian Per Supplier
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan setiap pembelian dan jumlah untuk setiap Supplier.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Laporan Hutang
                                                                    Supplier
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan setiap pembelian dan jumlah untuk setiap Supplier.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Daftar Pengeluaran
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                            Daftar seluruh pengeluaran dengan keterangannya untuk kurung waktu yg ditentukan.


                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>

                            <div id="menu_produk" class="tab-pane fade">
                                <div class="card">

                                    <div class="row mt-4 ml-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Ringkasan Persediaan Barang
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Menampilkan daftar kuantitas dan nilai seluruh barang persediaan per tanggal yg ditentukan
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Nilai Persediaan barang
                                                                    <p><br>
                                                            </div>
                                                            <p class="card-category">Rangkuman informasi penting seperti sisa stok yg tersedia, nilai, dan biaya rata-rata, untuk setiap barang persediaan.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Kuantitas Stok Gudang
                                                                
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">Laporan ini menampilkan kuantitas stok di setiap gudang untuk semua produk.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12">
                                                            <div class="numbers d-flex justify-content-start">
                                                                <p class="card-title text-info">Rincian Persediaan Barang
                                                                    <p><br>


                                                            </div>
                                                            <p class="card-category">
                                                            Menampilkan daftar transaksi yg terkait dengan setiap Barang dan Jasa, dan menjelaskan bagaimana transaksi tersebut mempengaruhi jumlah stok barang, nilai, dan harga biaya nya.


                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-start">

                                                        <a class="  btn btn-outline-info" data-toggle="tooltip"
                                                            data-placement="top" title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i> Lihat Laporan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@push('scripts')
    <script>

    </script>
@endpush
