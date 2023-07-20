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
                            <b>Buat Retur Pembelian</b><br>
                            <button class="btn btn-danger btn-sm" id="btnBack">Kembali ke faktur</button>
                        </div>
                        <h4 style="margin-top:-1px;">Retur Pembelian</h4>
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
                        <form id="form_retur" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">

                                <div class="row">
                                    <input type="hidden" name="id_pembelian" value="{{ $data_pembelian->id }}" />
                                    <input type="hidden" name="status_retur" value="1" />
                                    <input type="hidden" name="id_kontak" value="{{ $kontak->id }}" />
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        {{ $kontak->nama_kontak }}
                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>No faktur</b></label>
                                        <br>
                                        <b><a class="nav-widget" style="color:blue"
                                                href="{{ url('pembelian/'.$data_pembelian->id) }}">{{ $data_pembelian->no_transaksi }}</a></b>
                                                <br>
                                                {{ \Pembelian_helper::get_status_name($data_pembelian->status_pembelian) }}

                                                <input type="hidden" name="status_pembelian" value="{{ $data_pembelian->status_pembelian }}">

                                    </div>

                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Gudang</b></label>
                                        <br>
                                        <b>
                                            {{ $data_pembelian->gudang->nama_gudang }}</b>
                                        <input type="hidden" name="gudang_id"
                                            value="{{ $data_pembelian->gudang->id }}" />
                                    </div>


                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_retur">0</h3>
                                    </div>
                                    <input type="hidden" name="akun_transaksi_kredit" value="2-20100" />
                                    <input type="hidden" name="akun_transaksi_debit" value="1-10200" />



                                </div>


                            </div>

                            <div class="row justify-content-end mr-4 mt-3">

                                @if($data_pembelian->pajak == 0)
                                    <b>Tidak Termasuk Pajak</b>

                                    <input type="hidden" name="tipe_pajak" value="{{ $data_pembelian->pajak }}">
                                @elseif($data_pembelian->pajak == 1)
                                    <b>Termasuk Pajak</b>
                                    <input type="hidden" name="tipe_pajak" value="{{ $data_pembelian->pajak }}">
                                @endif
                            </div>
                            <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                <table class="table table-striped table-hover" id="table_pembelian"
                                    style="overflow: scroll; overflow-x:auto;">
                                    <thead style="background-color:aliceblue;" class="text-lowercase">
                                        <tr>
                                            <th style="font-size:smaller;" class="text-capitalize">Produk</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Qty Faktur</th>
                                            <th style="font-size:smaller; width:10%;" class="text-capitalize">Yang Bisa
                                                Diretur
                                            </th>
                                            <th style="font-size:smaller;" class="text-capitalize">Qty Retur</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Satuan</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Harga
                                                Satuan</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Pajak</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Jumlah
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk_retur">
                                        @foreach($detail_pembelian as $i)
                                            <tr>
                                                <td style="width:17%;" class="anak">
                                                    <input type="hidden" name="jenis_retur" value="faktur" />
                                                    <input type="hidden" name="id_produk[]"
                                                        value="{{ $i->detail_produk->id }}">
                                                    {{ $i->detail_produk->nama_produk }}
                                                </td>

                                                <td style="width: 5%;">
                                                    {{ $i->qty }}
                                                    <input type="hidden" name="qty" value="{{ $i->qty }}" />
                                                </td>
                                                <td style="width: 5%;">
                                                    @php
                                                        $qty_limit = $i->qty -
                                                        $Mretur->get_qty_retur($data_pembelian->no_transaksi,$i->product_id);
                                                    @endphp

                                                    {{ $qty_limit }}

                                                    <input type="hidden" name="qty_limit" value="{{ $qty_limit }}" />
                                                </td>
                                                <td style="width: 5%;"><input type="number" class="form-control"
                                                        name="qty_retur[]" value="0"></td>
                                                <td style="width: 7%;">
                                                    {{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}
                                                </td>
                                                <td class="text-right">
                                                    <input type="text" class="form-control text-right align-right "
                                                        readonly name="harga_satuan"
                                                        value="{{ \Helper::rupiah($i->harga_satuan) }}" />
                                                    <input type="hidden" name="harga_satuan_int[]"
                                                        class="harga_satuan_int" value="{{ $i->harga_satuan }}" />
                                                </td>
                                                <td class="text-right">{{ $i->pajak_id }} </td>
                                                <td>
                                                    <input type="text"
                                                        class="form-control form-control-sm text-right font-weight-bold subtotal"
                                                        style="height:30px; font-size:smaller; padding-top:3px;"
                                                        name="subtotal[]" placeholder="" value="0" />
                                                    <input type="hidden" name="subtotal_int[]" class="subtotal_int"
                                                        value="0">
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>





                            <div class="row">
                                <div class="row col-12 justify-content-between">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group col-lg-8 col-sm-12 float-left">
                                            <label for="suppliers" class="text-dark"><b>Pesan</b></label>
                                            <textarea placeholder="Isikan Pesan ..." id="suppliers" rows="3"
                                                class="form-control form-control-sm" name="pesan"></textarea>
                                        </div>
                                        <div class="form-group col-lg-8 col-sm-12 float-left">
                                            <label for="suppliers" class="text-dark"><b>Memo</b></label>
                                            <textarea placeholder="Isikan Memo ..." id="suppliers" rows="3"
                                                class="form-control form-control-sm" name="memo"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 text-right pr-5 justify-content-between">
                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Jumlah Faktur</b>
                                            <input type="hidden" name="sisa_tagihan" value="{{ $sisa_tagihan }}">

                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            {{ \Helper::rupiah($sisa_tagihan) }}
                                        </div>
                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            Sub Total
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left sub_total" id="subtotal">
                                            Rp. 0,00
                                        </div>

                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            PPN
                                            <input type="hidden" name="pajak_retur">
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left pajak" id="pajak">
                                            Rp. 0,00
                                        </div>

                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Total Retur</b>
                                            <input type="hidden" name="total_retur" />
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left font-weight-bold total_retur"
                                            id="total">

                                            Rp. 0,00
                                        </div>





                                    </div>

                                </div>

                            </div>

                            <div class="row justify-content-end col-12">

                                <button type="submit" class="btn btn-md btn-success hasil">Buat Retur Pembelian</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        @endsection
        @push('custom-scripts')
            @include('pembelian.js.retur_js');
        @endpush
