@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Akun {{ $data_akun[0]->kategori_akun->nama_kategori }}</small>
                            <br>
                            <h3 class="text-info">({{ $data_akun[0]->kode_akun }})
                                {{ $data_akun[0]->nama_akun }}</h3>

                        </div>
                        <div class="">
                            <a class=" btn btn-success" href="#">
                                <i class="nc-icon nc-simple-add"></i>
                                Ubah Akun
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Transaksi Akun</h3>


                        <div class="form-group mt-3 col-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="filter_range" class="form-control float-right"
                                    id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>

                    <div class="table-responsive table-striped mt-3">
                        <table id="show_account"
                            class="table table-striped table-pembelian dataTables_wrapper dt-bootstrap4 datatable">
                            <thead class="text-capitalize" style="background-color:mintcream">
                                <th class="text-capitalize">
                                    Tanggal
                                </th>
                                <th class="text-capitalize">
                                    Nomor
                                </th>
                                <th class="text-capitalize">
                                    Kontak
                                </th>
                                <th class="text-capitalize">
                                    Debit
                                </th>
                                <th class="text-capitalize">
                                    Kredit
                                </th>
                                <th class="text-capitalize">
                                    Saldo
                                </th>


                            </thead>
                            @if(empty($detail_akun))
                                <tbody style="background-color:white;">

                                </tbody>
                            @else
                                <tbody class="isi_detail_akun">
                                    @foreach($detail_akun as $i)
                                        <tr>
                                            <td>{{ $i->tgl_transaksi }}</td>
                                            <td>{{ $i->no_transaksi }}</td>
                                            <td>{{ $i->nama_kontak }}</td>
                                            <td>{{ \Helper::rupiah($i->debit) }}</td>
                                            <td>{{ \Helper::rupiah($i->kredit) }}</td>
                                            <td>{{ \Helper::rupiah(abs($i->saldo_akumulatif)) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right">Total: </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>



        </div>

    </div>
    @endsection


    @push('custom-scripts')
        @include('account.js.account_index_js')
    @endpush
