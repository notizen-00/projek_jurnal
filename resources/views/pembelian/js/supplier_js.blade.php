<script>
    $(document).on('change','[name=supplier]',function(e){

        e.preventDefault();
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?= url('kontak/info') ?>/" + id,
            method: 'get',
            success: function (data) {
                var obj = JSON.parse(data);
                // console.log(obj);
                $("[name=alamat]").val(obj.alamat);
                $("[name=email]").val(obj.email);

            }

        })
    })
</script>