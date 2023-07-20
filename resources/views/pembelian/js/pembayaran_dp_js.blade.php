<script>

$(function() {
      
        $(document).on('change','[name=jumlah_deposit]',function(e){
            e.preventDefault();

            var isi = $(this).val();

            $(".total_view").text(formatRupiah(isi,'Rp'));

        })

        $(document).off('submit','#form_deposit').on('submit','#form_deposit',function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url:"<?= secure_url('pembelian/pemesanan/dp') ?>",
                method:"post",
                data:formData,
                dataType:'json',
                success:function(data){

                    if(data.status == 200)
                    {
                        Swal.fire({
                    title: "Sukses",
                    text: data.message,
                    icon: "success",
                    position: 'top',
                    didOpen: () => {

                        var pageurl = "<?= url('pembelian_pemesanan') ?>/"+data.id_pemesanan;
                        window.location.href = pageurl;
                    }
                })

                    }else if(data.status == 201){

                        Swal.fire({
                    title: "Error",
                    text: data.message,
                    icon: "error",
                    position: 'top',
                    
                })

                    }
                        

                }

            })

        })
});


</script>