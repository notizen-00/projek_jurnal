<script>
    $(document).ready(function () {


        const table_pembayaran = $('.table-pembayaran').DataTable({
            ajax: {
                url: "<?= url('penjualan/pembayaran/data') ?>",
                dataSrc: ""
            },
            columns: [{
                    data: 'tgl_transaksi'
                },
                {
                    data: 'uid_pembayaran'
                },
                {
                    data: 'nama_kontak'
                },
                {
                    data: 'metode_pembayaran'
                },
                {
                    data: 'nomor_transaksi',
                },
                {
                    data: 'metode_pembayaran'
                },
                {
                    data: 'jumlah_pembayaran',
                    render: function (data, type, row) {
                        
                        return formatRupiah(data,'Rp');
                    }

                }
            ]
        });

    });

</script>
