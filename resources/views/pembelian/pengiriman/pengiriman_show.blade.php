@extends('layout.app', [

])

@section('content')

<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:120px;">

                    <div class="row col-12 justify-content-between">

                        <div class="col-6">
                            <a class="" href="{{ route('pembelian.index') }}"><i
                                    class="fas fa-circle-arrow-left"></i>Transaksi Pembelian</a>
                            <div class="mb-3">
                                <h3 class="" style="color:#0335a1">{{ $transaksi->no_transaksi }}</h3>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <h3>{!! \Transaksi_helper::get_status_name($detail_pengiriman[0]->status_pengiriman) !!}</h3>
                        </div>
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

            <div class="row mt-3 mb-3">
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="tombol-1">
                        <a class="btn btn-dark" href="#">Hapus</a>
                    </div>
                    <div class="tombol-2">
                      

                        <div class="btn-group dropup" role="group">
                            <a class="btn btn-outline-primary" href="{{ route('pembelian.baru') }}">
                                <i class="fas fa-tag"></i> Buat Penagihan
                            </a>
                        </div>

                    </div>
                    <div class="tombol-3">
                        <a class="btn btn-danger" href="#">Kembali</a>
                        <a class="btn btn-success" href="#">Ubah</a>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <table class="table" style="border:none;">
                            <thead style="background-color:#c5f5fa" class="text-capitalize" height="100px">
                                <tr>
                                    <th class="text-capitalize " width="10%">Supplier </th>
                                    <th class="text-capitalize text-left" width="20%"> <a
                                            href="{{ route('kontak.show',$kontak->id) }}">{{ $kontak->nama_panggilan }}</a>
                                    </th>
                                    <th class="text-left text-capitalize" width="10%">Email </th>
                                    <td class="text-left" width="10%">{{ $kontak->email }}</td>
                                    <th class="text-right text-capitalize" width="50%">Total<h3 class=""
                                            style="color:#429ffc">
                                        </h3>
                                        <span style="color:#429ffc; cursor:pointer;"
                                            data-id="{{ $transaksi->id }}" class="jurnal_show">Lihat Jurnal
                                            Entry</span>
                                    </th>
                                </tr>
                            </thead>

                        </table>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p>
                                    Nama Kontak <br> <b>{{ $kontak->nama_kontak }}</b> <br><br>
                                    Email : <br><b>{{ $kontak->email }}</b><br><br>
                                    Handphone : <br><b>{{ $kontak->no_hp }}</b><br><br>
                                    Info Lain : <br> <b>{{ $kontak->info_lain }}</b> <br><br>
                                </p>
                                <p> Identitas <br> <b>{{ $kontak->no_identitas }}</b> <br><br>
                                    Nama Perusahaan : <br> <b>{{ $kontak->nama_perusahaan }}</b> <br><br>
                                    NPWP : <br><b>{{ $kontak->npwp }}</b><br><br>
                                    Alamat : <br><b>{{ $kontak->alamat }}</b><br><br></p>
                                <p>
                                    Jumlah Transaksi <br> <b>{{ $kontak->no_identitas }}</b> <br><br>
                                    Saldo : <br><b>{{ $kontak->saldo }}</b><br><br></p>
                            </div>

                            <div class="">

                                <table class="table" style="border:none;">
                                    <thead style="background-color:#c5f5fa" class="text-capitalize" height="10px">
                                        <tr>
                                            <th class="text-capitalize" style="font-size:small;">Produk</th>
                                            <th class="text-capitalize" style="font-size:small;">Deskripsi</th>
                                            <th class="text-capitalize" style="font-size:small;">Kuantitas</th>
                                            <th class="text-capitalize" style="font-size:small;">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="detail_pembelian">

                                        @foreach($detail_pengiriman as $i)
                                            <tr>
                                                <td><a
                                                        href="{{ route('product.show',$i->product_id) }}">{{ $i->detail_produk->nama_produk }}</a>
                                                </td>
                                                <td>{{ $i->deskripsi }}</td>
                                                <td>{{ $i->jumlah_kirim }}</td>
                                                <td>{{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}
                                                </td>
                                               
                                            </tr>
                                        @endforeach

                                    </tbody>
                                  
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <ul class="nav nav-tabs">
                            <li class="nav-items active" style="border-bottom:2px solid #8ef5f5;"><a
                                    class="nav-link" data-toggle="tab" href="#home">Daftar Penagihan</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="card">

                                    <div>
                                        <div class="card-body">
                                            <table class="table" style="border:none;">
                                                <thead style="background-color:#c5f5fa" class="text-capitalize"
                                                    height="10px">
                                                    <tr>
                                                        <th class="text-capitalize text-primary"
                                                            style="font-size:small;">Tanggal</th>
                                                        <th class="text-capitalize" style="font-size:small;">Nomor</th>
                                                        <th class="text-capitalize" style="font-size:small;">Tgl Jatuh Tempo</th>
                                                        <th class="text-capitalize text-right" style="font-size:small;">
                                                          Jumlah (Dalam IDR)
                                                        </th>
                                                        <th class="text-capitalize text-right" style="font-size:small;">
                                                         Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="detail_pembayaran">

                                                    @if(empty($detail_penagihan))
                                                        <tr>
                                                            <td colspan="6">
                                                                <center><span class="badge badge-danger"> Data
                                                                        Penagihan kosong
                                                                    </span></center>
                                                            </td>
                                                        </tr>
                                                    @else

                                                        @foreach($detail_penagihan as $i)
                                                            <tr>
                                                                <td>{{ $i->created_at }}</td>
                                                                <td><a class="nav-widget"
                                                                        href="{{ route('pembayaran.show',$i->id) }}">{{ $i->uid_pembayaran }}</a>
                                                                </td>
                                                                <td>{{ $akun_kredit[0]->nama_akun }}</td>
                                                                <td>{{ $i->metode_pembayaran }}</td>
                                                                <td class="text-right"><span
                                                                        class="badge badge-success">Lunas</span></td>
                                                                <td class="text-right">
                                                                    {{ \Helper::rupiah($i->jumlah_pembayaran) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>


        </div>

        @include('pembelian.modal.modal_jurnal_pengiriman');
        @endsection
        @push('custom-scripts')
            @include('pembelian.js.show_js');
        @endpush
