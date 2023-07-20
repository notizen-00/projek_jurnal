@extends('layout.app', [
])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:130px;">

                    <a class="" href="{{ route('product.index') }}"><i class="fas fa-circle-arrow-left"></i>Produk</a>
                    <div class="mb-3">
                        <h4>Edit Produk : {{ $detail->nama_produk }}</h4>

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

                            <h6 class=" ml-2 text-capitalize" style="padding-top:20px;"><b>Info Produk / Service</b>
                            </h6>
                        </div>

                        <form id="form1" action="{{ route('product.update',$detail->id) }}" method="post"
                            enctype="multipart/form-data" class="ml-4 mt-2">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Gambar
                                    (optional)</label>
                                <div class="col-sm-4">
                                    <a href="#" class="btn btn-info border">Upload Image <i
                                            class="fas fa-upload"></i></a>
                                    <input type="file" style="cursor:pointer height:10px;" name="gambar"
                                        class="form-control-file col-9 @error('gambar') is-invalid @enderror"
                                        id="inputEmail3">
                                </div>

                                <br>
                                @error('gambar')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror

                            </div>
                            <div class="row justify-content-end mb-2 col-3">
                                <img id="ImgPreview">
                                <div class="preview ml-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Nama
                                    Produk *</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nama_produk"
                                        class="form-control form-control-md @error('nama_produk') is-invalid @enderror"
                                        id="inputEmail3" value="{{ $detail->nama_produk }}" placeholder="">
                                </div>
                                <br>
                                @error('nama_produk')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail32" class="col-sm-2 col-form-label-md text-dark">Kode / SKU
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="kode_barang"
                                        class="form-control form-control-md @error('kode_barang') is-invalid @enderror"
                                        id="inputEmail32" {{ $detail->kode_produk }} placeholder="">
                                </div>
                                <br>
                                @error('kode_barang')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Kategori
                                </label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="kat_field" value="{{ $detail->kategori_produk_id }}">
                                    <select name="kategori" data-live-search="true"
                                        data-header="<a style='font-size:smaller; cursor:pointer' onclick='modal_kategori()'><i class='fas fa-plus'></i>Tambah Kategori</a>"
                                        class="form-control selectpicker @error('kategori') is-invalid @enderror"
                                        title="Kategori " style="background-color:white;"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                        @foreach($kategori as $i)
                                        <option data-tokens="{{ $i->nama_kategori }}" value="{{ $i->id }}">
                                            {{ $i->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                @error('kategori')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label-md text-dark">Unit
                                </label>
                                <div class="col-sm-4 pt-8">
                                    <input type="hidden" name="unit_field" value="{{ $detail->unit_produk_id }}">
                                    <select name="unit" data-live-search="true"
                                        data-header="<a style='font-size:smaller; cursor:pointer' onclick='modal_unit()' class=''><i class='fas fa-plus'></i> Tambah unit</a>"
                                        class="form-control selectpicker @error('unit') is-invalid @enderror"
                                        title="Unit " style="background-color:white;"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                        @foreach($unit as $i)
                                        <option data-tokens="{{ $i->nama_unit }}" value="{{ $i->id }}">
                                            {{ $i->nama_unit }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <br>
                                @error('unit')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 pt-3 col-form-label-md text-dark">Deskripsi</label>
                                <div class="col-sm-4">
                                    <input type="text" name="deskripsi" value="{{ $detail->deskripsi }}"
                                        class="form-control form-control-md @error('deskripsi') is-invalid @enderror"
                                        id="inputEmail3" placeholder="">
                                </div>
                                <br>
                                @error('deskripsi')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                            </div>




                            <div class="ml-4 mt-4 d-flex justify-content-start">

                                <h6 class=" ml-2" style="margin-top:30px;"><b>Harga & Pengaturan</b></h6><br>
                                <div style="margin-top:30px; margin-left:10px;"><small>*</small></div>
                            </div>



                            <div class="card border col-8" style="background-color:#fafafa;">
                                <div class="card-header text-capitalize "
                                    style="background-color:#e0dcdc; font-size:smaller;  height:50px;">
                                    <input type="checkbox" class="mr-2 beli_check" checked /> <b> Saya Beli Produk
                                        Ini</b>
                                </div>
                                <div class="card-body beli_box">
                                    <div class="row justify-content-between">
                                        <div class="form-group  col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Harga Beli Satuan</b></label>
                                            <input type="text" class="form-control text-bold" placeholder="Rp. 0,00"
                                                name="harga_beli" value="{{ $detail->harga_beli}}"
                                                style="height:30px; width:100%; font-size:smaller; padding-top:3px;">
                                        </div>
                                        <div class="form-group  col-lg-4 col-sm-12 float-left">
                                            <label>Akun Perkiraan</label>
                                            <select name="akun_pembelian" data-live-search="true"
                                                class="form-control form-control-sm  col-lg-12 col-sm-6 selectpicker @error('akun_pembelian') is-invalid @enderror"
                                                data-style="bg-info text-white"
                                                style="height:30px; font-size:smaller; padding-top:3px;">>
                                                @foreach($akun_pembelian as $i)
                                                <option data-tokens="{{ $i->nama_akun }}" value="{{ $i->kode_akun }}">
                                                    ({{ $i->kode_akun }}) - {{ $i->nama_akun }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-lg-4 col-sm-12 float-left">
                                            <label>Pajak Beli</label>
                                            <select name="pajak_beli" data-live-search="true"
                                                class="form-control form-control-sm  col-lg-12 col-sm-6 selectpicker @error('akun_penjualan') is-invalid @enderror"
                                                data-style="bg-white text-dark"
                                                style="background-color:white;"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                                @foreach($pajak as $i)
                                                <option data-tokens="{{ $i->nama_pajak }}" value="{{ $i->id }}">
                                                {{ $i->nama_pajak }} - ({{ $i->persentase }} %)
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card border col-8" style="background-color:#fafafa;">
                                <div class="card-header text-capitalize "
                                    style="background-color:#e0dcdc; font-size:smaller;  height:50px;">
                                    <input type="checkbox" class="mr-2 jual_check" checked /> <b>Saya Jual Produk
                                        ini</b>
                                </div>
                                <div class="card-body jual_box">
                                    <div class="row justify-content-between">
                                        <div class="form-group  col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Harga Jual Satuan</b></label>
                                            <input type="text" class="form-control text-bold" placeholder="Rp. 0,00"
                                                name="harga_jual" value="{{ $detail->harga_jual }}"
                                                style="height:30px; width:100%; font-size:smaller; padding-top:3px;">
                                        </div>
                                        <div class="form-group  col-lg-4 col-sm-12 float-left">
                                            <label>Akun Perkiraan</label>
                                            <select name="akun_penjualan" data-live-search="true"
                                                class="form-control form-control-sm col-lg-12 col-sm-6 selectpicker @error('akun_penjualan') is-invalid @enderror"
                                                data-style="bg-info text-white"
                                                style="background-color:white;"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                                @foreach($akun_penjualan as $i)
                                                <option data-tokens="{{ $i->nama_akun }}" value="{{ $i->kode_akun }}">
                                                    ({{ $i->kode_akun }}) - {{ $i->nama_akun }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group  col-lg-4 col-sm-12 float-left">
                                            <label>Pajak Jual</label>
                                            <select name="pajak_jual" data-live-search="true"
                                                class="form-control form-control-sm  col-lg-12 col-sm-6 selectpicker @error('akun_penjualan') is-invalid @enderror"
                                                data-style="bg-white text-dark"
                                                style="background-color:white;"
                                                    style="height:30px; font-size:smaller; padding-top:3px;">
                                                @foreach($pajak as $i)
                                                <option data-tokens="{{ $i->nama_pajak }}" value="{{ $i->id }}">
                                                {{ $i->nama_pajak }} - ({{ $i->persentase }} %)
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="card border col-6" style="background-color:#fafafa;">
                                <div class="card-header text-capitalize "
                                    style="background-color:#e0dcdc; font-size:smaller;  height:50px;">
                                    <input type="checkbox" class="mr-2 stok_check" checked /> <b>Monitor Persediaan
                                        Barang</b>
                                </div>
                                <div class="card-body stok_box">
                                    <div class="row justify-content-between">
                                        <div class="form-group  col-lg-4 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Batas Stok Minimum</b></label>
                                            <input type="text" class="form-control text-bold" placeholder="0"
                                                name="batas_minimum" value="{{ $detail->batas_minimum }}"
                                                style="height:30px; width:100%; font-size:smaller; padding-top:3px;">
                                        </div>
                                        <div class="form-group  col-lg-8 col-sm-12 float-left">
                                            <select name="akun_persediaan_barang" data-live-search="true"
                                                class="form-control form-control-sm mt-4 col-lg-12 col-sm-6 selectpicker @error('akun_persediaan_barang') is-invalid @enderror"
                                                data-style="bg-info text-white">
                                                @foreach($akun_persediaan_barang as $i)
                                                <option data-tokens="{{ $i->nama_akun }}" value="{{ $i->kode_akun }}">
                                                    ({{ $i->kode_akun }}) - {{ $i->nama_akun }}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                </div>
                            </div>



                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_kategori">
  Launch demo modal
</button> -->
                            <div class="col-6 ml-auto mr-auto">
                                <button type="submit"
                                    class="btn btn-block btn-md btn-primary simpan_account">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

        @include('product.modal_create_kategori')
        @include('product.modal_create_unit')
        @endsection

        @push('custom-scripts')
        <script>
        $(window).ready(function() {


            var kat_field = $("[name=kat_field]").val();
            $("[name=kategori]").selectpicker('val',kat_field);

            var unit_field = $("[name=unit_field]").val();
            $("[name=unit]").selectpicker('val',unit_field);

            $('[aria-owns=bs-select-1]').addClass('btn-md');
            $('[aria-owns=bs-select-1]').addClass('bg-primary');
            $('[aria-owns=bs-select-1]').addClass('text-white');
            $('[aria-owns=bs-select-1]').addClass('mr-5');
            $('[aria-owns=bs-select-1]').css('margin-top','-10px');

            $('[aria-owns=bs-select-2]').addClass('btn-md');
            $('[aria-owns=bs-select-2]').addClass('bg-primary');
            $('[aria-owns=bs-select-2]').addClass('text-white');
            $('[aria-owns=bs-select-2]').css('margin-top','-23px');
        })
        $('[name=gambar]').change(function(e) {

            e.preventDefault();

            const file = this.files[0];
            console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#ImgPreview').attr('src', event.target.result);
                    $('#ImgPreview').attr('width', '80px');
                    $('#ImgPreview').attr('height', '50px');
                }
                reader.readAsDataURL(file);
                let html =
                    '<span class="fas fa-minus text-danger hapus_gambar" style="margin-right:-10px;" data-toggle="tooltip" data-placement="top" title="Hapus Gambar"></span>';
                $(".preview").html(html);
            }

            $(".hapus_gambar").click(function(e) {
                $("[name=gambar]").val('');
                $("#ImgPreview").attr('src', '');
                $("#ImgPreview").attr('width', '');
                $("#ImgPreview").attr('height', '');
                $(".hapus_gambar").remove();

            })
        })


        $(".beli_check").click(function() {
            $(".beli_box :input").attr('disabled', !this.checked)
        });
        $(".jual_check").click(function() {
            $(".jual_box :input").attr('disabled', !this.checked)
        });
        $(".stok_check").click(function() {
            $(".stok_box :input").attr('disabled', !this.checked)
        });


        function modal_kategori() {
            $('#create_kategori').modal('show');
        }


        function modal_unit() {
            $('#create_unit').modal('show');
        }

        $("#form_unit").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("unit.store") }}',
                data: formData,
                method: 'post',
                success: function(data) {

                    var obj = JSON.parse(data);
                    console.log(obj);

                    if (obj.status == 200) {

                        $('#create_unit').modal('hide');
                        alert(obj.message);
                        location.reload();


                    } else if (obj.status == 201) {

                        alert(obj.message);


                    }
                }


            })
        })

        $("#form_kategori").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("kategori.store") }}',
                data: formData,
                method: 'post',
                success: function(data) {

                    var obj = JSON.parse(data);
                    console.log(obj);

                    if (obj.status == 200) {

                        $('#create_kategori').modal('hide');
                        alert(obj.message);
                        location.reload();


                    } else if (obj.status == 201) {

                        alert(obj.message);


                    }
                }


            })
        })
        </script>
        @endpush