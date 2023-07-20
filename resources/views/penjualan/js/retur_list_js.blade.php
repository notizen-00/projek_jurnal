<script>
    $(document).ready(function () {


        const table_pembayaran = $('.table-retur').DataTable({
            ajax: {
                url: "<?= url('penjualan/retur/data') ?>",
                dataSrc: ""
            },
            columns: [{
                    data: 'transaksi.tgl_transaksi'
                },
                {
                    data: 'uid_retur'
                },
                {
                    data: 'transaksi.kontak_id'
                },
                {
                    data: 'no_transaksi'
                },
                {
                    data: 'jumlah_transaksi',
                    render: function (data, type, row) {

                        return formatRupiah(data, 'Rp');
                    }


                }
            ]
        });

    });

</script>
