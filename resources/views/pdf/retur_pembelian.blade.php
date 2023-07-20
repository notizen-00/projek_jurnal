<!DOCTYPE html>
<html>
<head>
	<title>Template Retur</title>
	<style type="text/css">
		.container {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			margin: 20px 50px;
			border-bottom: 1px solid black;
			padding-bottom: 10px;
		}

		.container h3 {
			margin: 0;
			font-size: 24px;
			font-weight: bold;
		}

		.container p {
			margin: 0;
			font-size: 16px;
			font-weight: bold;
		}

		.left {
			flex-basis: 50%;
			padding-right: 50px;
			border-right: 1px solid black;
		}

		.left p {
			margin-top: 20px;
			font-size: 16px;
			font-weight: normal;
		}

		.right {
			flex-basis: 50%;
			padding-left: 50px;
		}

		.right p {
			margin: 0;
			font-size: 16px;
			font-weight: normal;
		}

		.table-container {
			margin: 20px 50px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		th, td {
			border: 1px solid black;
			padding: 8px;
			text-align: center;
			font-size: 16px;
			font-weight: normal;
		}

		th {
			font-weight: bold;
		}

		thead {
			background-color: #ccc;
		}

		.no-border {
			border: none;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="left">
			<h3>Alamat Kantor</h3>
			<p>Jalan Raya 123</p>
			<p>Kota A, Provinsi B</p>
			<p>Telp. 0123456789</p>
		</div>
		<div class="right">
			<p>No. Retur: <strong>001</strong></p>
			<p>Tanggal Retur: <strong>01 Januari 2023</strong></p>
		</div>
	</div>
	<div class="container">
		<div class="left">
			<p>Alamat Customer</p>
			<p>Jalan Raya 456</p>
			<p>Kota C, Provinsi D</p>
			<p>Telp. 9876543210</p>
		</div>
		<div class="right">
			<p>No. Faktur Penjualan: <strong>123</strong></p>
		</div>
	</div>
	<div class="table-container">
		<table>
			<thead>
				<tr>
					<th>Keterangan</th>
					<th>Kuantitas Penjualan</th>
					<th>Kuantitas Retur</th>
					<th>Harga Satuan</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Produk A</td>
					<td>10</td>
					<td>2</td>
					<td>Rp 100.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
