<script>
    $(document).on('click', '.gudang_modal', function (e) {

        e.preventDefault();

        $("#create_gudang").modal('show');

    })
    $(".table-product").DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'colvis',
            text : '<i class="colvis" style="font-size:10px">Show / Hide</i>',
           
        }],
        columnDefs: [
            {
                targets: 1,
                visible: false
            }
        ],
     
    });


    $(document).off('submit', '#form_gudang').on('submit', '#form_gudang', function (e) {
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("gudang.store") }}',
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

                            $('a[href="#menu1"]').tab('show');
                            $("#create_gudang").modal('hide');


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

</script>
