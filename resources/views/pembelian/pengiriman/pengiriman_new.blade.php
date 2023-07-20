@extends('layout.app', [

])

@section('content')

<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:120px;">

                    <div class="row col-12 justify-content-between">

                        <div class="col-6">
                            <a class="" href="{{ route('pembelian.index') }}"><i
                                    class="fas fa-circle-arrow-left"></i>Transaksi Pembelian</a>
                            <div class="mb-3">
                                <h3 class="" style="color:#0335a1">Buat Pengiriman Pembelian</h3>
                            </div>
                        </div>
                        <div class="col-6 text-right">

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
            </div>


            <form id="form_pengiriman">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="jumlah_transaksi" value="{{ $detail->total }}">
                        <input type="hidden" name="no_transaksi_pemesanan" value="{{ $detail->no_transaksi }}">
                        <input type="hidden" name="kontak_id" value="{{ $kontak->id }}">
                        <input type="hidden" name="tipe_pembelian" value="3">
                        <div class="card">
                            <table class="table" style="border:none;">
                                <thead style="background-color:#c5f5fa" class="text-capitalize" height="100px">
                                    <tr>
                                        <th class="text-capitalize " width="10%">Supplier </th>
                                        <th class="text-capitalize text-left" width="20%"> <a
                                                href="{{ route('kontak.show',$kontak->id) }}">{{ $kontak->nama_panggilan }}</a>
                                        </th>
                                        <th class="text-left text-capitalize" width="10%">Email </th>
                                        <th class="text-left text-capitalize text-muted" width="20%">
                                            {{ $kontak->email }}
                                        </th>
                                        <th class="text-right text-capitalize" width="50%">

                                            @if($detail->tag != '')
                                                <span class="badge badge-primary"><i class="fas fa-tag"></i>
                                                    {{ $detail->tag }}</span>
                                            @else
                                                <span class="badge badge-primary"><i class="fas fa-tag"></i> --</span>
                                            @endif
                                            <h3 class="" style="color:#429ffc">
                                            </h3>

                                        </th>
                                    </tr>
                                </thead>

                            </table>
                            <div class="card-body">
                                <div class="row col-12 justify-content-between">

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group col-lg-4 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tgl Transaksi</b></label>
                                            <input type="date" name="tgl_transaksi" readonly
                                                value="{{ $detail->tgl_transaksi }}"
                                                class="form-control form-control-sm"
                                                style="height:35px; font-size:small; padding-top:3px;"
                                                id="tgl_transaksi" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 pr-5 justify-content-around">
                                        <div class="form-group pr-5 col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>No Transaksi Pemesanan</b> <i
                                                    class="fas fa-cog" data-toggle="tooltip" data-title="test"></i>
                                            </label><br>
                                            <a href="{{ secure_url('') }}"
                                                class="">{{ $detail->no_transaksi }}</a>
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tag (Optional)</b></label>
                                            <input type="text" class="form-control" name="tag"
                                                value="{{ $detail->tag }}"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                        </div>

                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>No referensi</b></label>
                                            <input type="text" class="form-control"
                                                value="{{ $detail->no_referensi }}" name="no_referensi"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                        </div>

                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Gudang</b></label>
                                            <input type="hidden" name="gudang_id" value="{{ $detail->gudang->id }}">
                                            <input type="text" class="form-control" name="gudang" readonly
                                                value="{{ $detail->gudang->nama_gudang }}"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                        </div>





                                    </div>




                                </div>

                                <div class="">

                                    <table class="table" style="border:none;">
                                        <thead style="background-color:#c5f5fa" class="text-capitalize" height="10px">
                                            <tr>
                                                <th class="text-capitalize" style="font-size:small;">Produk</th>
                                                <th class="text-capitalize" style="font-size:small; width:60%;">
                                                    Deskripsi
                                                </th>
                                                <th class="text-capitalize text-right"
                                                    style="font-size:small; width:10%;">
                                                    Kuantitas</th>
                                                <th class="text-capitalize text-right"
                                                    style="font-size:small; width:10%;">
                                                    Satuan</th>

                                            </tr>
                                        </thead>
                                        <tbody class="detail_pembelian">

                                            @foreach($detail_pembelian as $i)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id_produk[]"
                                                            value="{{ $i->product_id }}">
                                                        <input type="text" readonly
                                                            value="{{ $i->detail_produk->nama_produk }}"
                                                            class="form-control">

                                                    </td>
                                                    <td><input type="text" name="deskripsi" class="form-control"></td>
                                                    <td class="text-right" style="width:10%;"><input type="number"
                                                            class="form-control form-control-sm col-6" name="qty[]"
                                                            value="{{ $i->qty }}" style="margin-left:100px;"><br>
                                                    </td>
                                                    <td class="text-right">
                                                        {{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row col-12 justify-content-between">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group col-lg-8 col-sm-12 float-left">
                                <label for="suppliers" class="text-dark"><b>Pesan</b></label>
                                <textarea placeholder="Isikan Pesan ..." id="Pesan" rows="3"
                                    class="form-control form-control-sm" name="pesan"></textarea>
                            </div>
                            <div class="form-group col-lg-8 col-sm-12 float-left">
                                <label for="suppliers" class="text-dark"><b>Memo</b></label>
                                <textarea placeholder="Isikan Memo ..." id="Memo" rows="3"
                                    class="form-control form-control-sm" name="memo"></textarea>
                            </div>
                        </div>



                    </div>

                </div>

                <div class="row justify-content-end col-12 mb-4">

                    <button type="submit" class="btn btn-success hasil">Buat Pengiriman Pembelian</button>

                </div>



            </form>

        </div>

        @include('pembelian.modal.modal_jurnal');
        @endsection
        @push('custom-scripts')
            @include('pembelian.js.pengiriman_new_js');
        @endpush
