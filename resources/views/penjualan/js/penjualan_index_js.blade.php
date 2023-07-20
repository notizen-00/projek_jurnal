<script>
    $.fn.dataTable.ext.buttons.reload = {
        text: '<i class="fas fa-sync"></i> Refresh',
        action: function (e, dt, node, config) {
            dt.ajax.reload();
        }
    };
    $(".table-penjualan").DataTable({

        processing: true,
        serverSide: true,
        ajax: "{{ secure_url('penjualan/datatable') }}",
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
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^0-9,]/g, '').replace(',', '.') * 1 :
                    typeof i ===
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
            $(api.column(6).footer()).html(formatRupiah(pageTotal, 'Rp') + '(' + formatRupiah(total,
                    'Rp') +
                ')');
            $(api.column(5).footer()).html(formatRupiah(pageTotall, "Rp") + '(' + formatRupiah(totall,
                    'Rp') +
                ')');
        },
        dom: 'Blfrtip',
        buttons: [
            {
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

    });

</script>
<script>
    $(document).ready(function () {
        // Click event handler for nav-widget links
        $(document).on('click', '.nav-widget', function (e) {
            e.preventDefault();
            var href = $(this).attr("href");
            var no = $(this).attr('data-id');
            var no_transaksi = $(this).attr('data-transaksi');
            // Membuat tab baru
            if ($('.nav-link[href="#tab-' + no + '"]').length > 0) {
                // Jika sudah terbuka, aktifkan tab yang sudah ada
                $('.nav-link[href="#tab-' + no + '"]').tab("show");
            } else {
                // Jika belum terbuka, tambahkan tab baru
                var tabContent = "<div class='tab-pane' id=tab-" + no +
                    "><iframe scrolling='no' frameborder='0'  src='" + href +
                    "' style='width:100%; height:1900px;'></iframe></div>";
                var tabLink = "<li class='nav-item'><a class='nav-link' data-toggle='tab' href='#tab-" +
                    no + "'>" + no_transaksi +
                    " <button type='button' class='close-tab btn-sm btn-outline-danger' data-id='" +
                    no +
                    "' aria-label='Close'><span aria-hidden='true'>&times;</span></button></a></li>";

                // Menambahkan tab baru ke dalam DOM
                $(".tab-content").append(tabContent);
                $(".nav-tabs").append(tabLink);

                // Mengaktifkan tab baru
                $(".nav-link[href='#tab-" + no + "']").tab("show");

                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            }
        });

        $(document).on('click', '.nav-link button.close-tab', function (e) {
            e.preventDefault();
            var tabId = $(this).closest(".nav-link").attr("href");
            $(this).closest(".nav-item").remove();
            $(tabId).remove();

            // Mengaktifkan tab terakhir setelah menutup tab
            $(".nav-link:last").tab("show");
        });


    });

    $('[name=filter_range]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {

        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
            'YYYY-MM-DD'));
    });

</script>
