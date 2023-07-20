@extends('layout.app', [

])
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Penjualan</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('custom-scripts')
{{ $dataTable->scripts() }}
@endpush