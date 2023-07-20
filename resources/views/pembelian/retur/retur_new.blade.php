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
                            <a href="{{ route('retur.list') }}" class="btn btn-danger btn-sm" >Kembali ke List</a>
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

                                    <input type="hidden" name="id_pembelian"  />
                                    <input type="hidden" name="status_retur" />
                                   
                               
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        <select name="id_kontak" data-live-search="true" class="selectpicker"
                                            title="-- Pilih Supplier --">
                                            @foreach($supplier as $i)
                                                <option data-tokens="{{ $i->nama_panggilan }}" value="{{ $i->id }}">
                                                    {{ $i->nama_panggilan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                   

                                    <input type="hidden" name="tipe_pajak">

                                    
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12 float-left ui-widget">
                                        <label for="no_referensi" class="text-dark"><b>No Referensi / No Transaksi</b> <i
                                                class="fas fa-search" data-toggle="tooltip" data-title="test"></i>
                                        </label>
                                        <input type="text" class="form-control" id="search_retur" placeholder="ketikan no referensi"
                                            name="no_transaksi"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;">
                                    </div>


                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">Rp. 0,00</h3>
                                    </div>
                                    <input type="hidden" name="akun_transaksi_kredit" value="2-20100" />
                                    <input type="hidden" name="status_retur" value="1"/>
                                    <input type="hidden" name="akun_transaksi_debit" value="1-10200" />



                                </div>


                            </div>

                            <div class="row justify-content-end mr-4 mt-3">
                                <input type="hidden" name="gudang_id"/>
                                <div class="tipe_pajak">
                                   

                                </div>
                                {{-- @if($data_pembelian->pajak == 0)
                                    <b>Tidak Termasuk Pajak</b>

                                    <input type="hidden" name="tipe_pajak" value="{{ $data_pembelian->pajak }}">
                                @elseif($data_pembelian->pajak == 1)
                                    <b>Termasuk Pajak</b>
                                    <input type="hidden" name="tipe_pajak" value="{{ $data_pembelian->pajak }}">
                                @endif --}}
                            </div>


                            <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                <table class="table table-striped table-hover" id="table_retur"
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
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk_retur">
                                       

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

                                    <div class="col-lg-6 col-sm-12 text-right justify-content-between">
                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Jumlah Faktur</b>
                                            <input type="hidden" name="sisa_tagihan" >

                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left sisa_tagihan">
                                            Rp.0,00
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

                            <div class="row justify-content-end col-12 mb-3 mr-2">

                                <button type="submit" class="btn btn-md btn-success hasil">Buat Retur Pembelian</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endsection
        @push('custom-scripts')
            @include('pembelian.js.retur_new_js');
            {{-- @include('pembelian.js.retur_js'); --}}
        @endpush
