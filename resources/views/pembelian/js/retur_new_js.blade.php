<script>
    $(document).ready(function () {


        var tipe_pajak = '';
        var supplier = $("[name=id_kontak").val();
        var searchTransaksi = $("#search_retur");
        $("[name=id_kontak]").on('change', function () {
            supplier = $(this).val();
            if (supplier == '') {
                searchTransaksi.autocomplete('disable');
                alert('Isikan dulu data supplier');
            } else {
                searchTransaksi.autocomplete('enable');
            }
        });

        // $('[name=supplier]').trigger('change');
        searchTransaksi.autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ url('ajax/data_retur') }}",
                    dataType: "json",
                    data: {
                        term: request.term,
                        supplier: supplier,
                    },
                    success: function (data) {

                        if (supplier == '') {
                            alert('isikann dulu data supplier');
                            searchTransaksi.val('');
                        } else {
                            response(data);
                        }

                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {

                var id_pembelian = ui.item.label;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?= url('ajax/get/data_retur') ?>",
                    method: 'POST',
                    data: {
                        id_pembelian: id_pembelian
                    },
                    success: function (data) {

                        $(".isi_produk_retur").html(data);

                        $.ajax({
                            url: "<?= url('ajax/data_retur/get') ?>",
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                id_pembelian: id_pembelian
                            },
                            success: function (data) {


                                var html_pajak = '';
                                var html_gudang = '';
                                if (data.data_pembelian.pajak == 0) {
                                    html_pajak =
                                        '<span class="badge badge-danger">Tidak Termasuk Pajak</span> <input type="hidden" name="tipe_pajak" value="' +
                                        data.data_pembelian.pajak + '">';
                                } else if (data.data_pembelian.pajak == 1) {
                                    html_pajak =
                                        '<span class="badge badge-success">Termasuk Pajak</span> <input type="hidden" name="tipe_pajak" value="' +
                                        data.data_pembelian.pajak + '">';
                                }

                                html_gudang = data.data_pembelian.gudang_id;

                                $("[name=gudang_id]").val(html_gudang);
                                $('.tipe_pajak').html(html_pajak);
                                $("[name=id_pembelian]").val(data
                                    .data_pembelian.id);
                                $("[name=sisa_tagihan]").val(data
                                    .sisa_tagihan);
                                $(".sisa_tagihan").text(formatRupiah(data
                                    .sisa_tagihan, "Rp"));

                                var tipePajakInput = $(
                                    'input[name="tipe_pajak"]');
                                tipe_pajak = tipePajakInput.eq(1).val();

                                searchTransaksi.val('');

                                // $("[name=*qty_retur]").trigger('change');
                                $(".sub_total").text("Rp.0,00");
                                $(".pajak").text("Rp.0,00");
                                $(".total_retur").text('Rp.0,00');
                                $("[name=total_retur]").val('');
                                $("[name=pajak_retur]").val('');

                            },
                            error: function (xhr, status, error) {
                                // Tangani kesalahan jika terjadi
                                console.log(xhr.responseText);
                            }
                        });
                        $(".isi_produk_retur .hapus_row").on('click', function (e) {
                            var whichtr = $(this).closest("tr");

                            whichtr.remove();
                            $('.qty').trigger('change');
                        });

                    }
                });
            }, //HERE - make sure to add the comma after your select
            response: function (event, ui) {
                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: "No results found"
                    };
                    ui.content.push(noResult);
                }
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {

            return $("<li>")
                .append("<div>" + item.value + " -- (" + item.label + ")</div>")
                .appendTo(ul);
        };

        $(document).on('change', '[name*=qty_retur]', function (e) {

            e.preventDefault();

            var qty_retur = $(this).val();
            console.log(qty_retur);

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
                alert('qty retur tidak boleh lebih dari qty pembelian');

            } else {

                console.log(tipe_pajak);
                total_retur = qty_retur * harga_satuan_int;

                var persen_pajak = 11;

                if (tipe_pajak == 0) {

                    subtotal.val(formatRupiah(total_retur, "Rp"));
                    subtotal_int.val(total_retur);

                    $(".isi_produk_retur tr").each(function () {
                        TotalValue += parseInt($(this).find(
                                '.subtotal_int')
                            .val());
                    });

                    var pajak = (TotalValue * persen_pajak) / 100;

                    $(".sub_total").text(formatRupiah(TotalValue, "Rp"));
                    $(".pajak").text(formatRupiah(pajak, "Rp"));
                    $("[name=pajak_retur]").val(pajak);
                    var GrandTotal = TotalValue + pajak;

                    $(".total_retur").text(formatRupiah(GrandTotal, 'Rp'));
                    $("[name=total_retur]").val(GrandTotal);


                } else if (tipe_pajak == 1) {

                    var dpp = (100 / 111) * total_retur;

                    subtotal.val(formatRupiah(total_retur,
                        "Rp"));
                    subtotal_int.val(dpp.toFixed(2));

                    var TotalValue = 0;
                    $(".isi_produk_retur tr").each(function () {
                        TotalValue += parseFloat($(this).find(
                                '.subtotal_int')
                            .val());
                    });

                    // console.log(TotalValue);
                    var pjk = TotalValue * persen_pajak / 100;
                    var pajak = parseFloat(pjk.toFixed(2));
                    // var pajak = (TotalValue * persentase_pajak) / 100;

                    var GrandTotal = parseFloat(TotalValue + pajak);

                    $(".sub_total").text(TotalValue.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }));
                    $(".pajak").text(pajak.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }));
                    $(".total_retur").text(formatRupiah(GrandTotal, "Rp"));
                    $("[name=total_retur]").val(GrandTotal);
                    $("[name=pajak_retur]").val(pajak);
                    // $("[name=sisa_tagihan]").val(GrandTotal);

                }



            }
        })

        $(".isi_produk_retur .hapus_row").on('click', function (e) {
            var whichtr = $(this).closest("tr");

            whichtr.remove();
            $('.qty').trigger('change');
        });
        $(document).on('change', '[name*=jumlah_pembayaran]', function (e) {

            var jumlah = $(this).closest('tr').find('.jumlah_pembayaran').val();
            var TotalValue = 0;

            $(".isi_payment tr").each(function () {
                TotalValue += parseFloat($(this).find(
                        '.jumlah_pembayaran')
                    .val());


            });

            $("[name=total]").val(TotalValue);
            $(".total_view").text(formatRupiah(TotalValue, 'Rp'));

        })

        $(document).off('submit', '#form_payment').on('submit', '#form_payment', function (e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= route('pembayaran.store') ?>",
                method: "POST",
                data: formdata,
                success: function (response) {
                    var obj = JSON.parse(response);
                    var pageurl = "<?= url('') ?>/" + obj.url;
                    window.location.href = pageurl;
                }


            })

        })

        $(document).off('submit', '#form_retur').on('submit', '#form_retur', function (e) {
            e.preventDefault();

            var formdata = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url("pembelian/retur_store") }}',
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
                                var pageurl =
                                    "<?= url('pembelian/retur/list') ?>";
                                window.location.href = pageurl;

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





    });

</script>
