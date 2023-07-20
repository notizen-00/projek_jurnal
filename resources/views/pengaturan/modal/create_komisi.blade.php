<div class="modal fade" id="create_komisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cog"></i> Buat Komisi Penjualan <span
                        class="detail_header"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_komisi">
                                <div class="error-container">
                                
                                </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama komisi</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_komisi" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Periode</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rule_periode" id="Periode1" value="1"
                                    checked>
                                <label class="form-check-label" for="Periode1">
                                    Selamanya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rule_periode" id="Periode2"
                                    value="2">
                                <label class="form-check-label" for="Periode2">
                                    Periode Tertentu
                                </label>
                            </div>

                            <div id="periode-tertentu" class="periode-tertentu" style="display:none;">
                                <label for="periode-start">Periode mulai</label>
                                <input type="date" id="periode-start" name="periode_mulai">
                                --
                                <label for="periode-end">Periode akhir</label>
                                <input type="date" id="periode-end" name="periode_akhir">
                            </div>

                        </div>
                    </div>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Berlaku Ke Tenaga</b></legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rule_sales" id="gridRadios1"
                                    value="1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Semua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rule_sales" id="gridRadios2"
                                    value="2">
                                <label class="form-check-label" for="gridRadios2">
                                    Tertentu
                                </label>
                            </div>

                            <div id="tenaga-tertentu" style="display:none;">
                                <select name="tenaga_tertentu[]" class="selectpicker form-select col-6" multiple>

                                    @foreach($sales as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_kontak }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Berlaku Untuk Penjualan Ke </b>
                        </legend>
                        <div class="form-check">
                            
                            <label class="form-check-label" for="gridCheck1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rule_penjualanke[]"
                                        id="inlineCheckbox1" checked value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rule_penjualanke[]"
                                        id="inlineCheckbox2" value="2">
                                    <label class="form-check-label" for="inlineCheckbox2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rule_penjualanke[]"
                                        id="inlineCheckbox3" value="3">
                                    <label class="form-check-label" for="inlineCheckbox3">3 </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rule_penjualanke[]"
                                        id="inlineCheckbox4" value="4">
                                    <label class="form-check-label" for="inlineCheckbox4">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="rule_penjualanke[]"
                                        id="inlineCheckbox5" value="5">
                                    <label class="form-check-label" for="inlineCheckbox5">5</label>
                                </div>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Berlaku Untuk Barang</b></legend>
                        <div class="col-sm-6">
                            <select name="rule_barang" class="form-control" required>
                                <option value="1">Semua Barang</option>
                                <option value="2">Barang Tertentu</option>
                            </select>
                            <div id="barang-tertentu" style="display:none; margin-top:2px;">
                                <select name="barang_tertentu[]" class="selectpicker form-select col-6" multiple>
                                    @foreach($barang as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Dari Pemasok </b></legend>
                        <div class="col-sm-6">
                            <select name="rule_pemasok" class="form-control" required>
                                <option value="1">Semua Pemasok</option>
                                <option value="2">Pemasok Tertentu</option>
                            </select>
                            <div id="pemasok-tertentu" style="display:none; margin-top:2px;">
                                <select name="pemasok_tertentu[]" class="selectpicker form-select col-6" multiple>
                                    @foreach($pemasok as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_kontak }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Dengan Syarat Perhitungan</b>
                        </legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rule_syarat_perhitungan"
                                    id="gridRadios1" value="1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Tanpa Batas Syarat
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <div class="row">
                                    <div class="col-4">
                                        <input class="form-check-input" type="radio" name="rule_syarat_perhitungan"
                                            id="gridRadios2" value="2">
                                        <label class="form-check-label" for="gridRadios2">
                                            Nilai Penjualan antara
                                        </label>
                                    </div>
                                    <div class="col-8 d-flex justify-content-between">
                                        <input type="text" name="rule_sp_2[]" class="form-control mr-2">
                                        s/d
                                        <input type="text" name="rule_sp_2[]" class="form-control ml-3">
                                    </div>
                                </div>

                            </div>

                            <div class="form-check mt-2">
                                <div class="row">
                                    <div class="col-4">
                                        <input class="form-check-input" type="radio" name="rule_syarat_perhitungan"
                                            id="gridRadios3" value="3">
                                        <label class="form-check-label" for="gridRadios3">
                                            Kuantitas penjualan antara
                                        </label>
                                    </div>
                                    <div class="col-8 d-flex justify-content-between">
                                        <input type="text" name="rule_sp_3[]" class="form-control mr-2">
                                        s/d
                                        <input type="text" name="rule_sp_3[]" class="form-control ml-3">
                                    </div>
                                </div>

                            </div>
                    </fieldset>

                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-3 float-sm-left pt-0"><b>Akan Mendapat Komisi </b></legend>
                        <div class="col-sm-3">
                            <select name="opsi_komisi" class="form-control" required>
                                <option value="">-- Pilih Opsi Komisi --</option>
                                <option value="1">Nilai Tetap</option>
                                <option value="2">Persentase</option>
                            </select>
                        </div>
                        <div class="col-sm-2 rule_komisi">


                        </div>
                        <div class="col-sm-3 setting_komisi">

                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-sm-10 justify-content-between">
                            <button type="submit" class="btn btn-primary">Buat Komisi</button>
                            <button type="button" class="btn btn-danger reset_form">Reset Form</button>
                        </div>
                        
                    </div>
                </form>

            </div>
            <div class="modal-footer">



            </div>
        </div>
    </div>
</div>
