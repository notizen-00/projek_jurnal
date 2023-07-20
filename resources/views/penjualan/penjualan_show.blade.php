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
                                    class="fas fa-circle-arrow-left"></i>Transaksi</a>
                            <div class="mb-3">
                                <h3 class="" style="color:#0335a1">{{ $detail->no_transaksi }}</h3>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <h3>{!! \Transaksi_helper::get_status_name($detail->tipe_penjualan) !!}</h3>
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
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-file"></i> Cetak & lihat
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ url('cetak_pdf/'.$detail->id.'/3') }}"
                                    target="_blank">Lihat Faktur</a>
                                <a class="dropdown-item" href="#">Email Faktur</a>
                            </div>
                        </div>

                        <div class="btn-group dropup" role="group">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-list"></i> Tindakan
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('pembayaran_penjualan.baru',$detail->id) }}"
                                    >Terima Pembayaran</a>
                                <a class="dropdown-item"  href="{{ url('penjualan/retur/'.$detail->id) }}">Retur Penjualan</a>
                            </div>
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
                                    <th class="text-capitalize " width="10%">Pelanggan </th>
                                    <th class="text-capitalize text-left" width="20%"> <a
                                            href="{{ route('kontak.show',$kontak->id) }}">{{ $kontak->nama_panggilan }}</a>
                                    </th>
                                    <th class="text-left text-capitalize" width="10%">Email </th>
                                    <td class="text-left" width="10%">{{ $kontak->email }}</td>
                                    <th class="text-right text-capitalize" width="50%">Total<h3 class=""
                                            style="color:#429ffc">{{ \Helper::rupiah($sisa_tagihan) }}
                                        </h3>
                                        <span style="color:#429ffc; cursor:pointer;" data-id="{{ $detail_transaksi->id }}"
                                            class="jurnal_show">Lihat Jurnal Entry</span>
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
                                            <th class="text-capitalize text-right" style="font-size:small;">Harga Satuan
                                            </th>
                                            <th class="text-capitalize text-left" style="font-size:small;">Diskon</th>
                                            <th class="text-capitalize text-right" style="font-size:small;">jumlah </th>

                                        </tr>
                                    </thead>
                                    <tbody class="detail_penjualan">

                                        @foreach($detail_penjualan as $i)
                                            <tr>
                                                <td><a
                                                        href="{{ route('product.show',$i->product_id) }}">{{ $i->detail_produk->nama_produk }}</a>
                                                </td>
                                                <td>{{ $i->deskripsi }}</td>
                                                <td>{{ $i->qty }}</td>
                                                <td>{{ $i->nama_unit }}</td>
                                                <td class="text-right">{{ \Helper::rupiah($i->harga_satuan) }}
                                                </td>
                                                <td class="text-left">0 % </td>
                                                <td class="text-right"><input type="hidden" class="subtotal_int"
                                                        value="{{ $i->jumlah }}">{{ \Helper::rupiah($i->harga_satuan * $i->qty) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">SubTotal</th>
                                            <td></td>
                                            <td class="text-right"><span class="subtotal"></span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">PPN</th>
                                            <td></td>
                                            <td class="text-right"><span class="pajak">{{ \Helper::rupiah($detail_transaksi->pajak) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">Sudah Dibayar</th>
                                            <td></td>
                                            <td class="text-right">{{ \Helper::rupiah($total_pembayaran) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right"><b>Sisa Tagihan</b></th>
                                            <td></td>
                                            <td class="text-right">{{ \Helper::rupiah($sisa_tagihan) }}</td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a href="#" class="btn btn-link btn-outline-primary text-capitalize" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Daftar Pembayaran
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" style="border:none;">
                                <thead style="background-color:#c5f5fa" class="text-capitalize" height="10px">
                                    <tr>
                                        <th class="text-capitalize text-primary" style="font-size:small;">Tanggal</th>
                                        <th class="text-capitalize" style="font-size:small;">Nomor</th>
                                        <th class="text-capitalize" style="font-size:small;">Setor ke</th>
                                        <th class="text-capitalize" style="font-size:small;">Cara Pembayaran</th>
                                        <th class="text-capitalize text-right" style="font-size:small;">Status Pembayaran
                                        </th>
                                        <th class="text-capitalize text-right" style="font-size:small;">jumlah </th>

                                    </tr>
                                </thead>
                                <tbody class="detail_pembayaran">

                                    @if(empty($detail_pembayaran))
                                    <tr>
                                           <td> <center><span class="badge badge-danger"> Data Pembayaran Masih kosong </span></center></td>
                                    </tr>
                                    @else

                                    @foreach($detail_pembayaran as $i)
                                        <tr>
                                            <td>{{ $i->tanggal_pembayaran }}</td>
                                            <td><a href="{{ route('pembayaran.show',$i->id) }}">{{ $i->uid_pembayaran }}</a></td>
                                            <td>{{ $akun_kredit[0]->nama_akun }}</td>
                                            <td>{{ $i->metode_pembayaran }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ \Helper::rupiah($i->jumlah_pembayaran) }}</td>
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
        @include('penjualan.modal.modal_jurnal');
        @endsection
        @push('custom-scripts')
        @include('penjualan.js.show_js');
        @endpush