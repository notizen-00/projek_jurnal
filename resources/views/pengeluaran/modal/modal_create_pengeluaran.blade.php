<div class="modal fade" id="create_pengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cog"></i> Buat Pengeluaran <span
                        class="detail_header"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_komisi">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama komisi</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_komisi" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="periode" id="Periode1" value="1"
                                    checked>
                                <label class="form-check-label" for="Periode1">
                                    Selamanya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="periode" id="Periode2" value="2">
                                <label class="form-check-label" for="Periode2">
                                    Periode Tertentu
                                </label>
                            </div>

                            <div id="periode-tertentu" style="display:none;">
                                <label for="periode-start">Periode mulai</label>
                                <input type="date" id="periode-start" name="periode-mulai">
                                --
                                <label for="periode-end">Periode akhir</label>
                                <input type="date" id="periode-end" name="periode-akhir">
                            </div>

                        </div>
                    </div>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Berlaku Ke Tenaga</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                    value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Semua
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                    value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Tertentu
                                </label>
                            </div>

                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
  <label class="form-check-label" for="inlineCheckbox1">1</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
  <label class="form-check-label" for="inlineCheckbox2">2</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
  <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
</div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Buat Komisi</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">



            </div>
        </div>
    </div>
</div>
