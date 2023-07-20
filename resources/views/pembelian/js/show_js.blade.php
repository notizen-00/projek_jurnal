<script>
    $(window).ready(function () {

       
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
        var TotalValue = 0;
        var SubTotalReal = 0;

        $(".detail_pembelian tr").each(function () {
            TotalValue += parseFloat($(this).find('.subtotal_int')
                .val());
        });

        $(".subtotal").text(TotalValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
        // console.log(TotalValue);



        

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
                                    '<td>'+ formatRupiah(obj[i].debit,"Rp") +'</td>'+
                                    '<td>'+ formatRupiah(obj[i].kredit,"Rp") +'</td>'+
                                    '</tr>';
                                
                                    
                        }
                        $(".isi_jurnal_show").html(html);

                        
                        
                   
                }

            })
            

        })


    })

</script>