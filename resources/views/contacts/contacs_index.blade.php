
    <div class="content">

        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                       <div>     
                    <small>Transaksi</small><br><h5><b>Pembelian</b></h5>
                       </div>
                    <nav class="navbar navbar-expand-lg navbar-transparent">
                    <ul class="navbar-nav">
                    
                     
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link btn btn-info btn-sm dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              
                                Tambah Pembelian
                                <p>
                                    <span class="d-lg-none d-md-block">{{ __('Account') }}</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item">Penagihan Pembelian</a>
                                    <a class="dropdown-item">Tukar Faktur Pembelian</a>
                                    <a class="dropdown-item">Pemesanan Pembelian</a>
                                    <a class="dropdown-item">Penawaran Pembelian</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
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
                      <h2><b>Rp.0</b></h2>
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
                      <h2><b>Rp.0</b></h2>
                    </div>
                  </div>
            </div>
           
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <ul class="nav nav-tabs">
                        <li class="nav-items active"><a class="nav-link btn-outline-info" data-toggle="tab" href="#home">Faktur Pembelian</a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu1">Tukar Faktur Pembelian</a></li>
                        <li class="nav-itmes"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu2">Pengiriman</a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu3">Pemesanan Pembelian </a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu4">Penawaran </a> </li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu5">Permintaan Pembelian </a></li>
                        <li class="nav-items"><a class="nav-link btn-outline-info" data-toggle="tab" href="#menu6">Membutuhkan Persetujuan <span class="badge badge-primary">0</span></a></li>
                      </ul>
                    
                      <div class="tab-content">
                        <div id="home" class="tab-pane active">
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
                        <div id="menu2" class="tab-pane fade">
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
                        <div id="menu3" class="tab-pane fade">
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

                        <div id="menu4" class="tab-pane fade">
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