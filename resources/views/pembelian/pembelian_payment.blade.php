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
                            <button class="btn btn-danger btn-sm" id="btnBack">Kembali ke faktur</button>
                        </div>
                        <h4 style="margin-top:-1px;">Pengiriman Pembayaran</h4>

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

                        <form id="form_pembayaran" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">

                                <div class="row">
                                    <input type="hidden" value="{{ $supplier->id }}" name="id_kontak">
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        <input type="text" value="{{ $supplier->nama_panggilan }}" readonly
                                            class="form-control form-control-sm" name="nama_kontak"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />
                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Bayar dari</b></label>

                                        <select class="form-control form-control-sm" required
                                            name="akun_transaksi_kredit"
                                            style="height:30px; font-size:smaller; padding-top:3px;">
                                            <option value="1-10001">(1-10001)-Kas</option>
                                            <option value="1-10002">(1-10002)-Rekening Bank</option>
                                        </select>

                                    </div>

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">
                                            {{ \Helper::rupiah($sisa_tagihan) }}</h3>
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

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-6 col-sm-12  d-flex justify-content-end">
                                        <div class="form-group pr-5 col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>No Transaksi</b> <i
                                                    class="fas fa-cog" data-toggle="tooltip" data-title="test"></i>
                                            </label>
                                            <input type="text" class="form-control" placeholder="[Auto]"
                                                name="no_transaksi"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;">
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tag (Optional)</b></label>
                                            <input type="text" class="form-control" name="tag"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
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
                                            <th style="font-size:smaller;" class="text-capitalize">Tgl Jatuh Tempo</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Total</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-left">Sisa
                                                Tagihan
                                            </th>
                                            <th style="font-size:smaller;" class="text-capitalize text-left">Jumlah
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk">
                                        <tr>
                                            <td><a
                                                    href="{{ route('pembelian.show',$detail->id) }}">{{ $detail->no_transaksi }}<input
                                                        name="no_transaksi_pembelian"
                                                        value="{{ $detail->no_transaksi }}" type="hidden"></a></td>
                                            <td></td>
                                            <td>{{ $detail->tgl_jatuh_tempo }}</td>
                                            <td>{{ \Helper::rupiah($detail->total) }}</td>
                                            <td>{{ \Helper::rupiah($sisa_tagihan) }}</td>

                                            <td><input type="text" name="jumlah_pembayaran" value="{{ $sisa_tagihan }}"
                                                    class="form-control form-control-sm"> </td>

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

                                            <b>{{ \Helper::rupiah($sisa_tagihan) }}</b>
                                        </div>



                                    </div>

                                </div>

                            </div>

                            <div class="row justify-content-end col-12">

                                <button type="submit" class="btn btn-md btn-success hasil">Buat Pembayaran</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endsection

        @push('custom-scripts')
            @include('pembelian.js.pembelian_payment_js')

        @endpush
