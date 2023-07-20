@extends('layout.app', [

])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:80px;">
                    <div class="d-flex justify-content-between">
                        <h4 style="margin-top:-1px;">Buat Jurnal Umum</h4>
                       
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
                        <form id="form_jurnal" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">

                                <div class="row">
                                    <input type="hidden" name="tipe_pembelian" value="1"/>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>No Transaksi</b></label>
                                        <br>
                                        <input type="text" class="form-control" placeholder="No Transaksi Otomatis" name="no_transaksi" 
                                        style="height:30px; font-size:smaller; padding-top:3px;"/>
                                       
                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Tgl Transaksi</b></label>
                                        <input type="date" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" name="tgl_transaksi"
                                            style="height:30px; font-size:smaller; padding-top:3px;" />

                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Status Jurnal</b></label>
                                        <select name="status_jurnal" class="form-control" required
                                            style="height:30px; font-size:smaller; padding-top:3px;" >
                                                <option value="">-- Pilih Status Jurnal --</option>
                                                <option value="1">Pengeluaran</option>
                                                <option value="2">Pemasukan</option>
                                                </select>   
                                    </div>

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">Rp. 0,00</h3>
                                    </div>
                               



                                </div>


                            </div>

                            <div class="row col-12 justify-content-between">
                                <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                    <table class="table table-striped table-hover" id="table_jurnal"
                                        style="overflow: scroll; overflow-x:auto;">
                                        <thead style="background-color:aliceblue;" class="text-lowercase">
                                            <tr>
                                                <th style="font-size:smaller;" class="text-capitalize">Akun</th>
                                                <th style="font-size:smaller;" class="text-capitalize">Deskripsi</th>
                                                <th style="font-size:smaller;" class="text-capitalize">Debit</th>
                                                <th style="font-size:smaller;" class="text-capitalize">Kredit</th>
                                                <th style="font-size:smaller;" class="text-capitalize text-right">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="isi_jurnal">
                                            <tr>
                                                <td style="width:30%;" class="anak">
                                                    <select name="akun[]" required data-live-search="true"
                                                        class="form-control selectpicker" title="-- Pilih Akun --"
                                                        style="background-color:white;"
                                                        style="height:30px; font-size:smaller; padding-top:3px;">
                                                        @foreach($akun as $i)
                                                            <option data-tokens="{{ $i->nama_akun }}"
                                                                value="<?= $i->id ?>">
                                                                ( {{ $i->nama_akun  }} | {{ $i->kode_akun}} )
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="width:15%;"><input type="text" class="form-control form-control-sm deskripsi" name="deskripsi"></td>
                                                <td style="width: 15%;">
                                                    <input type="text" required class="form-control form-control-sm debit"
                                                        style="height:30px; font-size:smaller; padding-top:3px;"
                                                        name="debit[]" />
                                                </td>
                                                <td style="width: 15%;">
                                                    <input type="text" required name="kredit[]" class="form-control kredit"
                                                        style="height:30px; font-size:smaller; padding-top:3px;">
                                                </td>
                                             
                                              
                                                <td class="text-center" style="width:5%;">
                                                    <span style="cursor: pointer;"
                                                        class="fas fa-trash text-danger hapus_baris"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width:30%;" class="anak">
                                                    <select name="akun[]" required data-live-search="true"
                                                        class="form-control selectpicker" title="-- Pilih Akun --"
                                                        style="background-color:white;"
                                                        style="height:30px; font-size:smaller; padding-top:3px;">
                                                        @foreach($akun as $i)
                                                            <option data-tokens="{{ $i->nama_akun }}"
                                                                value="<?= $i->id ?>">
                                                                ( {{ $i->nama_akun  }} | {{ $i->kode_akun}} )
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="width:15%;"><input type="text" class="form-control form-control-sm deskripsi" name="deskripsi"></td>
                                                <td style="width: 15%;">
                                                    <input type="text" required class="form-control form-control-sm debit"
                                                        style="height:30px; font-size:smaller; padding-top:3px;"
                                                        name="debit[]" />
                                                </td>
                                                <td style="width: 15%;">
                                                    <input type="text" required name="kredit[]" class="form-control kredit"
                                                        style="height:30px; font-size:smaller; padding-top:3px;">
                                                </td>
                                             
                                              
                                                <td class="text-center" style="width:5%;">
                                                    <span style="cursor: pointer;"
                                                        class="fas fa-trash text-danger hapus_baris"></span>
                                                </td>
                                            </tr>
    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <th> Total Debit : <span class="total_debit">Rp. 0,00</span><input type="hidden" name="total_debit_int"></th>
                                                <th> Total Kredit: <span class="total_kredit">Rp. 0,00</span><input type="hidden" name="total_kredit_int"></th>

                                            </tr>
                                        </tfoot>
                                    </table>
    
    
                                </div>
                              




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

                                   
                                </div>

                            </div>

                            <div class="row justify-content-end col-12 mb-4">

                                <button type="submit" class="btn btn-success hasil">Buat Jurnal Umum</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
     
    @endsection

    @push('custom-scripts')
    @include('jurnal.js.jurnal_js')
    @endpush
         
        