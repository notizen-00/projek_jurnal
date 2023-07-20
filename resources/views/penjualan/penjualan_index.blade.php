@extends('layout.app', [

])

@section('content')
<div class="content-wrapper mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5><b>Penjualan</b></h5>

                            <nav class="navbar navbar-expand-lg navbar-transparent">
                                <ul class="navbar-nav">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary">Tindakan</button>
                                        <button type="button"
                                            class="btn btn-outline-primary dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item"
                                                href="{{ url('penjualan/baru') }}">Tambah
                                                penjualan</a>
                                            <a class="dropdown-item create_komisi" href="">Buat Komisi Penjualan</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:moccasin">
                                    <div class="d-flex justify-content-between">
                                        <b>Penjualan belum dibayar</b>


                                        <span class="badge bg-warning pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b>{{ \Helper::rupiah($penjualan_belum_bayar) }}</b></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:mistyrose;">
                                    <div class="d-flex justify-content-between">
                                        <b>Penjualan jatuh tempo</b>


                                        <span class="badge bg-danger pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b>Rp.0</b></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:palegreen">
                                    <div class="d-flex justify-content-between">
                                        <b>Pelunasan diterima 30 hari terakhir</b>


                                        <span class="badge bg-success pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b>{{ \Helper::rupiah($penjualan_lunas) }}</b></h2>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">

                                <div class="row d-flex justify-content-end">
                                    <div class="form-group mt-3 col-2">

                                        <a class="btn btn-outline-primary nav-widget mr-1"
                                            href="{{ route('pembayaran_penjualan.list') }}"
                                            data-id="00" data-transaksi="<i class='fas fa-list'></i> Pembayaran"> List
                                            Pembayaran</a>

                                        <a class="btn btn-outline-primary nav-widget mr-1"
                                            href="{{ route('retur_penjualan.list') }}" data-id="01"
                                            data-transaksi="<i class='fas fa-list'></i> Retur">List Retur</a>


                                    </div>

                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="nav-items active"><a class="nav-link active btn-outline-info"
                                            data-toggle="tab" href="#home">Faktur Penjualan</a></li>
                                    <!-- <li class="nav-items active"><a class="nav-link btn-outline-info"
                                            data-toggle="tab" href="#komisi_penjualan">Komisi Penjualan</a></li> -->

                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        <div class="card">
                                            <div class="d-flex justify-content-start">
                                                <div class="form-group mt-3 col-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="filter_range"
                                                            class="form-control float-right" id="reservation">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                {!! Form::select('Status', [' '=>'-- Pilih Status --','1' => 'Open', '2'
                                                =>
                                                'Overdue','3'=>'Paid'],'size',['class'=>'form-control mt-3 col-2 ml-2'])
                                                !!}
                                            </div>

                                            <div class="table-responsive table-striped mt-3">
                                                <table class="table table-striped table-penjualan">
                                                    <thead class="text-capitalize" style="background-color:mintcream">
                                                        <th class="text-capitalize">
                                                            Tanggal
                                                        </th>
                                                        <th class="text-capitalize">
                                                            No.
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Pelanggan
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Tgl.jatuh tempo
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Status
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Sisa Tagihan
                                                        </th>
                                                        <th class="text-capitalize" style="width:20%;">
                                                            total
                                                        </th>
                                                        <th class="text-capitalize">
                                                            tag
                                                        </th>

                                                    </thead>

                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="6" style="text-align:right">Total:</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="komisi_penjualan" class="tab-pane fade">
                                        <div class="card">
                                            <div class="d-flex justify-content-start">

                                            </div>

                                            <div class="table-responsive table-striped mt-3">
                                                <table class="table table-striped table-komisi">
                                                    <thead class="text-capitalize" style="background-color:mintcream">
                                                        <th class="text-capitalize">
                                                            ID
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Nama Komisi
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Berlaku
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Catatan
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Status
                                                        </th>
                                                        <th class="text-capitalize">
                                                            Tanggal Di Buat
                                                        </th>
                                                    </thead>
                                                    @if(empty($komisi))
                                                        <tbody style="background-color:white;">

                                                        </tbody>
                                                    @else
                                                        <tbody>
                                                            @foreach($komisi as $i)
                                                                <tr>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                    <td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    @endif
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
        @include('penjualan.modal.create_komisi');
        @endsection

        @push('custom-scripts')
            @include('penjualan.js.penjualan_index_js');
            @include('penjualan.js.penjualan_komisi_js');

        @endpush
