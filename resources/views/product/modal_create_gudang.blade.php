<div class="modal fade" id="create_gudang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-warehouse"></i> Buat Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_gudang">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-lg-4 col-form-label-md text-dark">Nama
                            Gudang</label>
                        <div class="col-sm-12">
                            <input type="text" name="nama_gudang"
                                class="form-control form-control-md @error('nama_gudang') is-invalid @enderror"
                                id="inputEmail3" placeholder="">
                        </div>
                        <br>
                        @error('nama_gudang')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-lg-4 col-form-label-md text-dark">Alamat Gudang</label>
                        <div class="col-sm-12">
                            <input type="text" name="alamat"
                                class="form-control form-control-md @error('alamat') is-invalid @enderror"
                                id="inputEmail3" placeholder="">
                        </div>
                        <br>
                        @error('alamat')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-lg-4 col-form-label-md text-dark">Keterangan (optional)</label>
                        <div class="col-sm-12">
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="isikan keterangan ..."></textarea>
                        </div>
                        <br>
                        @error('keterangan')
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

                <button type="submit" class="btn btn-primary">Buat Gudang</button>
                </form>
            </div>
        </div>
    </div>
</div>