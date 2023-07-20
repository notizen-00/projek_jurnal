@extends('layout.app', [
   
])

@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Kontak</b></h5>

                        </div>

                        <a class=" btn btn-info pt-2" href="{{ route('kontak.create') }}">
                            <i class="nc-icon nc-simple-add"></i>
                            Tambah Kontak

                        </a>

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
                        <ul class="nav nav-tabs">
                            <li class="nav-items active"><a class="nav-link active btn-outline-info" data-toggle="tab"
                                    href="#home">Pelanggan</a></li>
                            <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab"
                                    href="#menu1">Supplier</a></li>
                            <li class="nav-itmes"><a class="nav-link btn-outline-info" data-toggle="tab"
                                    href="#menu2">Karyawan</a></li>
                            <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab"
                                    href="#menu3">Lainnya </a></li>
                            <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab"
                                    href="#menu4">Semua Tipe </a> </li>

                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="card">

                                    <div class="row mt-4 ml-2">
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="card text-dark"
                                                style="border-left:5px solid orange; border-top:1px solid gray;">
                                                <div class="card-body" style="height:90px;">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="align-self-center">
                                                            <small>Piutang Belum Dibayar</small>
                                                            <h3 class="align-content-center"><b>Rp.0</b></h3>
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
                                                            <small>Piutang jatuh Tempo</small>
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
                                                            <small>Kredit Memo</small>
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
                                                    Nama
                                                </th>
                                                <th class="text-capitalize">
                                                    Nama Perusahaan
                                                </th>
                                                <th class="text-capitalize">
                                                    Alamat
                                                </th>
                                                <th class="text-capitalize">
                                                    Email
                                                </th>
                                                <th class="text-capitalize">
                                                    No Handphone
                                                </th>
                                                <th class="text-capitalize">
                                                    Saldo
                                                </th>

                                            </thead>
                                          
                                            @if(empty($pelanggan))
                                            <tbody style="background-color:white;">

                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($pelanggan as $i)
                                                <tr>
                                                    <td><a href="{{ route('kontak.show',$i->id) }}">{{ $i->nama_panggilan }}</a>   {!! Helper::tipe_kontak($i->tipe_kontak) !!} </td>
                                                    <td>{{ $i->nama_perusahaan }}</td>
                                                    <td>{{ $i->alamat }}</td>
                                                    <td>{{ $i->email }}</td>
                                                    <td>{{ $i->no_hp }}</td>
                                                    <td>{{ $i->saldo }}</td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @endif
                                        </table>
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
                                                            <h3 class="align-content-center"><b>Rp.0</b></h3>
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
                                                    Nama
                                                </th>
                                                <th class="text-capitalize">
                                                    Nama Perusahaan
                                                </th>
                                                <th class="text-capitalize">
                                                    Alamat
                                                </th>
                                                <th class="text-capitalize">
                                                    Email
                                                </th>
                                                <th class="text-capitalize">
                                                    No Handphone
                                                </th>
                                                <th class="text-capitalize">
                                                    Saldo
                                                </th>

                                            </thead>
                                            @if(empty($supplier))
                                            <tbody style="background-color:white;">

                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($supplier as $i)
                                                <tr>
                                                    <td><a href="{{ route('kontak.show',$i->id) }}">{{ $i->nama_panggilan }}</a>   {!! Helper::tipe_kontak($i->tipe_kontak) !!} </td>
                                                    <td>{{ $i->nama_perusahaan }}</td>
                                                    <td>{{ $i->alamat }}</td>
                                                    <td>{{ $i->email }}</td>
                                                    <td>{{ $i->no_hp }}</td>
                                                    <td>{{ $i->saldo }}</td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="card">


                                    <div class="table-responsive table-striped mt-3">
                                        <table class="table table-striped myTable">
                                            <thead class="text-capitalize" style="background-color:mintcream">
                                            <th class="text-capitalize">
                                                    Nama
                                                </th>
                                                <th class="text-capitalize">
                                                    Nama Perusahaan
                                                </th>
                                                <th class="text-capitalize">
                                                    Alamat
                                                </th>
                                                <th class="text-capitalize">
                                                    Email
                                                </th>
                                                <th class="text-capitalize">
                                                    No Handphone
                                                </th>
                                                <th class="text-capitalize">
                                                    Saldo
                                                </th>

                                            </thead>
                                            @if(empty($karyawan))
                                            <tbody style="background-color:white;">

                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($karyawan as $i)
                                                <tr>
                                                    <td><a href="{{ route('kontak.show',$i->id) }}">{{ $i->nama_panggilan }}</a>   {!! Helper::tipe_kontak($i->tipe_kontak) !!}</td>
                                                    <td>{{ $i->nama_perusahaan }}</td>
                                                    <td>{{ $i->alamat }}</td>
                                                    <td>{{ $i->email }}</td>
                                                    <td>{{ $i->no_hp }}</td>
                                                    <td>{{ $i->saldo }}</td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @endif
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="card">
                                    <div class="d-flex justify-content-start">
                                        {!! Form::select('size', ['L' => 'Large', 'S' =>
                                        'Small'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
                                        {!! Form::select('Status', [' '=>'-- Pilih Status --','1' => 'Open', '2' =>
                                        'Overdue','3'=>'Paid'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
                                    </div>

                                    <div class="table-responsive table-striped mt-3">
                                        <table class="table table-striped myTable">
                                            <thead class="text-capitalize" style="background-color:mintcream">
                                            <th class="text-capitalize">
                                                    Nama
                                                </th>
                                                <th class="text-capitalize">
                                                    Nama Perusahaan
                                                </th>
                                                <th class="text-capitalize">
                                                    Alamat
                                                </th>
                                                <th class="text-capitalize">
                                                    Email
                                                </th>
                                                <th class="text-capitalize">
                                                    No Handphone
                                                </th>
                                                <th class="text-capitalize">
                                                    Saldo
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

                            <div id="menu4" class="tab-pane fade">
                                <div class="card">
                                    <div class="d-flex justify-content-start">
                                        {!! Form::select('size', ['L' => 'Large', 'S' =>
                                        'Small'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
                                        {!! Form::select('Status', [' '=>'-- Pilih Status --','1' => 'Open', '2' =>
                                        'Overdue','3'=>'Paid'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
                                    </div>

                                    <div class="table-responsive table-striped mt-3">
                                        <table class="table table-striped myTable">
                                            <thead class="text-capitalize" style="background-color:mintcream">
                                            <th class="text-capitalize">
                                                    Nama
                                                </th>
                                                <th class="text-capitalize">
                                                    Nama Perusahaan
                                                </th>
                                                <th class="text-capitalize">
                                                    Alamat
                                                </th>
                                                <th class="text-capitalize">
                                                    Email
                                                </th>
                                                <th class="text-capitalize">
                                                    No Handphone
                                                </th>
                                                <th class="text-capitalize">
                                                    Saldo
                                                </th>

                                            </thead>
                                            @if(empty($semua_tipe))
                                            <tbody style="background-color:white;">

                                            </tbody>
                                            @else
                                            <tbody>
                                                @foreach($semua_tipe as $i)
                                                
                                                <tr>
                                                    <td><a href="{{ route('kontak.show',$i->id) }}">{{ $i->nama_panggilan }}</a>  {!! Helper::tipe_kontak($i->tipe_kontak) !!} </td>
                                                    <td>{{ $i->nama_perusahaan }}</td>
                                                    <td>{{ $i->alamat }}</td>
                                                    <td>{{ $i->email }}</td>
                                                    <td>{{ $i->no_hp }}</td>
                                                    <td>{{ $i->saldo }}</td>

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
        @endsection

        @push('scripts')
        <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });


        //         var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
        // triggerTabList.forEach(function (triggerEl) {

        //   var tabTrigger = new bootstrap.Tab(triggerEl)
        //   console.log(triggerEl);
        //   triggerEl.addEventListener('click', function (event) {
        //     event.preventDefault()
        //     console.log(triggerEl);
        //     tabTrigger.show()
        //   })
        // })  
        </script>
        @endpush