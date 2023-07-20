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
                    <h5><b>Pengeluaran</b></h5>
                       </div>
                  
                    
                     
                     
                            <a class="btn btn-outline-info btn-sm create_pengeluaran" href="" >
                                <i class="fas fa-plus"></i> 
                                Buat Biaya Baru
                                
                            </a>
                           
                      
                 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card text-dark">
                    <div class="card-header" style="height:50px; background-color:moccasin">
                        <div class="d-flex justify-content-between">
                            <b>Total Biaya Bulan ini</b>
                            
                        
                        <span class="badge bg-warning pt-2" style="border-radius:10px;">0</span>
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
                    <div class="card-header" style="height:50px; background-color:mistyrose;">
                        <div class="d-flex justify-content-between">
                            <b>Biaya 30 Hari Terakhir </b>
                            
                        
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
                            <b>Biaya Belum Dibayar</b>
                            
                        
                        <span class="badge bg-success pt-2" style="border-radius:10px;">0</span>
                    </div>
                    </div>
                    <div class="card-body" style="height:100px;">
                      <small>Total</small>
                      <h2><b>Rp.0</b></h2>
                    </div>
                  </div>
            </div>
           
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <ul class="nav nav-tabs">
                        <li class="nav-items active"><a class="nav-link active btn-outline-info" data-toggle="tab" href="#home">Biaya</a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu1">Membutuhkan Persetujuan <span class="badge badge-primary">0</span></a></li>
                      </ul>
                    
                      <div class="tab-content">
                        <div id="home" class="tab-pane active">
                          <div class="card">
                           

                            <div class="table-responsive table-striped mt-3">
                                <table class="table table-striped myTable">
                                    <thead class="text-capitalize" style="background-color:mintcream">
                                        <th class="text-capitalize">
                                            Tanggal
                                        </th>
                                        <th class="text-capitalize">
                                            Nomor
                                        </th>
                                        <th class="text-capitalize">
                                            Kategori
                                        </th>
                                        <th class="text-capitalize">
                                            Penerima
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
    </div>
@endsection

@push('custom-scripts')

        @include('pengeluaran.js.pengeluaran_js');

@endpush