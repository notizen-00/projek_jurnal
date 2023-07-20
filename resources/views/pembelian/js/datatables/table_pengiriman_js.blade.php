<script type="text/javascript">
 $.fn.dataTable.ext.buttons.reload = {
            text: '<i class="fas fa-sync"></i> Refresh',
            action: function (e, dt, node, config) {
                dt.ajax.reload();
            }
        };
  $("#table_pengiriman").DataTable({
            // Other DataTable options
            processing: true,
            serverSide: true,
            ajax: "{{ secure_url('pembelian/pengiriman/datatable') }}",
            columns: [{
                    data: 'tgl_transaksi',
                    name: 'tgl_transaksi'
                },
                {
                    data: 'html_notransaksi',
                    name: 'html_notransaksi'
                },
                {
                    data: 'nama_kontak',
                    name: 'nama_kontak'
                },
                {
                    data: 'status_pengiriman',
                    name: 'status_pengiriman'
                },
                {
                    data: 'tag',
                    name: 'tag'
                }
            ],
            lengthMenu: [10, 25, 50],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print', // Tambahkan ikon menggunakan elemen <i> dengan kelas CSS yang sesuai
                    className: 'btn btn-md btn-primary'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel', // Tambahkan ikon menggunakan elemen <i> dengan kelas CSS yang sesuai
                    className: 'btn btn-md btn-primary'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF', // Tambahkan ikon menggunakan elemen <i> dengan kelas CSS yang sesuai
                    className: 'btn btn-md btn-primary'
                },
                'reload',

            ],
            pagingType: "full_numbers",
            language: {
                emptyTable: "No data available in the tables"
            }
        });

</script>