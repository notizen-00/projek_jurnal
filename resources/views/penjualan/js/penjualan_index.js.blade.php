<script>
        function updatePembelian() {
  $.ajax({
    url: 'penjualan/get_data', // replace with your own URL
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // update the table data
      $('.isi_penjualan').html(data);
    }
  });
}

$(document).ready(function() {
  // update the table every 5 seconds
  setInterval(function() {
    updatePembelian();
  }, 3000);
});

 
        $(".table-penjualan").DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\R\p\.,]/g, '') * 1 : typeof i ===
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
            var tabContent = "<div class='tab-pane' id=tab-" + no +
                "><iframe scrolling='no' frameborder='0'  src='" + href +
                "' style='width:100%;height:1200px;'></iframe></div>";
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

            $(document).on('click', '.nav-link[href="#tab-' + no + '"] button', function (e) {
                e.preventDefault();
                console.log('test');
                $(this).closest(".nav-item").remove();
                $($(this).closest(".nav-link").attr("href")).remove();

                // Mengaktifkan tab sebelumnya (jika ada)
                $(".nav-link:last").tab("show");

            })
        });


    });

    $('[name=filter_range]').daterangepicker({
opens: 'left'
}, function(start, end, label) {

console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});

</script>