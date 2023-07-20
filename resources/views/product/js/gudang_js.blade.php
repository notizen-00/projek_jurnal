<script>
    $(document).off('click', '.detail_gudang').on('click', '.detail_gudang', function (e) {

        e.preventDefault();

        var id = $(this).attr('data-id');
        $('#detail_gudang').modal('show');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url("gudang/detail") }}/'+id,
                dataType: 'HTML',
                method: 'get',
                success: function (data) {
                   
                    $(".tabel_detail_gudang").DataTable().destroy();
                    $(".isi_detail_gudang").html(data);
                
                    $(".tabel_detail_gudang").DataTable({
                        responsive:true
                    });   
                 }
            })


            




    })

</script>
