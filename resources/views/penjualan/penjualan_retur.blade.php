
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:80px;">
                    <div class="d-flex justify-content-between">
                        <h4 style="margin-top:-1px;">Buat Retur Pembelian</h4>
                        
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

                                <div class="row">
                                    <input type="hidden" name="tipe_pembelian" value="1"/>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        <select name="supplier" data-live-search="true" class="selectpicker"
                                            title="-- Pilih Supplier --">
                                            @foreach($supplier as $i)
                                                <option data-tokens="{{ $i->nama_panggilan }}" value="{{ $i->id }}">
                                                    {{ $i->nama_panggilan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                 

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">Rp. 0,00</h3>
                                    </div>
                                    <input type="hidden" name="akun_transaksi_kredit" value="2-20100"/>
                                    <input type="hidden" name="akun_transaksi_debit" value="1-10200"/>



                                </div>


                            </div>

                            {{-- <div class="row col-12 justify-content-between">

                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Alamat</b></label>
                                        <textarea placeholder="Isikan Alamat ..." id="supplier" rows="3"
                                            class="form-control form-control-sm" name="alamat"></textarea>
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
                                        <input type="date" name="tgl_jatuh_tempo" value="{{ $tgl_jatuh_tempo }}"
                                            class="form-control" id="tgl_jatuh_tempo"
                                            style="height:35px; font-size:small; padding-top:3px;" />
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 float-right">
                                        <label for="supplier" class="text-dark"><b>Syarat Pembayaran</b></label>
                                        <select class="form-control" id="syarat_pembayaran" required
                                            name="syarat_pembayaran"
                                            style="height:35px; font-size:small; padding-top:3px;" id="tgl_transaksi">
                                            <option value="">-- Syarat Pembayaran --</option>
                                            <option value="1">Net</option>
                                            <option value="2">Cash On Delivery</option>
                                            <option value="3">Custom</option>
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
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>No referensi</b></label>
                                        <input type="text" class="form-control" name="no_referensi"
                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12 float-left">
                                        <label for="supplier" class="text-dark"><b>Gudang</b></label>
                                        <input type="text" class="form-control" name="gudang"
                                            style="height:30px; width:80%;   font-size:smaller; padding-top:3px;" />
                                    </div>

                                </div>




                            </div> --}}



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
                                            <th style="font-size:smaller;" class="text-capitalize text-right">Jumlah
                                            </th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk">
                                        <tr>
                                            <td style="width:17%;" class="anak">
                                            
                                            </td>
                                           
                                            <td style="width: 5%;">
                                                <input type="number" class="form-control form-control-sm qty"
                                                    style="height:30px; font-size:smaller; padding-top:3px;"
                                                    name="qty[]" />
                                            </td>
                                            <td style="width: 7%;">
                                                <input type="text" name="satuan[]" readonly class="form-control satuan"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    class="form-control form-control-sm text-right font-weight-bold harga_satuan"
                                                    style="height:30px; font-size:smaller; padding-top:3px;"
                                                    name="harga_satuan[]" placeholder="Rp. 0,00" />
                                                <input type="hidden" name="harga_satuan_int[]"
                                                    class="harga_satuan_int" />
                                            </td>
                                            <td>
                                                <input type="text"
                                                    class="form-control form-control-sm text-right font-weight-bold subtotal"
                                                    style="height:30px; font-size:smaller; padding-top:3px;"
                                                    name="subtotal[]" placeholder="Rp. 0,00" />
                                                <input type="hidden" name="subtotal_int[]" class="subtotal_int">
                                            </td>
                                           
                                        </tr>

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


                                        <div class="form-group col-lg-6 col-sm-12 float-left total_view" id="subtotal">
                                            Rp. 0,00
                                        </div>

                                        <div class="pr-5 col-lg-6 col-sm-12 float-left">
                                            <b>Total</b>
                                            <input type="hidden" name="total"/>
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left font-weight-bold total_view"
                                            id="total">
                                           
                                            Rp. 0,00
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

                            <div class="row justify-content-end col-12">

                                <button type="submit" class="btn btn-md btn-success hasil">Buat Retur Pembelian</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    
         
        