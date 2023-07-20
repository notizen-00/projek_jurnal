<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Faktur Penjualan</title>
    <style>
        /* CSS untuk styling faktur */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
        }

        .container-top {
            display: flex;
  justify-content: space-between;
  align-items: center;
        }

        .logo {
            float: left;
            width: 20%;
        }

        .logo img {
            width: 100%;
        }

        .address {
            float: left;
            width: 40%;
        }


        .address p {
            margin: 5px 0;
        }

        .address p {
            margin: 5px 0;
        }

        .customer {
            float: left;
            width: 38%;
       
            border: 2px solid gray;
        }

        .customer p {
            margin: 5px 0;
            padding-left: 50px;
            
        }





        .invoice {
            clear: both;
            text-align: left;
            padding-top: 10px;
            width: 100%;
            display: grid;
            grid-template-columns: 60% 40%;
        }

        .invoice p {

            padding-top: 10px;
            margin:0px;
        }

       

        .table {
            margin-top: 30px;
            clear: both;
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 30px;
            float: right;
            text-align: right;
            width: 30%;
        }

        .total p {
            margin: 5px 0;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature canvas {
            border: 1px solid #ccc;
            width: 100%;
            height: 100px;
            margin-top: 10px;
        }
        .row {
        display: flex;
        justify-content: space-between;
    }

    .col-md-6 {
        width: 45%;
    }

    .form-group {
        margin-top: 5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
    }

    div.form-group div {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    
    }
    label.garis-lurus {
    display: block;
    margin-top: 5px;
    border-bottom: 1px solid #333;
}

    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="container-top">
            <div class="logo">
                <img style="max-width:100px;"
                    src="{{ asset('adminlte/dist/img/logo-fastderm.jpeg') }}"
                    alt="Logo">
            </div>
            <div class="address">
                <p><b>CV. KOSMETIKA JAYA INDONESIA</b></p>
                <p>DUSUN KAPUSAN RT 001 RW 017 GRENDEN</p>
                <p>KECAMATAN PUGER</p>
                <P>Kab. Jember Jawa Timur 68164</P>
                <p>Indonesia</p>
                <p>085234068695</p>
            </div>
            <div class="customer">
                <h2 style="margin-left:50px;"><u><b>INVOICE</b></u></h2>
                <p><b>{{ $kontak->nama_kontak }}</b></p>
                <p>{{ $kontak->alamat }}</p>
                {{-- <p>Kota, Provinsi</p> --}}

            </div>

        </div>

        <div class="invoice">
            <p><b>No. Faktur: {{ $pembelian->no_transaksi }}</b></p>
            <p>Termin: <b>30 hari</b></p>
            <p>Tanggal: <b>{{ $pembelian->tgl_transaksi }}</b></p>
            <p>Jatuh Tempo: <b>{{ $pembelian->tgl_jatuh_tempo }}</b></p>
        </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 250px;">Nama Barang</th>
                    <th>Qty</th>
                    <th>Sat</th>
                    <th>Harga Satuan</th>
                    <th>Pajak</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail_pembelian as $i)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $i->detail_produk->nama_produk }}</td>
                    <td>{{ $i->qty }}</td>
                    <td>{{ \Transaksi_helper::get_unit_name($i->detail_produk->unit_produk_id) }}</td>
                    <td>{{ \Helper::rupiah($i->harga_satuan) }}</td>
                    <td>X </td>
                    <td>{{ \Helper::rupiah($i->jumlah)  }}</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
              
                <tr>
                    <td colspan="5" rowspan="2">Keterangan <br>
                        <b>BCA : 760018106</b><br>
                        <b>CV KOSMETIKA JAYA INDONESIA</b></td>
                    <td>Subtotal</td>
                    <td>{{ \Helper::rupiah($subtotal) }}</td>
                  
                </tr>
                <tr>
                    <td>Pajak</td>
                    <td>{{ \Helper::rupiah($transaksi[0]->pajak) }}</td>
                </tr>
                <tr>
                    <td colspan="5" rowspan="2">{{ \Helper::terbilang($transaksi[0]->total) }}</td>
                    <td><b>Total Harga</b></td>
                    <td><strong>{{ \Helper::rupiah($transaksi[0]->total) }}</strong></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan</td>
                    <td><strong>{{ \Helper::rupiah(\Pembelian_helper::get_sisa_tagihan($pembelian->no_transaksi,$pembelian->id)) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="row">
            <div class="col-md-6">
                <center><p>Hormat Kami:</p></center>
               
                <div class="form-group">
                   
                    <label class="garis-lurus"></label>
                    <label for="ttd_customer">Tgl :</label>

                </div>
            </div>
            <div class="col-md-6">
                <center><p>Penerima:</p></center>
           
                <div class="form-group">
            
                    <label class="garis-lurus"></label>
                    <label for="ttd_customer">Tgl :</label>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
