<script>
   

    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $(document).on('change','[name=jumlah_pembayaran]', function (e) {
        e.preventDefault();
        var isi = $(this).val();

        $('.total_view').text(formatRupiah(isi, "Rp"));

        $('.total_view').trigger('change');


    });

    $(document).off('submit','#form_pembayaran').on('submit','#form_pembayaran',function (e) {
        e.preventDefault();

        var formdata = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?= route('pembayaran_penjualan.store') ?>",
            method: "POST",
            data: formdata,
            success: function (data) {
                var obj = JSON.parse(data);
          

                Swal.fire({
                    title: "Sukses",
                    text: 'Pembayaran dengan no transaksi '+ obj.no_transaksi +' telah sukses',
                    icon: "success",
                    position: 'top',
                    didOpen: () => {

                        var pageWidget = "<?= url('widget') ?>";
                        $('.widget-top').load(pageWidget);

                        $('.content').load(obj.url, function () {

                            $(".selectpicker").selectpicker(
                                'render');
                        });

                    },
                });


            }

        })
    })



</script>
