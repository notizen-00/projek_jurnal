@extends('layout.app', [

])

@section('content')

<div class="content-wrapper mt-4">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">



                    <div class="card">
                        <div class="d-flex justify-content-end">
                            <div class="mt-3 mr-2 col-2">
                                <a class="btn btn-outline-primary" href="{{ route('pembelian_retur.new') }}"><i class="fas fa-plus"></i>  Retur Pembelian </a>
                            </div>
                        
                        </div>



                        <div class="table-responsive table-striped mt-3">
                            <table border="0" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>Filter Tanggal Mulai:</td>
                                        <td><input type="text" id="min" name="min"></td>
                                    </tr>
                                    <tr>
                                        <td>Filter Tanggal Akhir:</td>
                                        <td><input type="text" id="max" name="max"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped table-retur dataTables_wrapper dt-bootstrap4">
                                <thead class="text-capitalize" style="background-color:mintcream">
                                    <th class="text-capitalize">
                                        Tanggal
                                    </th>
                                    <th class="text-capitalize">
                                        Nomor Transaksi
                                    </th>
                                    <th class="text-capitalize">
                                        Pemasok
                                    </th>
                                    <th class="text-capitalize">
                                        Keterangan
                                    </th>
                                    <th class="text-capitalize" style="width:20%">
                                        Nilai Pembayaran
                                    </th>

                                </thead>

                            </table>
                        </div>

                    </div>



                </div>
            </div>

    </section>
</div>
@endsection

@push('custom-scripts')
    @include('pembelian.js.retur_list_js');
@endpush
