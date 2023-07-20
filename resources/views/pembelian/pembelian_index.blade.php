@extends('layout.app', [

])

@section('content')

<div class="content-wrapper mt-4">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>

                                    <h5><b>Pembelian</b>
                                    </h5>
                                </div>

                                <div class="btn-group mr-3">

                                    <a href="{{ route('pembelian.index') }}"
                                        class="btn btn-outline-info" data-toggle="tooltip" title="perbarui data"
                                        data-position="top"> <i class="fas fa-sync"></i></a>
                                    <button type="button" class="btn btn-outline-primary">Tindakan</button>
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">

                                        <a class="dropdown-item"
                                            href="{{ secure_url('pembelian/baru') }}">Tambah Faktur Pembelian</a>
                                            <a class="dropdown-item"
                                            href="{{ secure_url(route('pembelian_pemesanan.create')) }}">Tambah Pemesanan Pembelian</a>
                                        <a class="dropdown-item"
                                            href="{{ secure_url('pembelian/retur') }}">Retur Pembelian</a>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                </div>

                                <a class="btn btn-md btn-outline-info reset_pembelian">Reset Pembelian</a>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:moccasin">
                                    <div class="d-flex justify-content-between">
                                        <b>Pembelian belum dibayar</b>


                                        <span class="badge bg-warning pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b></b></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:mistyrose;">
                                    <div class="d-flex justify-content-between">
                                        <b>Pembelian jatuh tempo</b>


                                        <span class="badge bg-danger pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b>Rp.0</b></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card text-dark">
                                <div class="card-header" style="height:50px; background-color:palegreen">
                                    <div class="d-flex justify-content-between">
                                        <b>Pelunasan dibayar 30 hari terakhir</b>


                                        <span class="badge bg-success pt-2" style="border-radius:10px;">0</span>
                                    </div>
                                </div>
                                <div class="card-body" style="height:100px;">
                                    <small>Total</small>
                                    <h2><b>{{ \Helper::rupiah($pembelian_lunas) }}</b></h2>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-items active"><a class="nav-link active btn-outline-info"
                                            data-toggle="tab" href="#home">Faktur Pembelian</a></li>
                                    <li class="nav-items "><a class="nav-link btn-outline-info" data-toggle="tab"
                                            href="#pengiriman">Pengiriman</a></li>
                                    <li class="nav-items "><a class="nav-link btn-outline-info" data-toggle="tab"
                                            href="#pemesanan">Pemesanan Pembelian</a></li>


                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        <div class="card">
                                            <div class="d-flex justify-content-end">
                                                <div class="form-group mt-3 col-2">

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('pembayaran.list') }}"
                                                        data-id="00"
                                                        data-transaksi="<i class='fas fa-list'></i> Pembayaran"> List
                                                        Pembayaran</a>

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('retur.list') }}" data-id="01"
                                                        data-transaksi="<i class='fas fa-list'></i> Retur">List
                                                        Retur</a>

                                                    <!-- /.input group -->
                                                </div>

                                            </div>



                                            <div class="table-responsive table-striped mt-3"  width="100%">
                                                <table border="0" cellspacing="5" cellpadding="5">
                                                    <tbody>
                                                        <tr>
                                                            <td>Filter Tanggal Mulai:</td>
                                                            <td><input type="text" id="min" name="min"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Filter Tanggal Akhir:</td>
                                                            <td><input type="text" id="max" name="max"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table
                                                    class="table table-striped table_pembelian dataTables_wrapper dt-bootstrap4">
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
                                                        <th class="text-capitalize" style="width:20%">
                                                            Sisa Tagihan
                                                        </th>
                                                        <th class="text-capitalize" style="width:20%">
                                                            total
                                                        </th>
                                                        <th class="text-capitalize" style="width:5%">
                                                            tag
                                                        </th>

                                                    </thead>

                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>

                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="pengiriman" class="tab-pane">
                                        <div class="card">
                                            <div class="d-flex justify-content-end">
                                                <div class="form-group mt-3 col-2">

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('pembayaran.list') }}"
                                                        data-id="00"
                                                        data-transaksi="<i class='fas fa-list'></i> Pembayaran"> List
                                                        Pembayaran</a>

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('retur.list') }}" data-id="01"
                                                        data-transaksi="<i class='fas fa-list'></i> Retur">List
                                                        Retur</a>

                                                    <!-- /.input group -->
                                                </div>
                                            </div>

                                        </div>



                                        <div class=" table-striped mt-3">

                                            <table id="table_pengiriman" class="table table-striped display" width="100%">
                                                <thead class="text-capitalize" style="background-color:mintcream">
                                                    <th class="text-capitalize">
                                                        Tanggal
                                                    </th>
                                                    <th class="text-capitalize">
                                                        No.
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Supplier
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Status
                                                    </th>
                                                    <th class="text-capitalize" style="width:5%">
                                                        tag
                                                    </th>

                                                </thead>
                                        
                                            </table>
                                        </div>

                                    </div>


                                    <div id="pemesanan" class="tab-pane">
                                        <div class="card">
                                            <div class="d-flex justify-content-end">
                                                <div class="form-group mt-3 col-2">

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('pembayaran.list') }}"
                                                        data-id="00"
                                                        data-transaksi="<i class='fas fa-list'></i> Pembayaran"> List
                                                        Pembayaran</a>

                                                    <a class="btn btn-outline-primary nav-widget mr-1"
                                                        href="{{ route('retur.list') }}" data-id="01"
                                                        data-transaksi="<i class='fas fa-list'></i> Retur">List
                                                        Retur</a>

                                                    <!-- /.input group -->
                                                </div>
                                            </div>

                                        </div>



                                        <div class="mt-3">

                                            <table id="table_pemesanan" class="table table-striped display" width="100%">
                                                <thead class="text-capitalize" style="background-color:mintcream">
                                                    <th class="text-capitalize">
                                                        Tanggal
                                                    </th>
                                                    <th class="text-capitalize">
                                                        No.
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Supplier
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Tgl Jatuh Tempo
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Status
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Jumlah Dp
                                                    </th>
                                                    <th class="text-capitalize">
                                                        Total
                                                    </th>
                                                    <th class="text-capitalize" style="width:5%">
                                                        tag
                                                    </th>

                                                </thead>
                                               
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@push('custom-scripts')
    @include('pembelian.js.pembelian_index_js');
    @include('pembelian.js.datatables.table_pembelian_js');
    @include('pembelian.js.datatables.table_pengiriman_js');
    @include('pembelian.js.datatables.table_pemesanan_js');
@endpush
