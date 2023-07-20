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
                                <h3 class="" style="color:#0335a1">{{ $detail->no_transaksi }}</h3>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <h3>{!! \Transaksi_helper::get_status_name($detail->status_pembelian) !!}</h3>
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
                                    href="{{ url('cetak_pdf/'.$detail->id.'/1') }}"
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
                                    href="{{ route('pembayaran_pembelian.baru',$detail->id) }}">Kirim
                                    Pembayaran</a>
                                <a class="dropdown-item"
                                    href="{{ url('pembelian/retur/'.$detail->id) }}">Retur
                                    Pembelian</a>
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
                                    <th class="text-capitalize " width="10%">Supplier </th>
                                    <th class="text-capitalize text-left" width="20%"> <a
                                            href="{{ route('kontak.show',$kontak->id) }}">{{ $kontak->nama_panggilan }}</a>
                                    </th>
                                    <th class="text-left text-capitalize" width="10%">Email </th>
                                    <td class="text-left" width="10%">{{ $kontak->email }}</td>
                                    <th class="text-right text-capitalize" width="50%">Total<h3 class=""
                                            style="color:#429ffc">{{ \Helper::rupiah($detail->sisa_tagihan) }}
                                        </h3>
                                        <span style="color:#429ffc; cursor:pointer;"
                                            data-id="{{ $detail_transaksi->id }}" class="jurnal_show">Lihat Jurnal
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
                                            <th class="text-capitalize text-right" style="font-size:small;">Harga Satuan
                                            </th>
                                            <th class="text-capitalize text-left" style="font-size:small;">Pajak</th>

                                            <th class="text-capitalize text-right" style="font-size:small;">jumlah </th>

                                        </tr>
                                    </thead>
                                    <tbody class="detail_pembelian">

                                        @foreach($detail_pembelian as $i)
                                            <tr>
                                                <td><a
                                                        href="{{ route('product.show',$i->product_id) }}">{{ $i->detail_produk->nama_produk }}</a>
                                                </td>
                                                <td>{{ $i->deskripsi }}</td>
                                                <td>{{ $i->qty }}</td>
                                                <td>{{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}
                                                </td>
                                                <td class="text-right">{{ \Helper::rupiah($i->harga_satuan) }}
                                                </td>
                                                <td class="text-left">{{ $i->pajak_id }}</td>
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
                                            <th class="text-right">
                                                {{ \Transaksi_helper::get_status_pajak($detail->pajak) }}</th>
                                            <td></td>
                                            <td class="text-right"><span
                                                    class="pajak">{{ \Helper::rupiah($detail_transaksi->pajak) }}</span>
                                            </td>
                                        </tr>

                                        @if(empty($data_retur[0]->uid_retur))

                                        @else
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th class="text-right">Total Retur Pembelian</th>
                                                <td></td>
                                                <td class="text-right"><span
                                                        class="retur_pembelian">{{ \Helper::rupiah($total_retur) }}</span>
                                                </td>
                                            </tr>
                                        @endif
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

                                        @if(empty($data_memo[0]->uid_memo))

                                        @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right">Total Debit Memo</th>
                                            <td></td>
                                            <td class="text-right"><span
                                                    class="retur_pembelian">{{ \Helper::rupiah(abs($total_memo)) }}</span>
                                            </td>
                                        </tr>
                                        @endif

                                    </tfoot>
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
                                    class="nav-link active" data-toggle="tab" href="#home">Daftar Pembayaran</a></li>
                            <li class="nav-items"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu1">Daftar Retur</a></li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu2">Daftar Memo</a></li>
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
                                                        <th class="text-capitalize" style="font-size:small;">Bayar Dari
                                                        </th>
                                                        <th class="text-capitalize" style="font-size:small;">Cara
                                                            Pembayaran</th>
                                                        <th class="text-capitalize text-right" style="font-size:small;">
                                                            Status
                                                            Pembayaran
                                                        </th>
                                                        <th class="text-capitalize text-right" style="font-size:small;">
                                                            jumlah </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="detail_pembayaran">

                                                    @if(empty($detail_pembayaran[0]->uid_pembayaran))
                                                        <tr>
                                                            <td colspan="6">
                                                                <center><span class="badge badge-danger"> Data
                                                                        Pembayaran kosong
                                                                    </span></center>
                                                            </td>
                                                        </tr>
                                                    @else

                                                        @foreach($detail_pembayaran as $i)
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

                            <div id="menu1" class="tab-pane ">
                                <div class="card-body">
                                    <table class="table" style="border:none;">
                                        <thead style="background-color:#c5f5fa" class="text-capitalize" height="10px">
                                            <tr>
                                                <th class="text-capitalize text-primary" style="font-size:small;">
                                                    Tanggal</th>
                                                <th class="text-capitalize" style="font-size:small;">Nomor</th>
                                                <th class="text-capitalize" style="font-size:small;">Deskripsi
                                                </th>
                                                <th class="text-capitalize" style="font-size:small;">Status</th>
                                                <th class="text-capitalize text-right" style="font-size:small;">
                                                    jumlah </th>

                                            </tr>
                                        </thead>
                                        <tbody class="detail_retur">

                                            @if(empty($data_retur[0]->uid_retur))
                                                <tr>
                                                    <td colspan="5">
                                                        <center><span class="badge badge-danger"> Data
                                                                Retur kosong
                                                            </span></center>
                                                    </td>

                                                </tr>
                                            @else

                                                @foreach($data_retur as $i)
                                                    <tr>
                                                        <td>{{ $i->created_at }}</td>
                                                        <td><a class="nav-link"
                                                                href="{{ route('pembelian_retur.show',$i->id) }}">{{ $i->uid_retur }}</a>
                                                        </td>
                                                        <td class="text-center">{{ $i->no_transaksi }}</td>
                                                        <td><span class="badge badge-success">Selesai</span>
                                                        </td>
                                                        <td class="text-right">
                                                            {{ \Helper::rupiah($i->jumlah_transaksi) }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="menu2" class="tab-pane ">
                                <div class="card-body">
                                    <table class="table" style="border:none;">
                                        <thead style="background-color:#c5f5fa" class="text-capitalize" height="10px">
                                            <tr>
                                                <th class="text-capitalize text-primary" style="font-size:small;">
                                                    Tanggal</th>
                                                <th class="text-capitalize" style="font-size:small;">Nomor</th>
                                                <th class="text-capitalize" style="font-size:small;">Deskripsi
                                                </th>
                                                <th class="text-capitalize" style="font-size:small;">Status</th>
                                                <th class="text-capitalize text-right" style="font-size:small;">
                                                    jumlah </th>

                                            </tr>
                                        </thead>
                                        <tbody class="detail_memo">

                                            @if(empty($data_memo[0]->uid_memo))
                                                <tr>
                                                    <td colspan="5">
                                                        <center><span class="badge badge-danger"> Data
                                                                Memo kosong
                                                            </span></center>
                                                    </td>

                                                </tr>
                                            @else

                                                @foreach($data_memo as $i)
                                                    <tr>
                                                        <td>{{ $i->tanggal_pembayaran }}</td>
                                                        <td><a class="nav-link"
                                                                href="{{ route('pembelian_memo.show',$i->id) }}">{{ $i->uid_memo }}</a>
                                                        </td>
                                                        <td class="text-center">{{ $i->nomor_transaksi }}</td>
                                                        <td><span class="badge badge-success">Selesai</span>
                                                        </td>
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

        @include('pembelian.modal.modal_jurnal');
        @endsection
        @push('custom-scripts')
            @include('pembelian.js.show_js');
        @endpush
