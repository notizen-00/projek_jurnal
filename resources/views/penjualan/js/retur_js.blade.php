<script>
    $(document).ready(function () {

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

        $(document).on('change', '[name*=qty_retur]', function (e) {

            e.preventDefault();
          
            var qty_retur = $(this).val();
            var qty_now = $(this).closest('tr').find('input[name="qty"]').val();
            var qty_limit = $(this).closest('tr').find('input[name="qty_limit"]').val();
            var harga_satuan_int = $(this).closest('tr').find('input[name="harga_satuan_int[]"]').val();
            var harga_satuan = $(this).closest('tr').find('input[name="harga_satuan[]"]').val();
            var subtotal_int = $(this).closest('tr').find('input[name="subtotal_int[]"]');
            var subtotal = $(this).closest('tr').find('input[name="subtotal[]"]');
            var total_retur = '';
            var TotalValue = 0;
     

            if (parseInt(qty_retur) > parseInt(qty_limit)) {

                $(this).val('');
                alert('qty retur tidak boleh lebih dari qty penjualan');

            } else {

                total_retur = qty_retur * harga_satuan_int;
                subtotal.val(formatRupiah(total_retur, "Rp"));
                subtotal_int.val(total_retur);


                $(".isi_produk_retur tr").each(function () {
                    TotalValue += parseInt($(this).find(
                            '.subtotal_int')
                        .val());


                });

                $(".total_retur").text(formatRupiah(TotalValue, 'Rp'));
                $("[name=total_retur]").val(TotalValue);

            }
        })

        $(document).off('submit','#form_retur').on('submit', '#form_retur', function (e) {
            e.preventDefault();
      
            var formdata = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url("penjualan/retur_store") }}',
                data: formdata,
                method: 'post',
                success: function (data) {
                    var obj = JSON.parse(data);
                    console.log(obj);

                    if (obj.status == 200) {


                        Swal.fire({
                            title: "Sukses",
                            text: obj.message,
                            icon: "success",
                            position: 'top',
                            didOpen: () => {
                                var pageWidget = "<?= url('widget') ?>";
                                $('.widget-top').load(pageWidget);
                                var pageurl = "<?= url('penjualan') ?>/";
                                $(".content").html('');
                                $('.content').load(pageurl, function () {

                                    $(".selectpicker").selectpicker(
                                        'render');
                                });

                            },
                        });




                    } else if (obj.status == 201) {

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




                }
            })


        })


    })

</script>
