<script>
    $(document).ready(function () {

        $(".selectpicker").selectpicker();

        $(document).on('change', 'input[name*=debit]', function (e) {
            e.preventDefault();
            var isi = $(this).val();

            var kredit = $(this).closest('tr').find('.kredit');
            if (isi != 0) {
                kredit.val(0);
            } else {
                kredit.val('');
            }

            var TotalKredit = 0;
            var TotalDebit = 0;

            $(".isi_jurnal tr").each(function () {
                TotalDebit += parseInt($(this).find('.debit').val()) || 0;
            });

            $(".isi_jurnal tr").each(function () {
                TotalKredit += parseInt($(this).find('.kredit').val()) || 0;
            });

            $('.total_debit').text(formatRupiah(TotalDebit, 'Rp'));
            $('.total_kredit').text(formatRupiah(TotalKredit, 'Rp'));
            $("[name=total_debit_int]").val(TotalDebit);
            $("[name=total_kredit_int]").val(TotalKredit);


        })



        $(document).on('change', 'input[name*=kredit]', function (e) {
            e.preventDefault();
            var isi = $(this).val();
            var debit = $(this).closest('tr').find('.debit');
            if (isi != 0) {
                debit.val(0);
            } else {
                debit.val('');
            }

            var TotalKredit = 0;
            var TotalDebit = 0;

            $(".isi_jurnal tr").each(function () {
                TotalDebit += parseInt($(this).find('.debit').val()) || 0;
            });

            $(".isi_jurnal tr").each(function () {
                TotalKredit += parseInt($(this).find('.kredit').val()) || 0;
            });

            $('.total_debit').text(formatRupiah(TotalDebit, 'Rp'));
            $('.total_kredit').text(formatRupiah(TotalKredit, 'Rp'));
            $("[name=total_debit_int]").val(TotalDebit);
            $("[name=total_kredit_int]").val(TotalKredit);
        })

        $(document).off('submit','#form_jurnal').on('submit', '#form_jurnal', function (e) {
            e.preventDefault();

            var TotalKredit = $("[name=total_kredit_int]").val();
            var TotalDebit = $("[name=total_debit_int]").val();

            if (TotalKredit != TotalDebit) {

                alert("jumlah kredit dan debit harus seimbang");
            } else {
                var formdata = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("jurnal.store") }}',
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

                                    var pageurl = "<?= url('account') ?>";
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
            }

        })



        $('[aria-haspopup=listbox]').addClass('btn-sm');
        $('[aria-haspopup=listbox]').addClass('bg-info');
        $('[aria-haspopup=listbox]').addClass('text-white');

        $(document).off('keypress').on('keypress', function (e) {


            var html = '<tr>' +
                '<td style="width:30%;" class="anak">' +
                '<select name="akun[]" required data-live-search="true"' +
                'class="form-control selectpicker" title="-- Pilih Akun --"' +
                'style="background-color:white;"' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '@foreach($akun as $i)' +
                '<option data-tokens="{{ $i->nama_akun }}"' +
                'value="<?= $i->id ?>">' +
                '( {{ $i->nama_akun }} | {{ $i->kode_akun }} )' +
                '</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td style="width:15%;"><input type="text" class="form-control form-control-sm deskripsi" name="deskripsi"></td>' +
                '<td style="width: 15%;">' +
                '<input type="text" required class="form-control form-control-sm debit"' +
                'style="height:30px; font-size:smaller; padding-top:3px;"' +
                'name="debit[]" />' +
                '</td>' +
                '<td style="width: 15%;">' +
                '<input type="text" required name="kredit[]" class="form-control kredit"' +
                'style="height:30px; font-size:smaller; padding-top:3px;">' +
                '</td>' +
                '<td class="text-center" style="width:5%;">' +
                '<span style="cursor: pointer;"' +
                'class="fas fa-trash text-danger hapus_baris"></span>' +
                '</td>';

            if (e.which == 13) {
                if ($('.isi_jurnal tr').length > 0) {
                    $('.isi_jurnal tr:last').after(html);
                } else {
                    $('.isi_jurnal').html(html);
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
