<div class="modal fade" id="create_kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_kategori">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-lg-4 col-form-label-md text-dark">Nama
                            Kategori</label>
                        <div class="col-sm-12">
                            <input type="text" name="nama_kategori"
                                class="form-control form-control-md @error('nama_kategori') is-invalid @enderror"
                                id="inputEmail3" placeholder="">
                        </div>
                        <br>
                        @error('nama_kategori')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>