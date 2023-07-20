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
                    <h5><b>Pengaturan Aplikasi</b></h5>
                       </div>
    
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <ul class="nav nav-tabs">
                        <li class="nav-items active"><a class="nav-link active btn-outline-info" data-toggle="tab" href="#home">Pajak</a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#komisi_penjualan">Komisi Penjualan</a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu1">Daftar Transaksi</a></li>
                      </ul>
                    
                      <div class="tab-content">
                        <div id="home" class="tab-pane active">
                          <div class="card">
                           
                            <div class="d-flex justify-content-end mr-3 mt-1    ">
                                <a class="btn btn-md btn-outline-info" href="#">Buat Pajak</a>
                            </div>
                            <div class="table-responsive table-striped mt-3">
                                <table id="table-pajak" class="table table-striped myTable">
                                    <thead class="text-capitalize" style="background-color:mintcream">
                                        <th class="text-capitalize">
                                            Nama
                                        </th>
                                        <th class="text-capitalize">
                                            Persentase Efektif
                                        </th>
                                        <th class="text-capitalize">
                                            Akun Pajak Penjualan
                                        </th>
                                        <th class="text-capitalize">
                                            Akun Pajak Pembelian
                                        </th>
                                       
                                    </thead>
                                    @if(empty($data_pajak))
                                    <tbody style="background-color:white;">
                                     
                                    </tbody> 
                                        @else
                                    <tbody>
                                       @foreach($data_pajak as $i)
                                       <tr>
                                            <th>{{ $i->nama_pajak }}</th>
                                            <th>{{ $i->persentase }} %</th>
                                            <th>({{ $i->akun_pajak_penjualan }})-{{ \Account_helper::get_detail_kode($i->akun_pajak_penjualan,'nama_akun') }}</th>
                                            <th>({{ $i->akun_pajak_pembelian }})-{{ \Account_helper::get_detail_kode($i->akun_pajak_pembelian,'nama_akun') }}</th>
                                       </tr>
                                        @endforeach
                                      
                                    </tbody>
                                    @endif
                                </table>
                            </div>

                          </div>
                        </div>

                        <div id="komisi_penjualan" class="tab-pane fade">
                            <div class="card">
                                <div class="d-flex justify-content-end mr-3 mt-1    ">
                                    <a class="btn btn-md btn-outline-info buat_komisi" href="#">Buat Komisi </a>
                                </div>

                               
                                    <table class="table table-striped mt-3" id="table_komisi">
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
                                            <th class="text-capitalize">
                                                Action
</th>
                                        </thead>
                                        @if(empty($komisi))
                                            <tbody style="background-color:white;">

                                            </tbody>
                                        @else
                                            <tbody>
                                                @foreach($komisi as $i)
                                                    <tr>
                                                        <td>{{ $i->id }}</td>
                                                        <td><a href="#" class="detail_komisi" data-id="{{ $i->id }}"> {{ $i->nama_komisi }}</a></td>
                                                        <td>{{ \Komisi_helper::get_rule_periode($i->id) }}</td>
                                                        <td>{{ $i->catatan }}</td>
                                                        <td>{{ \Komisi_helper::get_status_name($i->status) }}</td>
                                                        <td>{{ $i->created_at }}</td>
                                                        <td><a class="fas fa-trash hapus_komisi" data-id="{{ $i->id }}"></a></td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        @endif
                                    </table>
                               

                            </div>
                        </div>
                    
                        <div id="menu1" class="tab-pane fade">
                            <div class="card">
                                <div class="d-flex justify-content-start">
                                    {!! Form::select('size', ['L' => 'Large', 'S' => 'Small'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
                                    {!! Form::select('Status', [' '=>'-- Pilih Status --','1' => 'Open', '2' => 'Overdue','3'=>'Paid'],'size',['class'=>'form-control mt-3 col-2 ml-2']) !!}
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
        @include('pengeluaran.modal.modal_create_pengeluaran')
        @include('pengaturan.modal.create_komisi')
        @include('pengaturan.modal.detail_komisi')
    </div>
@endsection

@push('custom-scripts')

        @include('pengaturan.js.pengaturan_index_js')
        @include('pengaturan.js.komisi_js')

@endpush