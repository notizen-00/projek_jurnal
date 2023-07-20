@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Produk</b></h5>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary">Tindakan</button>
                            <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-icon"
                                data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item create_product"
                                    href="{{ route('product.create') }}">Produk Baru</a>
                                <a class="dropdown-item gudang_modal" href="#">Gudang</a>
                                <a class="dropdown-item create_opname" href="#">Penyesuaian Stok</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item create_transfer" href="#">Transfer Gudang</a>
                            </div>
                        </div>


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


            <div class="row">
                <div class="col-md-12">
                    <div class="card ">

                        <!-- Tab panes -->

                        <ul class="nav nav-tabs">
                            <li class="nav-items active" style="border-bottom:2px solid #8ef5f5;"><a
                                    class="nav-link active" data-toggle="tab" href="#home">Barang & Jasa</a></li>
                            <li class="nav-items"><a class="nav-link gudang_create"
                                    style="border-bottom:2px solid #8ef5f5;" data-toggle="tab" href="#menu1">Gudang</a>
                            </li>
                            <li class="nav-itmes"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                    data-toggle="tab" href="#menu2">Aturan Harga</a></li>


                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="card">

                                    <div class="card-header">
                                        <b>Ringkasan</b>
                                    </div>

                                    <div class="row mt-2 ml-2">
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5 col-md-4">
                                                            <div class="icon-big text-center icon-warning">
                                                                <i class="nc-icon nc-box-2 text-dark"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            <div class="numbers">
                                                                <p class="card-category">Stok tersedia</p>
                                                                <p class="card-title">{{ $jumlah_barang }} Jenis
                                                                    <p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-end">

                                                        <a class="text-dark" data-toggle="tooltip" data-placement="top"
                                                            title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid orange;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5 col-md-4">
                                                            <div class="icon-big text-center icon-warning">
                                                                <i class="nc-icon nc-box-2 text-warning"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            <div class="numbers">
                                                                <p class="card-category">Stok segera habis</p>
                                                                <p class="card-title">{{ $stok_hampir_habis }} Jenis
                                                                    <p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-end">

                                                        <a class="text-dark" data-toggle="tooltip" data-placement="top"
                                                            title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid red;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5 col-md-4">
                                                            <div class="icon-big text-center icon-warning">
                                                                <i class="nc-icon nc-box-2 text-danger"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            <div class="numbers">
                                                                <p class="card-category">Stok Habis</p>
                                                                <p class="card-title">{{ $stok_habis }} Jenis
                                                                    <p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-end">

                                                        <a class="text-dark" data-toggle="tooltip" data-placement="top"
                                                            title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="card card-stats" style="border-top:2px solid gray;">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5 col-md-4">
                                                            <div class="icon-big text-center icon-warning">
                                                                <i class="fa fa-building text-dark"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-md-8">
                                                            <div class="numbers">
                                                                <p class="card-category">Daftar Gudang</p>
                                                                <p class="card-title">0
                                                                    <p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <hr>
                                                    <div class="d-flex justify-content-end">

                                                        <a class="text-dark" data-toggle="tooltip" data-placement="top"
                                                            title="lihat laporan" href="#">
                                                            <i class="nc-icon nc-calendar-60"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end mr-4">

                                        {{-- <input type="checkbox" name="jenis_produk" id="toggle_jenis_produk" checked data-toggle="toggle" data-width="200" data-height="20" data-on="Produk Single" data-off="Produk Bundle" data-onstyle="danger" data-offstyle="success"> --}}
                                                            
                                                      
                                                    </div>
                                    <div class="table-responsive table-striped mt-3">
                                        <table class="table table-striped table-product">
                                            <thead class="text-capitalize text-white bg-info">
                                                <th>
                                                    <input type="checkbox" name="all_check" />
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Gambar
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Kode Produk
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Nama Produk
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Kategori produk
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    qty
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Stok Minimum
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Satuan
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Harga Rata Rata
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Harga Beli Terakhir
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    Harga Beli
                                                </th>
                                                <th class="text-capitalize" style="font-size:smaller">
                                                    harga Jual
                                                </th>

                                            </thead>
                                            @if(empty($product))
                                                <tbody style="background-color:white;">

                                                </tbody>
                                            @else
                                                <tbody class="isi_produk">
                                                    @foreach($product as $i)
                                                        <tr>


                                                            <td>
                                                                <input type="checkbox" data-id="{{ $i->id }}" />
                                                            </td>
                                                            <td><img width="161px" height="61px"
                                                                    src="{{ \Helper::get_image_produk($i->image_produk) }}">
                                                            </td>
                                                            <td>{{ $i->kode_produk }}</td>
                                                            <td><a class="nav-widget"
                                                                    href="{{ route('product.show',$i->id) }}">{{ $i->nama_produk }}</a>
                                                                    <br>
                                                                    @if($i->tipe_produk == 1)
                                                                    <span class="badge badge-primary">Single</span>
                                                                    @elseif($i->tipe_produk == 2)
                                                                    <span class="badge badge-success">Bundle</span>
                                                                    @endif
                                                            </td>   
                                                            <td>{{ $i->kategori_produk->nama_kategori }}</td>
                                                            <td>{{ \Helper::get_stok_product($i->id) }}</td>
                                                            <td>{{ $i->batas_minimum }}</td>
                                                            <td>{{ $i->unit_produk->nama_unit }}</td>
                                                            <td>{{ \Helper::rupiah(\Pembelian_helper::get_average_price($i->id)) }}
                                                            </td>
                                                            <td><?php $rp = round((100/111) * $i->harga_beli,2);
                                                            echo \Helper::rupiah($rp); ?></td>
                                                            <td width="20%">
                                                                {{ \Helper::rupiah($i->harga_beli) }}</td>

                                                            <td>{{ $i->harga_jual }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="card card-solid">
                                    <div class="card-body pb-0 ">
                                        <div class="ws-data-gudang">
                                            <div class="row" id="cards-container">
                                                @foreach($gudang as $i)
                                                    <div
                                                        class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                        <div class="card bg-light d-flex flex-fill">
                                                            <div class="card-header text-muted border-bottom-0">
                                                                {{ \Helper::auto_kode($i->id,'GUID') }}
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <h2 class="lead"><b>{{ $i->nama_gudang }}</b>
                                                                        </h2>
                                                                        <p class="text-muted text-sm"><b>Alamat : </b>
                                                                            {{ $i->alamat }} </p>
                                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                            <li class="small"><span class="fa-li"><i
                                                                                        class="fas fa-lg fa-circle"></i></span>
                                                                                Jumlah produk : {{ $i->total_produk }}
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-5 text-center">
                                                                        <i class="fas fa-warehouse fa-4x"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-default">
                                                                <div class="text-right">
                                                                    <a href="#" class="btn btn-sm btn-success">
                                                                        <i class="fas fa-edit"></i> Edit
                                                                    </a>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-primary detail_gudang"
                                                                        data-id="{{ $i->id }}">
                                                                        <i class="fas fa-eye"></i> Liat Detail
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="card">


                                    <div class="table-responsive table-striped mt-3">
                                        <table class="table table-striped myTable">
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
                                                <th class="text-capitalize">
                                                    total
                                                </th>
                                                <th class="text-capitalize">
                                                    Tag
                                                </th>
                                            </thead>
                                            @if(empty($pengajuan))
                                                <tbody style="background-color:white;">

                                                </tbody>
                                            @else
                                                <tbody>
                                                    @foreach($pengajuan as $i)
                                                        <tr>

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
        </div>
    </div>

</div>
@include('product.modal_create_gudang')
@include('product.modal.modal_detail_gudang')
@endsection

@push('custom-scripts')
    @include('product.js.product_js')
    @include('product.js.product_index_js')
    @include('product.js.gudang_js')

@endpush
