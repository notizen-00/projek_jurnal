@extends('layout.app', [

])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header" style="height:80px;">
                    <div class="d-flex justify-content-between">
                        <b>Transaksi</b>
                        <button id="btnBack">Back</button>
                        <h4 style="margin-top:-1px;">{{ $detail_pembayaran->uid_pembayaran }}</h4>

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

                        <form id="form_pembayaran" class="ml-4 mt-2">
                            @csrf
                            <div class="card-header" style="background-color:lightblue; height:100px;">

                                <div class="row">
                                    <input type="hidden" value="{{ $data_transaksi[0]->kontak->id }}"
                                        name="id_kontak">
                                    <div class="form-group col-lg-2 col-md-6 col-sm-12">
                                        <label for="supplier" class="text-dark"><b>Supplier</b></label>
                                        <br>
                                        <a href="{{ route('kontak.show',$data_transaksi[0]->kontak->id) }}"
                                            readonly class="text-white"
                                            style="height:30px; font-size:large; padding-top:3px;">{{ $data_transaksi[0]->kontak->nama_panggilan }}</a>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-6 col-sm-6">
                                        <label for="supplier" class="text-dark"><b>Bayar dari</b></label>
                                        <br>
                                        <a href="{{ route('account.show',$akun_kredit[0]->id) }}"
                                            readonly class="text-white"
                                            style="height:30px; font-size:large; padding-top:3px;">{{ $akun_kredit[0]->nama_akun }}</a>

                                    </div>

                                    <div class="total text-right col-lg-3 col-md-6 col-sm-12 ml-auto">
                                        <b class="text-dark">Total</b>
                                        <h3 style="color:#4287f5;" class="total_view">
                                            {{ \Helper::rupiah($detail_pembayaran->jumlah_pembayaran) }}</h3>
                                    </div>




                                </div>


                            </div>

                            <div class="row mt-4" style="height:250px;">

                                <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-between ">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group col-lg-4 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Cara Pembayaran</b></label>
                                            <br>
                                            {{ $data_transaksi[0]->metode_pembayaran }}
                                        </div>


                                        <div class="form-group col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tgl Pembayaran</b></label>
                                            <input readonly type="date" name="tgl_transaksi"
                                                value="{{ $detail_pembayaran->tanggal_pembayaran }}"
                                                class="form-control form-control-sm"
                                                style="height:35px; font-size:small; padding-top:3px;"
                                                id="tgl_transaksi" />
                                        </div>

                                        <?php
                                      $hari = new DateInterval('P3D');
                                      $diff = new DateTime();
                                      $diff->add($hari);
                                      $tgl_jatuh_tempo = $diff->format('Y-m-d');
                                    

                                    ?>
                                        <div class="form-group col-lg-3 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tgl Jatuh Tempo</b></label>
                                            <input readonly type="date" name="tgl_jatuh_tempo" class="form-control"
                                                id="tgl_jatuh_tempo"
                                                style="height:35px; font-size:small; padding-top:3px;" />
                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="col-lg-12 col-md-6 col-sm-12  d-flex justify-content-end">
                                        <div class="form-group pr-5 col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>No Transaksi</b> <i
                                                    class="fas fa-cog" data-toggle="tooltip" data-title="test"></i>
                                            </label>
                                            <br>
                                            <span class="text-success">{{ $detail_pembayaran->uid_pembayaran }}</span>
                                        </div>


                                        <div class="form-group col-lg-6 col-sm-12 float-left">
                                            <label for="supplier" class="text-dark"><b>Tag (Optional)</b></label>
                                            <input type="text" class="form-control" name="tag"
                                                style="height:30px; width:80%; font-size:smaller; padding-top:3px;" />
                                        </div>
                                    </div>

                                </div>



                            </div>

                            <div class="table mt-3" sstyle="overflow-x:auto; overflow:scroll;">
                                <table class="table table-striped table-hover" id="table_pembayaran"
                                    style="overflow: scroll; overflow-x:auto;">
                                    <thead style="background-color:aliceblue;" class="text-lowercase">
                                        <tr>
                                            <th style="font-size:small;" class="text-capitalize">Nomor Transaksi</th>
                                            <th style="font-size:small;" class="text-capitalize">Deskripsi</th>
                                            <th style="font-size:small;" class="text-capitalize text-right">Jumlah
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="isi_produk">
                                        <tr>
                                            <td><a
                                                    href="{{ route('pembelian.show',$transaksi_induk[0]->id) }}">{{ $transaksi_induk[0]->no_transaksi }}</a>
                                            </td>
                                            <td>-</td>
                                            <td class="text-right">
                                                {{ \Helper::rupiah($detail_pembayaran->jumlah_pembayaran) }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>


                            </div>



                            <div class="row">
                                <div class="row col-12 justify-content-between">
                                    <div class="col-lg-6 col-sm-12">

                                        <div class="form-group col-lg-8 col-sm-12 float-left">
                                            <label for="suppliers" class="text-dark"><b>Memo</b></label>
                                            <textarea readonly placeholder="Isikan Memo ..." id="suppliers" rows="3"
                                                class="form-control form-control-sm"
                                                name="memo">{{ $data_transaksi[0]->memo }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12 text-right pr-5 justify-content-between">


                                        <div class="pr-5 col-lg-6 mt-3 col-sm-12 float-left" style="font-size: large;">
                                            <b>Total</b>
                                            <input type="hidden" name="total" />
                                        </div>


                                        <div
                                            class="form-group mt-3 col-lg-6 col-sm-12 float-left total_view text-right">
                                            <b>{{ \Helper::rupiah($detail_pembayaran->jumlah_pembayaran) }}</b>
                                        </div>



                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="tombol-1">
                                        <a class="btn btn-dark" href="#">Hapus</a>
                                    </div>
                                    <div class="tombol-2">

                                        <nav class="navbar navbar-expand-lg navbar-transparent">
                                            <ul class="navbar-nav">
                                                <li class="nav-item btn-rotate dropup">
                                                    <a class="nav-link btn btn-info btn-sm dropdown-toggle"
                                                        href="http://example.com" id="navbarDropdownMenuLink2"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">

                                                        Cetak & Lihat <i class="fas fa-file"></i>
                                                        <p>
                                                            <span
                                                                class="d-lg-none d-md-block">{{ __('Account') }}</span>
                                                        </p>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="navbarDropdownMenuLink2">
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="navbarDropdownMenuLink2">
                                                            <a class="dropdown-item"
                                                                href="{{ route('pembelian.baru') }}">Liat
                                                                Faktur</a>
                                                            <a class="dropdown-item">Email Faktur</a>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item btn-rotate dropup">
                                                    <a class="nav-link btn btn-info btn-sm dropdown-toggle"
                                                        href="http://example.com" id="navbarDropdownMenuLink3"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">

                                                        Tindakan <i class="fas fa-list"></i>
                                                        <p>
                                                            <span
                                                                class="d-lg-none d-md-block">{{ __('Account') }}</span>
                                                        </p>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="navbarDropdownMenuLink3">
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="navbarDropdownMenuLink3">
                                                            <a class="dropdown-item">Atur Transkasi Berulang </a>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="tombol-3">
                                        <a class="btn btn-danger" href="#">Kembali</a>
                                        <a class="btn btn-success" href="{{ route('pembayaran.edit',$detail_pembayaran->id) }}">Ubah</a>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endsection

        @push('custom-scripts')
          @include('pembelian.js.pembelian_index_js');
        @endpush
    
     
