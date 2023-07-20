<script>
    $(document).ready(function () {

        $.fn.dataTable.ext.buttons.reload = {
            text: '<i class="fas fa-sync"></i> Refresh',
            action: function (e, dt, node, config) {
                dt.ajax.reload();
            }
        };

        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[0]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });
        var table_pembelian = $(".table_pembelian").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ secure_url('pembelian/datatable') }}",
            columns: [{
                    data: 'tgl_transaksi',
                    name: 'tgl_transaksi'
                },
                {
                    data: 'html_notransaksi',
                    name: 'html_notransaksi'
                },
                {
                    data: 'kontak',
                    name: 'kontak'
                },
                {
                    data: 'tgl_jatuh_tempo',
                    name: 'tgl_jatuh_tempo'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'sisa_tagihan',
                    name: 'sisa_tagihan'
                },
                {
                    data: 'total',
                    name: 'total'
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
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[^0-9,]/g, '').replace(',', '.') *
                        1 : typeof i ===
                        'number' ? i :
                        0;
                };

                // Total over all pages
                total = api
                    .column(6)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(6, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                totall = api
                    .column(5)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotall = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(6).footer()).html(formatRupiah(pageTotal, 'Rp') + '(' + formatRupiah(
                        total,
                        'Rp') +
                    ')');
                $(api.column(5).footer()).html(formatRupiah(pageTotall, "Rp") + '(' + formatRupiah(
                        totall,
                        'Rp') +
                    ')');
            },
        });

        $('#min, #max').on('change', function () {
            table_pembelian.draw();
        });


      

       

    })

</script>