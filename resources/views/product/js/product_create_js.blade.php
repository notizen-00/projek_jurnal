<script>
    $(window).ready(function () {
        $('[aria-owns=bs-select-1]').addClass('btn-md');
        $('[aria-owns=bs-select-1]').addClass('bg-primary');
        $('[aria-owns=bs-select-1]').addClass('text-white');
        $('[aria-owns=bs-select-1]').addClass('mr-5');
        $('[aria-owns=bs-select-1]').css('margin-top', '-10px');

        $('[aria-owns=bs-select-2]').addClass('btn-md');
        $('[aria-owns=bs-select-2]').addClass('bg-primary');
        $('[aria-owns=bs-select-2]').addClass('text-white');
        $('[aria-owns=bs-select-2]').css('margin-top', '-23px');
    })


    $(document).on('change', '[name=jenis_produk]', function (e) {
        e.preventDefault();

        var isi = $(this).val();

        if (isi == 1) {

            $("a[href='#group_setting'").addClass('disabled');
            $("a[href='#home'").removeClass('disabled');
            $("#group_setting").removeClass('active');
            $("#home").addClass('active');
        } else if (isi == 2) {

            $("[name=unit]").val(9);
            $("a[href='#group_setting'").removeClass('disabled');
            $("a[href='#home'").addClass('disabled');
            $("#home").removeClass('active');
            $("#group_setting").addClass('active');
        }

    })
    var searchBarang = $("#search_barang");
    searchBarang.autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "{{ url('ajax/data_product') }}",
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {

                    response(data);

                }
            });
        },
        minLength: 2,
        select: function (event, ui) {

            var id_product = ui.item.label;

            $("#bundle_modal").modal("show");

            $.ajax({
                url: "<?= url('ajax/produk_bundle/modal') ?>/" + id_product,
                method: "GET",
                success: function (data) {

                    $(".detail_produk_bundle").html(data);


                }

            })

            $(document).on('change', '.qty_produk', function (e) {
                e.preventDefault();

                var isi = $(this).val();

                $('[name=qty_produk]').text(isi);


            })

            $(document).off("click", '.confirm_bundle').on("click", ".confirm_bundle", function (e) {

                var qty = $("[name=qty_produk]").text();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?= url('ajax/get/data_product') ?>",
                    method: "post",
                    data: {
                        id_product: id_product,
                        qty: qty
                    },
                    success: function (data) {

                        $(".isi_bundle").append(data);

                        searchBarang.val('');

                        $("#bundle_modal").modal('hide');



                        $(".isi_bundle .hapus_baris").on('click', function (e) {
                            var whichtr = $(this).closest("tr");

                            whichtr.remove();

                        });



                        // Inisialisasi variabel untuk menyimpan total akumulasi
                        var total = 0;

                        var subtotalCells = document.querySelectorAll(
                            ".table_bundle .isi_bundle td:nth-child(6)");

                        // Iterasi melalui setiap sel dalam kolom harga
                        subtotalCells.forEach(function (cell) {
                            // Dapatkan teks dari sel
                            var hargaText = cell.textContent;

                            // Hapus karakter non-numerik
                            var harga = parseInt(hargaText.replace(/[^0-9,]/g,
                                ''));

                            // Tambahkan harga ke total
                            total += harga;


                        });

                        $("[name=harga_jual_bundle]").val(formatRupiah(total, "Rp"));


                    }

                })


            })


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

    $(".isi_bundle .hapus_baris").on('click', function (e) {
        e.preventDefault();
        var whichtr = $(this).closest("tr");

        whichtr.remove();

        var total = 0;

        var subtotalCells = document.querySelectorAll(
            ".table_bundle .isi_bundle td:nth-child(6)");

        // Iterasi melalui setiap sel dalam kolom harga
        subtotalCells.forEach(function (cell) {
            // Dapatkan teks dari sel
            var hargaText = cell.textContent;

            // Hapus karakter non-numerik
            var harga = parseInt(hargaText.replace(/[^0-9,]/g, ''));

            // Tambahkan harga ke total
            total += harga;


        });

        $("[name=harga_jual_bundle]").val(formatRupiah(total, "Rp"));

    });

    $("#check_harga_jual").on("change", function () {
        if ($(this).is(":checked")) {
            // Checkbox tercentang

            var total = 0;

            var subtotalCells = document.querySelectorAll(
                ".table_bundle .isi_bundle td:nth-child(6)");

            // Iterasi melalui setiap sel dalam kolom harga
            subtotalCells.forEach(function (cell) {
                // Dapatkan teks dari sel
                var hargaText = cell.textContent;

                // Hapus karakter non-numerik
                var harga = parseInt(hargaText.replace(/[^0-9,]/g, ''));

                // Tambahkan harga ke total
                total += harga;


            });

            $("[name=harga_jual_bundle]").val(formatRupiah(total, "Rp"));
            // Tambahkan logika atau tindakan yang ingin Anda lakukan saat checkbox tercentang
        } else {
            // Checkbox tidak tercentang
            $('[name=harga_jual_bundle]').val('');
            // Tambahkan logika atau tindakan yang ingin Anda lakukan saat checkbox tidak tercentang
        }
    });

    $('[name=gambar]').change(function (e) {

        e.preventDefault();

        const file = this.files[0];
        console.log(file);
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                console.log(event.target.result);
                $('#ImgPreview').attr('src', event.target.result);
                $('#ImgPreview').attr('width', '80px');
                $('#ImgPreview').attr('height', '50px');
            }
            reader.readAsDataURL(file);
            let html =
                '<span class="fas fa-minus text-danger hapus_gambar" style="margin-right:-10px;" data-toggle="tooltip" data-placement="top" title="Hapus Gambar"></span>';
            $(".preview").html(html);
        }

        $(".hapus_gambar").click(function (e) {
            $("[name=gambar]").val('');
            $("#ImgPreview").attr('src', '');
            $("#ImgPreview").attr('width', '');
            $("#ImgPreview").attr('height', '');
            $(".hapus_gambar").remove();

        })
    })


    $(".beli_check").click(function () {
        $(".beli_box :input").attr('disabled', !this.checked)
    });
    $(".jual_check").click(function () {
        $(".jual_box :input").attr('disabled', !this.checked)
    });
    $(".stok_check").click(function () {
        $(".stok_box :input").attr('disabled', !this.checked)
    });


    function modal_kategori() {
        $('#create_kategori').modal('show');
    }


    function modal_unit() {
        $('#create_unit').modal('show');
    }

    $("#form_unit").submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route("unit.store") }}',
            data: formData,
            method: 'post',
            success: function (data) {

                var obj = JSON.parse(data);


                if (obj.status == 200) {

                    $('#create_unit').modal('hide');
                    alert(obj.message);
                    location.reload();


                } else if (obj.status == 201) {

                    alert(obj.message);


                }
            }


        })
    })

    $("#form_kategori").submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route("kategori.store") }}',
            data: formData,
            method: 'post',
            success: function (data) {

                var obj = JSON.parse(data);


                if (obj.status == 200) {

                    $('#create_kategori').modal('hide');
                    alert(obj.message);
                    location.reload();


                } else if (obj.status == 201) {

                    alert(obj.message);


                }
            }


        })
    })

</script>
