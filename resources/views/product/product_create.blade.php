@extends('layout.app', [
])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:130px;">

                    <a class="" href="{{ route('product.index') }}"><i
                            class="fas fa-circle-arrow-left"></i>Produk</a>
                    <div class="mb-3">
                        <h4>Buat Produk Baru</h4>

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

                        <form id="form1" action="{{ route('product.store') }}" method="post"
                            enctype="multipart/form-data" class="ml-4 mt-2">
                            @csrf
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
                                        id="inputEmail3" placeholder="">
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
                                        id="inputEmail32" placeholder="">
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
                                    <select name="kategori" required data-live-search="true"
                                        data-header="<a style='font-size:smaller; cursor:pointer' onclick='modal_kategori()'><i class='fas fa-plus'></i>Tambah Kategori</a>"
                                        class="form-control form-control-sm selectpicker @error('kategori') is-invalid @enderror"
                                        title="Kategori " data-style="bg-info text-white"
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
                                    <select name="unit" data-live-search="true"
                                        data-header="<a style='font-size:smaller; cursor:pointer' onclick='modal_unit()' class=''><i class='fas fa-plus'></i> Tambah unit</a>"
                                        class="form-control form-control-sm selectpicker @error('unit') is-invalid @enderror"
                                        title="Unit " data-style="bg-info text-white"
                                        style="height:30px; font-size:smaller; margin-top:-30px;">
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
                                <label for="inputEmail3"
                                    class="col-sm-2 pt-3 col-form-label-md text-dark">Deskripsi</label>
                                <div class="col-sm-4">
                                    <input type="text" name="deskripsi"
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

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 pt-3 col-form-label-md text-dark">Jenis
                                    Produk</label>
                                <div class="col-sm-4">
                                    <select required
                                        class="form-control form-control-md  @error('jenis_produk') is-invalid @enderror"
                                        name="jenis_produk">
                                        <option value="1">Single</option>
                                        <option value="2">Group</option>
                                    </select>
                                </div>
                                <br>
                                @error('jenis_produk')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-items active" style="border-bottom:2px solid #8ef5f5;"><a
                                                    class="nav-link active" data-toggle="tab" href="#home">Harga &
                                                    Pengaturan</a></li>
                                            <li class="nav-items"><a class="nav-link disabled"
                                                    style="border-bottom:2px solid #8ef5f5;" data-toggle="tab"
                                                    href="#group_setting" >Bundle</a></li>

                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane active">

                                                <div class="card border col-8 mt-3" style="background-color:#fafafa;">
                                                    <div class="card-header text-capitalize "
                                                        style="background-color:#e0dcdc; font-size:smaller;  height:50px;">
                                                        <input type="checkbox" class="mr-2 beli_check" checked /> <b>
                                                            Saya Beli Produk
                                                            Ini</b>
                                                    </div>
                                                    <div class="card-body beli_box">
                                                        <div class="row justify-content-between">
                                                            <div class="form-group  col-lg-3 col-sm-12 float-left">
                                                                <label for="supplier" class="text-dark"><b>Harga Beli
                                                                        Satuan</b></label>
                                                                <input type="text" class="form-control text-bold"
                                                                    placeholder="Rp. 0,00" name="harga_beli"
                                                                    style="height:30px; width:100%; font-size:smaller; padding-top:3px;">
                                                            </div>
                                                            <div class="form-group  col-lg-4 col-sm-12 float-left">
                                                                <label>Akun Perkiraan</label>
                                                                <select name="akun_pembelian" data-live-search="true"
                                                                    class="form-control form-control-sm  col-lg-12 col-sm-6 selectpicker @error('akun_pembelian') is-invalid @enderror"
                                                                    data-style="bg-info text-white"
                                                                    style="height:30px; font-size:smaller; padding-top:3px;">>
                                                                    @foreach($akun_pembelian as $i)
                                                                        <option data-tokens="{{ $i->nama_akun }}"
                                                                            value="{{ $i->kode_akun }}">
                                                                            ({{ $i->kode_akun }}) -
                                                                            {{ $i->nama_akun }}
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
                                                                        <option data-tokens="{{ $i->nama_pajak }}"
                                                                            value="{{ $i->id }}">
                                                                            {{ $i->nama_pajak }} -
                                                                            ({{ $i->persentase }} %)
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
                                                        <input type="checkbox" class="mr-2 jual_check" checked />
                                                        <b>Saya Jual Produk
                                                            ini</b>
                                                    </div>
                                                    <div class="card-body jual_box">
                                                        <div class="row justify-content-between">
                                                            <div class="form-group  col-lg-3 col-sm-12 float-left">
                                                                <label for="supplier" class="text-dark"><b>Harga Jual
                                                                        Satuan</b></label>
                                                                <input type="text" class="form-control text-bold"
                                                                    placeholder="Rp. 0,00" name="harga_jual"
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
                                                                        <option data-tokens="{{ $i->nama_akun }}"
                                                                            value="{{ $i->kode_akun }}">
                                                                            ({{ $i->kode_akun }}) -
                                                                            {{ $i->nama_akun }}
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
                                                                        <option data-tokens="{{ $i->nama_pajak }}"
                                                                            value="{{ $i->id }}">
                                                                            {{ $i->nama_pajak }} -
                                                                            ({{ $i->persentase }} %)
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
                                                        <input type="checkbox" class="mr-2 stok_check" checked />
                                                        <b>Monitor Persediaan
                                                            Barang</b>
                                                    </div>
                                                    <div class="card-body stok_box">
                                                        <div class="row justify-content-between">
                                                            <div class="form-group  col-lg-4 col-sm-12 float-left">
                                                                <label for="supplier" class="text-dark"><b>Batas Stok
                                                                        Minimum</b></label>
                                                                <input type="text" class="form-control text-bold"
                                                                    placeholder="0" name="batas_minimum"
                                                                    style="height:30px; width:100%; font-size:smaller; padding-top:3px;">
                                                            </div>
                                                            <div class="form-group  col-lg-8 col-sm-12 float-left">
                                                                <select name="akun_persediaan_barang"
                                                                    data-live-search="true"
                                                                    class="form-control form-control-sm mt-4 col-lg-12 col-sm-6 selectpicker @error('akun_persediaan_barang') is-invalid @enderror"
                                                                    data-style="bg-info text-white">

                                                                    @foreach($akun_persediaan_barang as $i)
                                                                        <option data-tokens="{{ $i->nama_akun }}"
                                                                            value="{{ $i->kode_akun }}">
                                                                            ({{ $i->kode_akun }}) -
                                                                            {{ $i->nama_akun }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="group_setting" class="tab-pane ">
                                                <div class="card-header" style="background-color:#e0dcdc;">
                                                    <div class="card-title">Rincian Produk Bundle
                                                     
                                                    </div>
                                                    <br>
                                                    
                                                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-left:-15px; margin-top:20px;">
                                                        <input type="text" class="form-control search-input" id="search_barang"
                                                            placeholder="Ketikan Barang & Jasa .." name="id_barang"
                                                            style="height:30px; width:80%; font-size:smaller; padding-top:3px;">
                                                        </div>
                                                    
                                                    
                                                </div>
                                                <div class="card-body">

                                                    <div style="height:400px;">
                                                        <table class="table table-striped table_bundle" style="width: 100%; ">
                                                            <thead class="bg-info">
                                                            <tr style="width:100%;">
                                                                <th>ID</th>
                                                                <th>Nama Barang</th>
                                                                <th>Kuantitas</th>
                                                                <th>Satuan</th>
                                                                <th>Harga Jual</th>
                                                                <th>Subtotal</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="isi_bundle">
                                                            </tbody>
                                            
                                                        </table>
                                                        
                                                    </div>

                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-between">
                                                        <div class="col-sm-6">
                                                          <div class="card" >
                                                            <div class="card-header">
                                                                <h3 class="card-title"><b>Pajak Penjualan</b></h3>
                                                            </div>
                                                            <div class="card-body" style="height:220px;">
                                                             
                                                              <br>

                                                              <div class="form-row">
                                                                <label for="inputEmail3" class="col-sm-2 col-form-label">PPN : </label>
                                                                <div class="col-sm-10">
                                                                  <select name="akun_pajak" class="form-control" required>
                                                                    @foreach($pajak as $i)
                                                                        <option value="{{ $i->id }}">{{ $i->nama_pajak }}</option>
                                                                    @endforeach
                                                                  </select>
                                                                </div>
                                                              </div>

                                                             

                                                              
                                                              
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="card-title"><b>Informasi Penjualan</b></h3>
                                                            </div>
                                                            <div class="card-body">
                                                            
                                                              <br>
                                                              <div class="form-group row">
                                                                <label for="inputEmail3o23" class="col-sm-3 col-form-label">Default Diskon % : </label>
                                                                <div class="col-sm-6">
                                                                  <input type="number" class="form-control" name="diskon" placeholder="diskon" value="0" /> 
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    / Semua Satuan
                                                                </div>
                                                              </div>

                                                              <div class="form-group row">
                                                                <label for="inputEmail999" class="col-sm-3 col-form-label">Harga Jual Bundle: </label>
                                                                <div class="col-sm-6">
                                                                  <input type="text" name="harga_jual_bundle"  class="form-control"> 
                                                                </div>
                                                                <div class="form-group col-sm-6 mt-2 ">
                                                                    <div class="form-check">
                                                                      <input class="form-check-input" type="checkbox" checked id="check_harga_jual">
                                                                      <label class="form-check-label" for="gridCheck">
                                                                        Harga di hitung dari rincian bundle  
                                                                      </label>
                                                                    </div>
                                                                  </div>
                                                              </div>

                                                              

                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-6 ml-auto mr-auto">
                    <button type="submit" class="btn btn-block btn-md btn-primary simpan_account">Simpan</button>
                </div>

                </form>

            </div>
        </div>
    </div>

</div>

@include('product.modal_create_kategori')
@include('product.modal_create_unit')
@include('product.modal.modal_produk_bundle')
@endsection

@push('custom-scripts')
    @include('product.js.product_create_js');
@endpush
