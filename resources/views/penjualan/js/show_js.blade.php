<script>

     $(window).ready(function () {
                  
                    var TotalValue = 0;

                    $(".detail_penjualan tr").each(function () {
                        TotalValue += parseFloat($(this).find('.subtotal_int')
                            .val());
                    });

                    $(".subtotal").text(rupiah(TotalValue));
                    // console.log(TotalValue);

                })
        $(document).on('click','.jurnal_show',function (e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            
            $("#modal_jurnal").modal('show');

            $("#table-jurnal_show").DataTable();

            $.ajax({

                url:"{{ url('jurnal/show') }}/"+id,
                method:'GET',
                success:function(data){
                        var obj = JSON.parse(data);
                       
                        console.log(obj);
                        var html = '';

                        for(var i = 0; i < obj.length; i++){
                           
                            html += '<tr>'+
                                    '<td>'+ obj[i].akun_transaksi +'</td>'+
                                    '<td>'+ obj[i].nama_akun +'</td>'+
                                    '<td>'+ rupiah(obj[i].debit) +'</td>'+
                                    '<td>'+ rupiah(obj[i].kredit) +'</td>'+
                                    '</tr>';
                                
                                    
                        }
                        $(".isi_jurnal_show").html(html);

                        
                        
                   
                }

            })
            

        })
    </script>