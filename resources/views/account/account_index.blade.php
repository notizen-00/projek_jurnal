@extends('layout.app', [

])

@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small>Daftar Akun</small>

                        </div>
                        <div class="">
                            <a class=" btn btn-outline-primary" href="#">
                                <i class="nc-icon nc-simple-add"></i>
                                Buat Akun Baru
                            </a>
                        </div>

                    </div>
                </div>
            </div>



            <div class="card">

                <ul class="nav nav-tabs">
                    <li class="nav-items active"><a class="nav-link active btn-outline-info" data-toggle="tab"
                            href="#home">Account</a></li>
                </ul>
                <div class="d-flex justify-content-end">
                    <div class="btn-group mr-3">
                        <button type="button" class="btn btn-outline-primary">Tindakan</button>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-icon"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                            <a class="dropdown-item" href="{{ url('pembelian/baru') }}">Pengaturan
                                Akun</a>
                            <a class="dropdown-item" href="{{ url('pembelian/retur') }}">Atur Saldo
                                Awal</a>
                            <a class="dropdown-item" href="{{ url('pembelian/retur') }}">Penutupan
                                Buku</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>

                </div>

                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        <div class="table-responsive table-striped mt-3">
                            <table class="table table-striped myTable">
                                <thead class="text-capitalize" style="background-color:mintcream">
                                    <th class="text-capitalize">
                                        Kunci
                                    </th>
                                    <th class="text-capitalize">
                                        Kode Akun
                                    </th>
                                    <th class="text-capitalize">
                                        Nama Akun
                                    </th>
                                    <th class="text-capitalize">
                                        Kategori Akun
                                    </th>
                                    <th class="text-capitalize">
                                        Saldo
                                    </th>

                                </thead>
                                @if(empty($account))
                                    <tbody style="background-color:white;">

                                    </tbody>
                                @else
                                    <tbody>
                                        @foreach($account as $i)

                                            <tr>
                                                <td class="pl-3">
                                                    @if($i->status_akun == 1)
                                                        <span class='fas fa-lock'></span>
                                                    @elseif($i->status_akun == 0)

                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $i->kode_akun }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('account.show',$i->id_account) }}"
                                                        class="nav-widget" data-id="{{ $i->id_account }}"
                                                        data-kode="{{ $i->kode_akun }}">{{ $i->nama_akun }}</a>
                                                </td>
                                                <td>
                                                    {{ $i->kategori_akun->nama_kategori }}
                                                </td>
                                                <td>
                                                    {{ \Helper::rupiah(abs($i->saldo_akumulatif)) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection


@push('custom-scripts')
    @include('account.js.account_index_js')
@endpush
