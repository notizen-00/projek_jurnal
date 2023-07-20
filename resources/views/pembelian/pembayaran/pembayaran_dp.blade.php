@extends('layout.app', [

])

@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:80px;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Transaksi</b><br>
                            <a href="{{ route('pembayaran.list') }}" class="btn btn-danger btn-sm" >Kembali ke List</a>
                        </div>
                        <h4 style="margin-top:-1px;">Tambah Deposit</h4>

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
                <div class="col-lg-12">
                    <div class="card">

                        <form id="form_deposit" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">
                                <input type="hidden" name="kontak_id" value="{{ $kontak->id }}">
                                <input type="hidden" name="no_transaksi_pemesanan" value="{{ $pemesanan->no_transaksi }}">
                                <input type="hidden" name="tag" value="{{ $pemesanan->tag }}">
                                <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
                                <div class="row">
                                   
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                       <input type="text" value="{{ $kontak->nama_panggilan }}" class="form-control" name="nama_supplier">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Bayar dari</b></label>

                                        <select class="form-control form-control-sm" required
                                            name="akun_transaksi_kredit"
                                            >
                                            <option value="1-10001">(1-10001)-Kas</option>
                                            <option value="1-10002">(1-10002)-Rekening Bank</option>
                                        </select>

                                    </div>
                                    <!-- <div class="form-group col-lg-3 col-md-6 col-sm-12 float-left ui-widget">
                                        <label for="no_referensi" class="text-dark"><b>No Referensi / No Transaksi</b> <i
                                                class="fas fa-search" data-toggle="tooltip" data-title="test"></i>
                                        </label>
                                        <input type="text" class="form-control" id="search_transaksi" placeholder="ketikan no referensi"
                                            name="no_transaksi"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;">
                                    </div> -->

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">
                                          
                                    </div>




                                </div>


                            </div>

                            <div class="row mt-4" style="height:250px;">

                                <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-between ">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group col-lg-4 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Cara Pembayaran</b></label>
                                            <select class="form-control" id="syarat_pembayaran" required
                                                name="cara_pembayaran"
                                                style="height:35px; font-size:small; padding-top:3px;"
                                                id="tgl_transaksi">
                                                <option value="">-- Cara Pembayaran --</option>
                                                <option value="1">Kas Tunai</option>
                                                <option value="2">Cek & Giro</option>
                                                <option value="3">Transfer Bank</option>
                                                <option value="4">Kartu Kredit</option>
                                                

                                            </select>
                                        </div>


                                        <div class="form-group col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tgl Pembayaran</b></label>
                                            <input type="date" name="tgl_transaksi"
                                                value="{{ date('Y-m-d') }}"
                                                class="form-control form-control-sm"
                                                style="height:35px; font-size:small; padding-top:3px;"
                                                id="tgl_transaksi" />
                                        </div>

                                        <?php
                                      $hari = new DateInterval('P3D');
                                      $diff = new DateTime();
                                      $diff->add($hari);
                                      $tgl_jatuh_tempo = $diff->format('Y-m-d');
                                    

                                    ?>
                                        <div class="form-group col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tgl Jatuh Tempo</b></label>
                                            <input type="date" name="tgl_jatuh_tempo" value="{{ $tgl_jatuh_tempo }}"
                                                class="form-control" id="tgl_jatuh_tempo"
                                                style="height:35px; font-size:small; padding-top:3px;" />
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                <table class="table table-striped table-hover" id="table_pembayaran"
                                    style="overflow: scroll; overflow-x:auto;">
                                    <thead style="background-color:aliceblue;" class="text-lowercase">
                                        <tr>
                                            <th style="font-size:smaller;" class="text-capitalize">Nomor Transaksi</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Deskripsi</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Tgl Transaksi</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Total</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-left">Sisa
                                                Tagihan
                                            </th>
                                            <th style="font-size:smaller;" class="text-capitalize text-left">Tambah Deposit
                                            </th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody class="isi_payment">
                                        <tr>
                                            <td>{{ $pemesanan->no_transaksi }}</td>
                                            <td>{{ $pemesanan->deskripsi }}</td>
                                            <td>{{ $pemesanan->tgl_transaksi }}</td>
                                            <td>{{ \Helper::rupiah($pemesanan->total) }}</td>
                                            <td>{{ $pemesanan->total }}</td>
                                            <td><input type="text" name="jumlah_deposit" value="0" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>





                            <div class="row">
                                <div class="row col-12 justify-content-between">
                                    <div class="col-lg-6 col-sm-12">

                                        <div class="form-group col-lg-8 col-sm-12 float-left">
                                            <label for="suppliers" class="text-dark"><b>Memo</b></label>
                                            <textarea placeholder="Isikan Memo ..." id="suppliers" rows="3"
                                                class="form-control form-control-sm" name="memo"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 text-right pr-5 justify-content-between">


                                        <div class="pr-5 col-lg-6 mt-3 col-sm-12 float-left" style="font-size: large;">
                                            <b>Total</b>
                                            <input type="hidden" name="total" />
                                        </div>


                                        <div class="form-group mt-3 col-lg-6 col-sm-12 float-left total_view">

                                          
                                        </div>



                                    </div>

                                </div>

                            </div>

                            <div class="row justify-content-end col-12">

                                <button type="submit" class="btn btn-md btn-success hasil mb-3 mr-2">Tambah DP</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endsection

        @push('custom-scripts')
         
            @include('pembelian.js.pembayaran_dp_js');
        @endpush
