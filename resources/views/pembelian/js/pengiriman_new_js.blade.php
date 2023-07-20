<script>
$(window).ready(function(){

    $("#form_pengiriman").off('submit').on('submit',function(e){

        e.preventDefault();
        var formdata = $(this).serialize();
        // console.log(formdata);
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        $.ajax({
            url:"<?= secure_url('pembelian_pengiriman')  ?>",
            method:'post',
            data:formdata,
            dataType:'json',
            success:function(data){

                if(data.status == 200){

                    Swal.fire({
                    title: "Sukses",
                    text: data.message,
                    icon: "success",
                    position: 'top',
                    didOpen: () => {

                        $('#nav-tab a[href="#pengiriman"]').tab('show');

                    },
                });


                }else if(data.status == 201){
                    Swal.fire({
                    title: "Error",
                    text: data.message,
                    icon: "error",
                    position: 'top',
                    didOpen: () => {

                        $('#nav-tab a[href="#pengiriman"]').tab('show');

                    },
                });

                }
                

            }

        })
    })

})

</script>