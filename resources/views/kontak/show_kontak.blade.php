@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:120px;">

                    <a class="" href="{{ route('kontak.index') }}"><i class="fas fa-circle-arrow-left"></i> Kontak</a>
                    <div class="mb-3">
                        <h4>Informasi Kontak</h4>

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

                        <div class="ml-4 mt-4 d-flex justify-content-between">
                            <div class="">
                                <h5 class=" ml-2" style="margin-top:10px; height:10px;">
                                    <b>{{ $kontak->nama_panggilan }}</b> <small
                                        style="border-radius:50px; margin-left:-40px;"> {!! Helper::tipe_kontak($kontak->tipe_kontak) !!}</small>
                                </h5>

                            </div>
                            <div class="">
                                <a class="btn btn-outline-info btn-sm mr-2" href="{{ route('kontak.edit',$kontak->id) }}">Ubah Profil</a>
                                <div class="btn-group mr-3">
                                    <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Buat Transaksi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Faktur Penjualan</a>
                                        <a class="dropdown-item" href="#">Kredit Memo</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="">
                                <ul class="nav nav-tabs">
                                    <li class="nav-items active" style="border-bottom:2px solid #8ef5f5;"><a
                                            class="nav-link active " data-toggle="tab" href="#home">Profil</a></li>
                                    <li class="nav-items"><a class="nav-link" style="border-bottom:2px solid #8ef5f5;"
                                            data-toggle="tab" href="#menu1">Transaksi</a></li>



                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">

                                        <div class="card mt-3 border">
                                            <div class="card-header">
                                                <div class="ml-4 d-flex justify-content-start">
                                                    <span class="fas fa-2x fa-briefcase mt-4"></span>
                                                    <h6 class=" ml-2" style="margin-top:30px;"><b>Informasi Umum</b>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        Nama Kontak  <br> <b>{{ $kontak->nama_kontak }}</b> <br><br>
                                                        Email : <br><b>{{ $kontak->email }}</b><br><br>
                                                        Handphone : <br><b>{{ $kontak->no_hp }}</b><br><br>
                                                        Info Lain : <br> <b>{{ $kontak->info_lain }}</b> <br><br>
                                                    </p>
                                                    <p> Identitas  <br> <b>{{ $kontak->no_identitas }}</b> <br><br>
                                                        Nama Perusahaan : <br> <b>{{ $kontak->nama_perusahaan }}</b> <br><br>
                                                        NPWP : <br><b>{{ $kontak->npwp }}</b><br><br>
                                                        Alamat : <br><b>{{ $kontak->alamat }}</b><br><br></p>
                                                    <p>  
                                                        Jumlah Transaksi  <br> <b>{{ $kontak->no_identitas }}</b> <br><br>
                                                        Saldo : <br><b>{{ $kontak->saldo }}</b><br><br></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-3 border">
                                            <div class="card-header">
                                                <div class="ml-4 d-flex justify-content-start">
                                                    <span class="fas fa-2x fa-bank mt-4"></span>
                                                    <h6 class=" ml-2" style="margin-top:30px;"><b>Akun Bank</b>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        Nama Bank  <br> <b>{{ $kontak->nama_bank }}</b> <br><br>
                                                        Nomor Rekening : <br> <b>{{ $kontak->no_rekening }}</b> <br><br>
                                                        Nama Pemegang Rekening : <br><b>{{ $kontak->nama_pemegang_rekening }}</b><br><br>
                                                        
                                                    </p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div class="card">
                                            <div class="row mt-4 ml-2">
                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="card text-dark"
                                                        style="border-left:5px solid orange; border-top:1px solid gray;">
                                                        <div class="card-body" style="height:90px;">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="align-self-center">
                                                                    <small>Hutang Belum Dibayar</small>
                                                                    <h3 class="align-content-center"><b>Rp.0</b>
                                                                    </h3>
                                                                </div>
                                                                <div style="border-left:2px solid gray; width:30px; height:40px; margin-bottom:29px;"
                                                                    class=" d-flex align-self-center justify-content-end">
                                                                    <h5 class="ml-3"><small> 0 </small></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="card text-dark"
                                                        style="border-left:5px solid red; border-top:1px solid gray;">
                                                        <div class="card-body" style="height:90px;">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="align-self-center">
                                                                    <small>Hutang jatuh Tempo</small>
                                                                    <h3 class="mb-4"><b>Rp.0</b></h3>
                                                                </div>
                                                                <div style="border-left:2px solid gray; width:30px; height:40px; margin-bottom:29px;"
                                                                    class=" d-flex align-self-center justify-content-end">
                                                                    <h5 class="ml-3"><small> 0 </small></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="card text-dark"
                                                        style="border-left:5px solid lightblue; border-top:1px solid gray;">
                                                        <div class="card-body" style="height:90px;">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="align-self-center">
                                                                    <small>Debit Memo</small>
                                                                    <h3 class="mb-4"><b>Rp.0</b></h3>
                                                                </div>
                                                                <div style="border-left:2px solid gray; width:30px; height:40px; margin-bottom:29px;"
                                                                    class=" d-flex align-self-center justify-content-end">
                                                                    <h5 class="ml-3"><small> 0 </small></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

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
        @endsection

        @push('scripts')
        <script>

        </script>
        @endpush