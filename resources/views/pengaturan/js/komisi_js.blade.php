<script>
   
    $(document).on('click','.detail_komisi',function(e){

        e.preventDefault();

        var id = $(this).attr('data-id');
        

        $.ajax({
            url:"<?= url('komisi/detail/') ?>/"+id,
            method:"GET",
            dataType:"json",
            success:function(data){

                console.log(data);

                $("#detail_komisi").modal('show');

            }

        });
        
    })

    $(document).on('click', '.create_komisi', function (e) {
        e.preventDefault();

        $("#create_komisi").modal('show')

        $('.selectpicker').selectpicker();

    })

    $('input[name="rule_periode"]').change(function (e) {
        e.preventDefault();

        var isi = $(this).val();
        // alert(isi);
        if (isi == 2) {

            $('.periode-tertentu').show();
        } else {
            $('.periode-tertentu').hide();
        }
    });

    $('input[name="rule_sales"]').change(function () {
        if ($(this).val() == 2) {
            $('#tenaga-tertentu').show()
            $("[name*=tenaga_tertentu]").selectpicker('refresh');
        } else {
            $('#tenaga-tertentu').hide()
            $("[name*=tenaga_tertentu]").selectpicker('val', '');
        }
    });

    $('select[name=rule_barang]').change(function () {

        if ($(this).val() == 2) {
            $('#barang-tertentu').show()
        } else {
            $('#barang-tertentu').hide()
        }
    });

    $('select[name=rule_pemasok]').change(function () {

        if ($(this).val() == 2) {
            $('#pemasok-tertentu').show()
        } else {
            $('#pemasok-tertentu').hide()
        }
    });

    $("select[name=opsi_komisi").change(function (e) {

        e.preventDefault();

        var isi = $(this).val();

        if (isi == 1) {
            var html_rule = '<input type="text" name="rule_komisi" class="form-control">';
            $(".rule_komisi").html(html_rule);
            var html_setting = '<select name="setting_komisi" class="form-control">' +
                '<option value="1">Per Faktur</option>' +
                '<option value="2">Per Kuantitas Barang</option>';
            $(".setting_komisi").html(html_setting);
        } else if (isi == 2) {
            var html_rule = '<input type="text" name="rule_komisi" class="form-control">  % dari ';
            $(".rule_komisi").html(html_rule);
            var html_setting = '<select name="setting_komisi" class="form-control">' +
                '<option value="1">Penilaian Penjualan</option>' +
                '<option value="2">Laba Kotor</option>';
            $(".setting_komisi").html(html_setting);
        } else {

            alert('invalid');
        }

    })

    $(document).off('submit', '#form_komisi').on('submit', '#form_komisi', function (e) {
        e.preventDefault();

        var formdata = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("komisi.store") }}',
            data: formdata,
            method: 'post',
            success: function (data) {
                var obj = JSON.parse(data);

                if (obj.response == 'sukses') {
                    Swal.fire({
                        title: "Data berhasil di simpan",
                        text: "test data ",
                        confirmButtonText: 'Yes',
                        icon: "success",
                        position: 'top',

                    }).then((result) => {
                        if (result.isConfirmed) {

                           
                    var pageurl = "<?= url('') ?>/" + obj.url;
                    window.location.href = pageurl;
        
                        }
                    });

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
        });


    })

</script>
