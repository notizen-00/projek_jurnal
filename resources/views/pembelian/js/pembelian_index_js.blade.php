
<script>
    $(document).ready(function () {

        $(document).on('click', '.sync_pembelian', function (e) {
            e.preventDefault();

            $.ajax({
                url: "<?= url('pembelian/get_data') ?>",
                method: "GET",
                success: function (html) {
                    $(".isi_pembelian").html(html);


                }

            })

        })


        var number = (100 / 111) * 10000;
        var roundedNumber = number.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });;

        console.log(roundedNumber);
        $(document).on('click', '.reset_pembelian', function (e) {
            e.preventDefault();
            confirm('anda akan mereset pembelian');
            $.ajax({
                url: "{{ route('pembelian.reset') }}",
                method: "GET",
                success: function (data) {

                    var obj = JSON.parse(data);

                    Swal.fire({
                        position: 'top',
                        title: 'Sukses',
                        width: '900px',
                        customClass: 'swal-height',
                        text: obj.message,
                        icon: 'error',
                        confirmButtonText: 'Lanjutkan'
                    })

                }

            })

        })

        $('.pemesanan_tippy').each(function() {
    tippy(this, {
      content: $(this).attr('title'),
    });
  });
        // Click event handler for nav-widget links
        $(document).on('click', '.nav-widget', function (e) {
            e.preventDefault();
            var href = $(this).attr("href");
            var no = $(this).attr('data-id');
            var no_transaksi = $(this).attr('data-transaksi');

            // Cek apakah tab dengan ID yang sama sudah terbuka
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


    })

    function setIframeHeight(frame) {
        frame.style.height = frame.contentWindow.document.body.scrollHeight + 'px';
    }

    $('[name=filter_range]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {

        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
            'YYYY-MM-DD'));
    });

</script>
