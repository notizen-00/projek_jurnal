<script>
    $(document).ready(function () {


        $(document).on('change', 'select[name*=nama_produk]', function (e) {
            e.preventDefault();
            var $element = $(this);
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= url('produk/info') ?>/" + id + "/beli",
                method: 'get',
                success: function (data) {

                    var obj = JSON.parse(data);
                    let persentase_pajak = obj.pajaks_beli.persentase;
                    unit = obj.unit_produk.nama_unit;
                    let harga_satuan = obj.harga_beli;
                    deskripsi = obj.deskripsi;
                    $element.closest('tr').find('.stok').val(obj.qty);
                    $element.closest('tr').find('.satuan').val(unit);
                    $element.closest('tr').find('.pajak').val(obj.pajaks_beli.nama_pajak);

                    $element.closest('tr').find('.harga_satuan').val(
                        formatRupiah(harga_satuan, 'Rp'));
                    $element.closest('tr').find('.harga_satuan_int').val(
                        harga_satuan);
                    $element.closest('tr').find('.deskripsi').val(deskripsi);

                    const element_harga_satuan = $element.closest('tr').find(
                        '.harga_satuan');

                    const element_harga_satuan_int = $element.closest('tr')
                        .find(
                            '.harga_satuan_int');
                    const element_qty = $element.closest('tr').find('.qty');
                    const element_subtotal = $element.closest('tr').find(
                        '.subtotal');
                    const element_subtotal_int = $element.closest('tr').find(
                        '.subtotal_int');


                    $(element_harga_satuan).on('focusin', function (e) {
                        e.preventDefault();
                        $(this).bind('focusout');
                        var isi = $(this).val(harga_satuan);
                        $(this).data('val', isi);
                        $(this).data('element',
                            element_harga_satuan_int);

                    }).on('change', function () {
                        var element = $(this).data('element');
                        var prev = $(this).data('val');
                        var current = $(this).val();
                        element.val(current);
                        harga_satuan = formatRupiah(current, "Rp");
                        $(this).data('element_change', current);
                        $(this).data('val', prev);
                        $(this).trigger('focusin');
                        $(element_qty).trigger('change');


                    }).on('focusout', function (e) {

                        $(this).val(formatRupiah(harga_satuan, "Rp"));
                    });

                    $(element_qty).on('change', function (e) {
                        var jumlah_barang = $(this).val();

                        var subtotal = element_harga_satuan_int.val() *
                            jumlah_barang;

                        if ($("#toggle_pajak").is(':checked')) {
                            element_subtotal.val(formatRupiah(subtotal,
                                "Rp"));
                            element_subtotal_int.val(subtotal);

                            var total = $($element).closest('tr').find(
                                '.subtotal_int');

                            var TotalValue = 0;

                            $(".isi_produk tr").each(function () {
                                TotalValue += parseInt($(this).find(
                                        '.subtotal_int')
                                    .val());
                            });
                            var pajak = (TotalValue * persentase_pajak) / 100;

                            var GrandTotal = TotalValue + pajak;

                            $(".total_subtotal").text(formatRupiah(TotalValue,
                                "Rp"));
                            $(".total_pajak").text(formatRupiah(pajak, "Rp"));
                            $(".total_view").text(formatRupiah(GrandTotal, "Rp"));
                            $("[name=total]").val(GrandTotal);
                            $("[name=pajak]").val(pajak);
                            $("[name=sisa_tagihan]").val(GrandTotal);




                        } else {

                           
                            var dpp = (100 / 111) * subtotal;
                        
                            element_subtotal.val(formatRupiah(subtotal,
                                "Rp"));
                            element_subtotal_int.val(parseFloat(dpp.toFixed(2)));

                            var total = $($element).closest('tr').find(
                                '.subtotal_int');

                            var TotalValue = 0;
                            var subtotal_final = 0;

                            $(".isi_produk tr").each(function () {
                                TotalValue += parseFloat($(this).find(
                                        '.subtotal_int')
                                    .val());
                            });

                            $(".isi_produk tr").each(function () {
                                subtotal_final += parseFloat($(this).find(
                                        '.subtotal')
                                    .val().replace(/[^0-9]/g, ""));
                            });

                            console.log(subtotal_final);

                           
                            var pajak;
                            var GrandTotal;
                            var pajak_final;
                            var GrandTotal_final;

                             pajak = Math.round(TotalValue * persentase_pajak) / 100;
                           
                             GrandTotal = TotalValue + pajak;
                             console.log(GrandTotal);
                            console.log(subtotal);
                            GrandTotal.toFixed(2);
                             if (GrandTotal > subtotal_final) {
                                pajak_final = Math.floor(TotalValue * persentase_pajak) / 100;
                                console.log('lebih besar');
                                } else if(GrandTotal < subtotal_final) {
                                pajak_final = Math.round(TotalValue * persentase_pajak) / 100;
                                console.log('lebih kec9il');
                                }else if(GrandTotal == subtotal_final)
                                {
                                pajak_final = pajak;
                                console.log('sama');
                                }
                             GrandTotal_final = TotalValue + pajak_final;

                            $(".total_subtotal").text(TotalValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
                            $(".total_pajak").text(pajak_final.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
                            $(".total_view").text(GrandTotal_final.toLocaleString('id-ID', { style: 'currency',currency: 'IDR' }));
                            $("[name=total]").val(GrandTotal_final);
                            $("[name=pajak]").val(pajak_final);
                            $("[name=sisa_tagihan]").val(GrandTotal_final);

                        }





                    })



                }

            })


        })

        $(document).on('change', '#toggle_pajak', function (e) {
            e.preventDefault();

            if ($(this).is(':checked')) {
                $('.qty').trigger('change');
            } else {

                $('.qty').trigger('change');
            }

        })


        $('[aria-haspopup=listbox]').addClass('btn-sm');
        $('[aria-haspopup=listbox]').addClass('bg-info');
        $('[aria-haspopup=listbox]').addClass('text-white');

        $(document).on('keydown', function (e) {


            var html = '<tr>' +
                '<td style="width:17%;">' +
                '<select name="nama_produk[]" data-live-search="true"' +
                'class="form-control selectpicker" title="-- Pilih Produk --"' +
                'style="background-color:white;"' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '<?php foreach($produk as $i){ ?>' +
                '<option data-tokens="<?=  $i->nama_produk ?>" value="<?= $i->id ?>">' +
                '<?=  $i->nama_produk ?>' +
                '</option>' +
                '<?php } ?>' +
                '</select>' +
                '</td>' +
                '<td style="width: 5%;">' +
                '<input type="number" readonly class="form-control form-control-sm stok"' +
                'style="height:30px; font-size:smaller; padding-top:3px;"' +
                'name="stok" />' +
                '<td style="width: 5%;">' +
                '<input type="number" class="form-control form-control-sm qty"' +
                'style="height:30px; font-size:smaller; padding-top:3px;"' +
                'name="qty[]" />' +
                '</td>' +
                '<td style="width: 7%;">' +
                '<input type="text" name="satuan[]" readonly class="form-control satuan"' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '</td>' +
                '<td>' +
                '<input type="text"' +
                'class="form-control form-control-sm text-right font-weight-bold harga_satuan"' +
                'style="height:30px; font-size:smaller; padding-top:3px;"' +
                'name="harga_satuan[]" placeholder="Rp. 0,00" />' +
                '<input type="hidden" name="harga_satuan_int[]" class="harga_satuan_int">' +
                '</td>' +
                '<td class="text-right" style="width:7%;">' +
                '<input type="text" name="pajak_id[]" class="form-control form-control-sm pajak" readonly>' +
                '</td>' +
                '<td>' +
                '<input type="text"' +
                'class="form-control form-control-sm text-right font-weight-bold subtotal"' +
                'style="height:30px; font-size:smaller; padding-top:3px;"' +
                'name="subtotal[]" placeholder="Rp. 0,00" />' +
                '<input type="hidden" class="subtotal_int" name="subtotal_int[]" />' +
                '</td>' +
                '<td class="text-right">' +
                '<span style="cursor: pointer;"' +
                'class="fas fa-trash text-danger hapus_baris"></span>' +
                '</td>' +
                '</tr>';
            if (e.keyCode == 13 || e.which == 13) {
                e.preventDefault();

                if ($('.isi_produk tr').length > 0) {
                    $('.isi_produk tr:last').after(html);
                } else {
                    e.preventDefault();
                    $('.isi_produk').html(html);
                }
            }

            $(".selectpicker").selectpicker();
            $('[aria-haspopup=listbox]').addClass('btn-sm');


            $('[aria-haspopup=listbox]').addClass('bg-info');
            $('[aria-haspopup=listbox]').addClass('text-white');

            $(".hapus_baris").on('click', function (e) {
                var whichtr = $(this).closest("tr");

                whichtr.remove();
                $('.qty').trigger('change');
            });
        });



        $(document).off('submit', '#form_pembelian').on('submit', '#form_pembelian', function (e) {
            e.preventDefault();
            event.stopPropagation()
            var formdata = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("pembelian.store") }}',
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

                                var pageurl = "<?= url('pembelian') ?>/" + obj
                                    .id;
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

                },
                error: function (response) {
                    var errors = response.responseJSON.errors;
                    var errorHtml = '';

                    $.each(errors, function (key, value) {
                        errorHtml += '<li>' + value + '</li>';
                        Swal.fire({
                            title: "Data Gagal di simpan ",
                            html: errorHtml,
                            icon: "error",
                            position: 'top',

                        });

                    });


                }
            })


        })

        $(document).on('change', '[name=syarat_pembayaran]', function (e) {

            e.preventDefault();
            var isi = $(this).val();
            var tanggal = '';
            if (isi == 3) {

                tanggal = get_diff(30);
            } else if (isi == 4) {

                tanggal = get_diff(60);
            } else if (isi == 1) {
                tanggal = '';
            } else if (isi == 2) {
                tanggal = '';
            }

            $("[name=tgl_jatuh_tempo]").val(tanggal);

        })

        
       

    })

</script>
