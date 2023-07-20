@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:120px;">

                    <a class="" href="{{ route('product.index') }}"><i
                            class="fas fa-circle-arrow-left"></i> Produk</a>
                    <div class="mb-3">
                        <h4>Informasi Produk</h4>

                    </div>



                </div>
                <div class="col-12">
                    @if(Session::has('sukses'))
                        <div class="alert alert-success">
                            <a class="close" data-dismiss="alert">×</a>
                            {!!Session::get('sukses')!!}
                        </div>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="ml-4 mt-4 row d-flex justify-content-between">
                            <div class="col-lg-6">
                                <img src="{{ \Helper::get_image_produk($detail->image_produk) }}"
                                    class="rounded img-fluid img-thumbnail mb-3" style="float:left;" width="164px"
                                    height="95px;">
                                <h6 class="ml-3 "
                                    style="margin-:17px; padding-left:160px; padding-bottom:-10px; height:10px;">
                                    <b>{{ $detail->nama_produk }}</b>
                                </h6>
                                <span class="ml-3 badge badge-info">{{ $detail->kode_produk }}</span>

                            </div>
                            <div class="col-lg-6">
                                <div class="row justify-content-end">
                                    <a class="btn btn-outline-info btn-sm mr-4"
                                        href="{{ route('product.edit',$detail->id) }}">Ubah
                                        Produk</a>
                                    <div class="btn-group mr-4">
                                        <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Buat Stok Opname</a>
                                            <a class="dropdown-item" href="#">Arsipkan</a>
                                            <a class="dropdown-item" href="#">Hapus</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-md-9 col-lg-9 ">
                                    <div class="card mt-3 border">
                                        <div class="card-header">
                                            <div class="ml-4 d-flex justify-content-start">
                                                <span class="fa fa-2x fa-box mt-4"></span>
                                                <h6 class=" ml-2" style="margin-top:30px;"><b>Informasi Umum</b>
                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">

                                            <div class="row justify-content-between">
                                                <div class="col-3">
                                                    Harga
                                                </div>
                                                <div class="col-9">
                                                    <b>{{ $detail->harga_beli }}</b>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-between">
                                                <div class="col-3">
                                                    Stok Saat Ini
                                                </div>
                                                <div class="col-9">
                                                    <b>{{ $detail->qty }}</b>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-between">
                                                <div class="col-3">
                                                    Batas Stok Minimum
                                                </div>
                                                <div class="col-9">
                                                    <b>{{ $detail->batas_minimum }}</b><br>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-between">
                                                <div class="col-3">
                                                    Kategori Produk
                                                </div>
                                                <div class="col-9">
                                                    <b>{{ $detail->kategori_produk->nama_kategori }}</b> <br>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-between">
                                                <div class="col-3">
                                                    Keterangan
                                                </div>
                                                <div class="col-9">
                                                    <b>{{ $detail->kategori }}</b> <br>
                                                </div>
                                            </div>
                                            <hr>


                                        </div>
                                    </div>
                                    <div class="card mt-1 border" style="height:500px;">
                                        <div class="card-header" style="height:50px;">
                                            <div class="ml-4 d-flex justify-content-start">
                                               
                                                <h6 class=" ml-2" style="margin-bottom:10px; height:10px;"><b>Transaksi Produk</b>
                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="table">
                                                <table class="table table-striped">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="text-capitalize text-left" style="font-size:small;">Tanggal</th>
                                                            <th class="text-capitalize text-left" style="font-size:small;">Tipe</th>
                                                            <th class="text-capitalize text-left" style="font-size:small;">Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header" style="font-size:large;"><span
                                                class="fas fa-cart-shopping"></span><b> Pembelian</b></div>
                                        <hr>
                                        <div class="card-body">
                                            <small> Harga Beli Satuan</small>
                                            <br>
                                            <b>{{ $detail->harga_beli }}</b>
                                            <br>
                                            <br>
                                            <small>Akun Pembelian</small>
                                            <br>
                                            <a href="" style="color:deepskyblue">{{ $akun_pembelian }}</a>
                                            <br>
                                            <br>
                                            <small>Pajak Beli</small>
                                            <br>
                                            {{ $detail->pajaks_jual->nama_pajak }}
                                        </div>
                                    </div>
                                    <div class="card bg-light mb-3">
                                        <div class="card-header" style="font-size:large;"><span
                                                class="fas fa-tags"></span><b> Penjualan</b></div>
                                        <hr>
                                        <div class="card-body">
                                            <small> Harga Jual Satuan</small>
                                            <br>
                                            <b>{{ $detail->harga_jual }}</b>
                                            <br>
                                            <br>
                                            <small>Akun Penjualan</small>
                                            <br>
                                            <a href="" style="color:deepskyblue">{{ $akun_penjualan }}</a>
                                            <br>
                                            <br>
                                            <small>Pajak Beli</small>
                                            <br>
                                            {{ $detail->pajaks_beli->nama_pajak }}
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
