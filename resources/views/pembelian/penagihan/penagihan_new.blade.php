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
                            <h4 style="margin-top:-1px;">Buat Penagihan Pembelian</h4>
                            <button class="btn btn-danger btn-sm btnBack">Kembali</button>
                        </div>
                        <select class="col-2 form-control">
                            <option>Penagihan Pembelian</option>

                        </select>
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
                        <form id="form_pembelian" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">
                                <input type="hidden" name="kontak_id" value="{{ $kontak->id }}">
                                <div class="row">
                                    <input type="hidden" name="tipe_pembelian" value="1" />
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        <input type="text" value="{{ $kontak->nama_kontak }}" readonly
                                            class="form-control form-control-sm" name="nama_kontak"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />

                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Email</b></label>
                                        <input type="email" value="{{ $kontak->email }}" readonly
                                            class="form-control form-control-sm" name="email"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />

                                    </div>

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">
                                            {{ \Helper::rupiah($pembelian->total) }}</h3>
                                    </div>
                                    <input type="hidden" name="akun_transaksi_kredit" value="2-20100" />
                                    <input type="hidden" name="akun_transaksi_debit" value="1-10200" />



                                </div>


                            </div>

                            <div class="row col-12 justify-content-between">

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Alamat</b></label>
                                        <textarea placeholder="Isikan Alamat ..." readonly id="supplier" rows="3"
                                            class="form-control form-control-sm"
                                            name="alamat">{{ $kontak->alamat }}</textarea>
                                    </div>


                                    <div class="form-group col-lg-4 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Tgl Transaksi</b></label>
                                        <input type="date" name="tgl_transaksi"
                                            value="{{ date('Y-m-d') }}"
                                            class="form-control form-control-sm"
                                            style="height:35px; font-size:small; padding-top:3px;" id="tgl_transaksi" />
                                    </div>


                                    <div class="form-group col-lg-4 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Tgl Jatuh Tempo</b></label>
                                        <input type="date" name="tgl_jatuh_tempo" value="" class="form-control"
                                            id="tgl_jatuh_tempo"
                                            style="height:35px; font-size:small; padding-top:3px;" />
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 float-right">
                                        <label for="supplier" class="text-dark"><b>Syarat Pembayaran</b></label>
                                        <select class="form-control" id="syarat_pembayaran" required
                                            name="syarat_pembayaran"
                                            style="height:35px; font-size:small; padding-top:3px;" id="tgl_transaksi">
                                            <option value="">-- Syarat Pembayaran --</option>
                                            <option value="1">C.O.D</option>
                                            <option value="2">Set Manual</option>
                                            <option value="3" selected>Net 30</option>
                                            <option value="4">Net 60</option>
                                        </select>
                                    </div>


                                </div>

                                <div class="col-lg-6 col-sm-12 pr-5 justify-content-around">
                                    <div class="form-group pr-5 col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>No Transaksi</b> <i
                                                class="fas fa-cog" data-toggle="tooltip" data-title="test"></i> </label>
                                        <input type="text" class="form-control" placeholder="[Auto]" name="no_transaksi"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;">
                                    </div>


                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Tag (Optional)</b></label>
                                        <input type="text" class="form-control" name="tag"
                                            value="{{ $pembelian->tag }}"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>No referensi</b></label>
                                        <input type="text" class="form-control" value="{{ $pembelian->no_referensi }}"
                                            name="no_referensi"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Gudang</b></label>
                                        <input type="text" value="{{ $pembelian->gudang->nama_gudang }}" readonly
                                            class="form-control form-control-sm"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Pengiriman</b></label>
                                        <input type="text" value="{{ $no_pengiriman }}" readonly
                                            class="form-control form-control-sm"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />
                                    </div>

                                </div>




                            </div>


                            <div class="row justify-content-end mr-4">

                                <input type="checkbox" name="toggle_pajak" id="toggle_pajak" checked
                                    data-toggle="toggle" data-width="200" data-height="20"
                                    data-on="Tidak Termasuk Pajak" data-off="Harga Termasuk Pajak" data-onstyle="danger"
                                    data-offstyle="success">


                            </div>
                            <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                <table class="table table-striped table-hover" id="table_pembelian"
                                    style="overflow: scroll; overflow-x:auto;">
                                    <thead style="background-color:aliceblue;" class="text-lowercase">
                                        <tr>
                                            <th style="font-size:smaller;" class="text-capitalize">Produk</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Kuantitas</th>
                                            <th style="font-size:smaller;" class="text-capitalize">Satuan</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Harga
                                                Satuan</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Pajak</th>
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Total
                                                Harga
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk">
                                        @foreach($detail_pembelian as $i)
                                            <tr>
                                                <td><a
                                                        href="{{ route('product.show',$i->product_id) }}">{{ $i->detail_produk->nama_produk }}</a>
                                                </td>

                                                <td>{{ $i->qty }}</td>
                                                <td>{{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}
                                                </td>
                                                <td class="text-right">{{ \Helper::rupiah($i->harga_satuan) }}
                                                </td>
                                                <td class="text-right">{{ $i->pajak_id }}</td>
                                                <td class="text-right"><input type="hidden" class="subtotal_int"
                                                        value="{{ $i->jumlah }}">{{ \Helper::rupiah($i->harga_satuan * $i->qty) }}
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
                                            SubTotal
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left total_subtotal"
                                            id="subtotal">
                                            {{ \Helper::rupiah($subtotal) }}
                                        </div>
                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            PPN
                                            <input type="hidden" name="pajak">
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left total_pajak" id="pajak">
                                            {{ \Helper::rupiah($pajak) }}


                                        </div>

                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Total</b>
                                            <input type="hidden" name="total" />
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left font-weight-bold total_view"
                                            id="total">

                                            {{ \Helper::rupiah($pembelian->total) }}
                                        </div>

                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Jumlah Pemotongan</b>
                                            <br>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="0"
                                                    aria-label="Recipient's username with two button addons"
                                                    aria-describedby="button-addon4">
                                                <div class="input-group-append" id="button-addon4">
                                                    <button class="btn btn-outline-secondary" type="button">%</button>
                                                    <button class="btn btn-outline-secondary" type="button">Rp</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-sm-12 float-right font-weight-bold jumlah_pemotongan"
                                            >

                                            Rp.0,00
                                        </div>

                                        <div class="pr-5 col-lg-6 mt-3 col-sm-12 float-left" style="font-size: large;">
                                            <b>Sisa Tagihan</b>
                                            <input type="hidden" name="sisa_tagihan" />
                                        </div>
                                        <div class="form-group mt-3 col-lg-6 col-sm-12 float-left total_view">

                                            <b>Rp. 0,00</b>
                                        </div>



                                    </div>

                                </div>

                            </div>

                            <div class="row justify-content-end col-12 mb-4">

                                <button type="submit" class="btn btn-success hasil">Buat Penagihan Pembelian</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        @endsection

        @push('custom-scripts')
            @include('pembelian.js.penagihan_js')
            @include('pembelian.js.supplier_js')
        @endpush
