@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:130px;">

                    <a class="" href="{{ route('kontak.index') }}"><i class="fas fa-circle-arrow-left"></i> Kontak</a>
                    <div class="mb-3">
                        <h4>Buat Kontak Baru</h4>
                      
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
                <div class="col-md-12">
                    <div class="card">

                        <div class="ml-4 mt-4 d-flex justify-content-start">
                            <span class="far fa-2x fa-user mt-4"></span>
                            <h6 class=" ml-2" style="margin-top:30px;"><b>Info Kontak</b></h6>
                        </div>

                        <form id="form1" action="{{ route('kontak.store') }}" method="post" class="ml-4 mt-2">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Nama
                                    Panggilan *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_panggilan" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Nama Panggilan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Tipe
                                    Kontak *</label>
                                <div class="col-sm-4">
                                    <select required name="tipe_kontak" class="form-control form-control-md">
                                        <option value="">-- Tipe Kontak --</option>
                                        <option value="1">Pelanggan</option>
                                        <option value="2">Supplier</option>
                                        <option value="3">Karyawan</option>
                                    </select>
                                </div>
                            </div>




                            <div class="ml-4 mt-4 d-flex justify-content-start">
                                <span class="fas fa-2x fa-briefcase mt-4"></span>
                                <h6 class=" ml-2" style="margin-top:30px;"><b>Informasi Umum</b></h6><br>
                                <div style="margin-top:30px; margin-left:10px;"><small>(optional)</small></div>
                            </div>



                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Nama
                                    Kontak *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_kontak" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Nama Kontak">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Handphone </label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_hp" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Handphone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">No Identitas
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_identitas" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Identitas ( KTP/SIM/Passport )">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Email </label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Nama Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_perusahaan" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="Nama Perusahaan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">NPWP </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-md @error('npwp') is-invalid @enderror" name="npwp" id="inputEmail3"
                                        placeholder="NPWP">
                                </div>
                            </div>
                            <br>
                                @error('npwp')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Alamat </label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="alamat" class="form-control form-control-md @error('alamat') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Alamat Kontak"></textarea>
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

                            <div class="ml-4 mt-4 d-flex justify-content-start">
                                <span class="fas fa-2x fa-bank mt-4"></span>
                                <h6 class=" ml-2" style="margin-top:30px;"><b>Daftar Bank</b></h6><br>
                                <div style="margin-top:30px; margin-left:10px;"><small>(optional)</small></div>
                            </div>


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Nama
                                    Bank *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_bank"
                                        class="form-control form-control-md @error('nama_bank') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Nama Bank">
                                </div><br>
                                @error('nama_bank')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">No Rekening
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_rekening" class="form-control form-control-md"
                                        id="inputEmail3" placeholder="No rekening">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Nama Pemegang
                                    Rekening
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pemegang_rekening"
                                        class="form-control form-control-md" id="inputEmail3"
                                        placeholder="Nama Pemegang Rekening">
                                </div>
                            </div>
                            <input type="hidden" name="status_kontak" value="1">


                            <div class="col-6 ml-auto mr-auto">
                                <button type="submit"
                                    class="btn btn-block btn-md btn-primary simpan_account">Simpan</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
        @endsection

        @push('scripts')
        <script>
        // $(".simpan_account").click(function(e) {

        //     var form1 = $('#form1').serialize();
        //     var form2 = $('#form2').serialize();
        //     var form3 = $("#form3").serialize();

        //     var form = form1 + "&" + form2 + "&" + form3;

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: "{{ route('kontak.store') }}",
        //         method: 'post',
        //         data: form,
        //         success: function(data) {
        //             console.log(data);
        //         }


        //     })

        // })
        </script>
        @endpush