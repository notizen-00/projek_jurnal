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
                        <h4>Edit Kontak</h4>
                      
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

                        <form id="form1" action="{{ route('kontak.update',$detail->id) }}" method="post" class="ml-4 mt-2">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Nama
                                    Panggilan *</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_panggilan" class="form-control form-control-md @error('nama_panggilan') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Nama Panggilan" value="{{ $detail->nama_panggilan }}">
                                </div>
                                @error('nama_panggilan')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Tipe
                                    Kontak * <small class=""> {{ Helper::tipe_kontak($detail->tipe_kontak) }}</small></label>
                                <div class="col-sm-4">
                                       
                                    <select required name="tipe_kontak" class="form-control form-control-md @error('tipe_kontak') is-invalid @enderror">
                                        @if($detail->tipe_kontak == 1)
                                        <option value="">-- Tipe Kontak --</option>
                                        <option value="1" selected>Pelanggan</option>
                                        <option value="2">Supplier</option>
                                        <option value="3">Karyawan</option>
                                        @endif
                                        @if($detail->tipe_kontak == 2)
                                        <option value="">-- Tipe Kontak --</option>
                                        <option value="1">Pelanggan</option>
                                        <option value="2" selected>Supplier</option>
                                        <option value="3">Karyawan</option>
                                        @endif
                                        @if($detail->tipe_kontak == 3)
                                        <option value="">-- Tipe Kontak --</option>
                                        <option value="1">Pelanggan</option>
                                        <option value="2">Supplier</option>
                                        <option value="3" selected>Karyawan</option>
                                        @endif
                                    </select>
                                    
                                </div>
                                @error('tipe_kontak')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
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
                                    <input type="text" name="nama_kontak" value="{{ $detail->nama_kontak }}" class="form-control form-control-md @error('nama_kontak') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Nama Kontak">
                                </div>
                                @error('nama_kontak')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Handphone </label>
                                <div class="col-sm-6">
                                    <input type="text" value="{{ $detail->no_hp }}" name="no_hp" class="form-control form-control-md @error('no_hp') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Handphone">
                                </div>
                                @error('no_hp')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">No Identitas
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" value="{{ $detail->no_identitas }}" name="no_identitas" class="form-control form-control-md @error('no_identitas') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Identitas ( KTP/SIM/Passport )">
                                </div>
                                @error('no_identitas')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Email </label>
                                <div class="col-sm-6">
                                    <input type="email" value="{{ $detail->email }}" name="email" class="form-control form-control-md @error('email') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Nama Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" value="{{ $detail->nama_perusahaan }}" name="nama_perusahaan" class="form-control form-control-md @error('nama_perusahaan') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Nama Perusahaan">
                                </div>
                                @error('nama_perusahaan')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">NPWP </label>
                                <div class="col-sm-6">
                                    <input type="text" value="{{ $detail->npwp }}" class="form-control form-control-md @error('npwp') is-invalid @enderror" name="npwp" id="inputEmail3"
                                        placeholder="NPWP">
                                </div>
                                @error('npwp')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Alamat </label>
                                <div class="col-sm-6">
                                    <textarea type="text"  name="alamat" class="form-control form-control-md @error('alamat') is-invalid @enderror"
                                        id="inputEmail3" placeholder="Alamat Kontak">{{ $detail->alamat }}</textarea>
                                </div>
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
                                    <input type="text" name="nama_bank" value="{{ $detail->nama_bank }}"
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
                                    <input type="text" value="{{ $detail->no_rekening }}" name="no_rekening" class="form-control form-control-md @error('no_rekening') is-invalid @enderror"
                                        id="inputEmail3" placeholder="No rekening">
                                </div>
                                @error('no_rekening')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label text-dark">Nama Pemegang
                                    Rekening
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pemegang_rekening" value="{{ $detail->nama_pemegang_rekening }}"
                                        class="form-control form-control-md @error('nama_pemegang_rekening') is-invalid @enderror" id="inputEmail3"
                                        placeholder="Nama Pemegang Rekening">
                                </div>
                                @error('nama_pemegang_rekening')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" name="status_kontak" value="1">


                            <div class="col-6 ml-auto mr-auto">
                                <button type="submit"
                                    class="btn btn-block btn-md btn-primary simpan_account">Update</button>
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