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

        $(document).on('change', '[name*=gudang_id]', function (e) {
            e.preventDefault();

            var $this = $(this);
            var id = $(this).val();
            var produk = $this.closest('tr').find('[name*=nama_produk]').val();
            if (produk == '') {

                alert('silahkan isi produk dulu');
                $(this).val('');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?= url('gudang/info_product') ?>/" + produk + "/" + id,
                    method: 'get',
                    success: function (data) {
                        var obj = JSON.parse(data);
                        var stok = parseInt(obj.stok);
                        $this.closest('tr').find('.stok').val(stok);


                    }
                })

            }


        })
        $(document).on('change', 'select[name*=nama_produk]', function (e) {
            e.preventDefault();
            var $element = $(this);
            var gudang_selector = $(this).closest('tr').find('[name*=gudang_id]');
            var id = $(this).val();
            $(gudang_selector).trigger('change');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= url('produk/info') ?>/" + id + "/jual",
                method: 'get',
                success: function (data) {


                    var obj = JSON.parse(data);
                   
                    unit = obj.unit_produk.nama_unit;
                    let persentase_pajak = 11;
                    let harga_satuan = obj.harga_jual;
                    deskripsi = obj.deskripsi;
                    $element.closest('tr').find('.satuan').val(unit);
                    $element.closest('tr').find('.pajak').val('PPN');
                    $element.closest('tr').find('.harga_satuan').val(
                        formatRupiah(harga_satuan, 'Rp'));
                    $element.closest('tr').find('.harga_satuan_int').val(
                        harga_satuan);

                    



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


                        var stok = $element.closest('tr').find('.stok').val();

                        if (jumlah_barang > parseInt(stok)) {
                            alert('jumlah barang tidak boleh lebih dari stok');
                            $(this).val('');
                            $(element_qty).trigger('change');


                        } else {
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
                                $(".total_view").text(formatRupiah(GrandTotal,
                                    "Rp"));
                                $("[name=total]").val(GrandTotal);
                                $("[name=pajak]").val(pajak);
                                $("[name=sisa_tagihan]").val(GrandTotal);




                            } else {

                                var dpp = 100 / 111 * subtotal;
                                var pjk = dpp * persentase_pajak /
                                    100;
                                var pajak = parseFloat(pjk.toFixed(2));
                                element_subtotal.val(formatRupiah(subtotal,
                                    "Rp"));
                                element_subtotal_int.val(dpp.toFixed(2));

                                var total = $($element).closest('tr').find(
                                    '.subtotal_int');

                                var TotalValue = 0;

                                $(".isi_produk tr").each(function () {
                                    TotalValue += parseFloat($(this).find(
                                            '.subtotal_int')
                                        .val());
                                });
                                // var pajak = (TotalValue * persentase_pajak) / 100;

                                var GrandTotal = TotalValue + pajak;

                                $(".total_subtotal").text(TotalValue.toLocaleString(
                                    'id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }));
                                $(".total_pajak").text(pajak.toLocaleString(
                                    'id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }));
                                $(".total_view").text(formatRupiah(GrandTotal,
                                    "Rp"));
                                $("[name=total]").val(GrandTotal);
                                $("[name=pajak]").val(pajak);
                                $("[name=subtotal_akun]").val(TotalValue);
                                $("[name=sisa_tagihan]").val(GrandTotal);

                            }
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


        $(document).off('keypress').on('keypress', function (e) {

            var html = '<tr>' +
                '<td style="width:17%;">' +
                '<select name="nama_produk[]" data-live-search="true"' +
                'class="form-control selectpicker" title="-- Pilih Produk --"' +
                'style="background-color:white;"' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '<?php foreach($produk as $i){ ?>' +
                '<option data-tokens="<?=  $i->nama_produk ?>" value="<?= $i->id ?>">' +
                '<?php if($i->tipe_produk == 1){ ?>'+
                '<?=  $i->nama_produk ?>' +
                '<?php } else { ?>'+
                '<?= $i->nama_produk ?> -- (Bundle)'+
                '<?php } ?>'+
                '</option>' +
                '<?php }  ?>' +
                '</select>' +
                '</td>' +
                '<td style="width:5%;"><input type="text" class="form-control form-control-sm stok" name="stok" readonly></td>' +
                '<td style="width:10%;">' +
                '<select name="gudang_id[]" class="form-control" required ' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '<option value="">-- Pilih Gudang --</option>' +
                '<?php foreach($gudang as $i) { ?>' +
                '<option value="<?= $i->id ?>"><?= $i->nama_gudang ?></option>' +
                '<?php } ?>' +
                '</select>' +
                '</td>' +
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
                '<td class="text-center">' +
                '<span style="cursor: pointer;"' +
                'class="fas fa-trash text-danger hapus_baris"></span>' +
                '</td>' +
                '</tr>';

            if (e.which == 13) {
                if ($('.isi_produk tr').length > 0) {
                    $('.isi_produk tr:last').after(html);
                } else {
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
            });
        });

        $(document).on('click', '.refresh_penjualan_invoice', function (e) {
            e.preventDefault();

            window.location.href = "<?= url('') ?>/penjualan/baru";

        })

        $(document).on('submit', '#form_penjualan', function (e) {
            e.preventDefault();

            var formdata = $(this).serialize();
            var karyawan = $("[name=id_karyawan]").val();



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                }
            });
            $.ajax({
                url: '{{ route("penjualan.store") }}',
                data: formdata,
                method: 'post',
                success: function (data) {
                    var obj = JSON.parse(data);

                    if (obj.status == 200) {


                        Swal.fire({
                            title: "Sukses",
                            text: obj.message,
                            icon: "success",
                            position: 'top',
                            didOpen: () => {

                                var pageurl =
                                    "<?= url('') ?>/penjualan";
                                window
                                    .location
                                    .href =
                                    pageurl;

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
