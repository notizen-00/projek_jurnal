<script>
    $(document).ready(function () {


        var supplierSelector = $("[name=supplier]");
        var supplier = $("[name=supplier").val();

        var searchTransaksi = $("#search_transaksi");
        var notif_s = $(".notif_supplier");
        $("[name=supplier]").on('change', function () {
            supplier = $(".filter-option-inner-inner").text();
            var isi = $(this).val();
            if (supplier == '') {
                searchTransaksi.selectpicker('disable');
                searchTransaksi.selectpicker('refresh');
                alert('Isikan dulu data supplier');
            } else {
              
                searchTransaksi.prop('disabled', false);
                searchTransaksi.selectpicker('refresh');
                notif_s.html('<span class="badge badge-success">'+supplier+'</span>');
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"<?= url('ajax/data_transaksi') ?>",
                    data:{id_supplier:isi},
                    method:"post",
                    success:function(data){
                        
                        searchTransaksi.empty();
                        searchTransaksi.selectpicker('refresh');
                        if(data.length > 0){
                        $.each(data, function (index, item) {
                        searchTransaksi.append($('<option>').attr('data-width','75%').attr('data-content',item.no_transaksi+' <br><span class="badge badge-info">'+item.no_referensi+'</span>').val(item.no_transaksi));
                         });
                        }else{
                            searchTransaksi.empty();
                            searchTransaksi.selectpicker('render');
                           alert('transaksi pada supplier :'+supplier+' Tidak ada ');
                            $("[name=supplier]").selectpicker('val','');

                        }
                        // <option data-tokens="{{ $i->no_referensi }}" value="{{ $i->id }}" data-content="<b>{{ $i->no_transaksi }}</b>   <br><span class='badge badge-info'>{{ $i->no_referensi }}</span>">                       
                        // </option>

                        searchTransaksi.selectpicker('refresh');
                    }

                })
            }
        });

        searchTransaksi.on('change', function (e) {
            e.preventDefault();
            var isi = $(this).val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?= url('ajax/get/data_transaksi') ?>",
                    method: 'POST',
                    data: {
                        no_transaksi: isi
                    },
                    success: function (data) {



                        if (data[0].sisa_tagihan == 0) {

                            Swal.fire({
                                title: "danger",
                                text: 'No transaksi ini telah lunas',
                                icon: "error",
                                position: 'top',

                            });
                            searchTransaksi.selectpicker('val','');

                        } else {

                            var obj = data;
                            var html = '';
                            var msg = '';

                            if (obj[0].data.pesan == null) {
                                msg = "-";
                            } else {
                                msg = obj[0].data.pesan;
                            }
                            html += '<tr>' +
                                '<td><input type="hidden" name="no_transaksi_pembelian[]" value="' +
                                obj[0].data.no_transaksi + '"> ' + obj[0].data
                                .no_transaksi + '</td>' +
                                '<td>' + msg + '</td>' +
                                '<td>' + obj[0].data.detail_pembelian.tgl_jatuh_tempo +
                                '</td>' +
                                '<td>' + formatRupiah(obj[0].data.total, "Rp") +
                                '</td>' +
                                '<td>' + obj[0].sisa_tagihan + '</td>' +
                                '<td><input type="text" class="form-control form-control-sm jumlah_pembayaran" value="' +
                                obj[0].sisa_tagihan +
                                '" name="jumlah_pembayaran[]"/></td>' +
                                '<td><i style="cursor:pointer" class="fas fa-trash text-danger hapus_row"></i></td>' +
                                '</tr>';

                            $(".isi_payment").append(html);

                            searchTransaksi.selectpicker('val','');

                            var TotalValue = 0;
                            $(".isi_payment tr").each(function () {
                                TotalValue += parseFloat($(this).find(
                                        '.jumlah_pembayaran')
                                    .val());


                            });

                            $("[name=total]").val(TotalValue);
                            $(".total_view").text(formatRupiah(TotalValue, "Rp"));
                            $(".hapus_row").click(function (e) {
                                e.preventDefault();

                                var whichtr = $(this).closest("tr");

                                whichtr.remove();
                                $('[name*=jumlah_pembayaran]').trigger('change');


                            })

                        }


                    }
                });
            

        })
        // $('[name=supplier]').trigger('change');
        // searchTransaksi.autocomplete({
        //     source: function (request, response) {
        //         $.ajax({
        //             url: "{{ url('ajax/data_transaksi') }}",
        //             dataType: "json",
        //             data: {
        //                 term: request.term,
        //                 supplier: supplier,
        //             },
        //             success: function (data) {

        //                 if (supplier == '') {
        //                     alert('isikann dulu data supplier');
        //                     searchTransaksi.val('');
        //                 } else {
        //                     response(data);
        //                 }

        //             }
        //         });
        //     },
        //     minLength: 2,
        //     select: function (event, ui) {

        //         var no_transaksi = ui.item.label;

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $.ajax({
                //     url: "<?= url('ajax/get/data_transaksi') ?>",
                //     method: 'POST',
                //     data: {
                //         no_transaksi: no_transaksi
                //     },
                //     success: function (data) {



                //         if (data[0].sisa_tagihan == 0) {

                //             Swal.fire({
                //                 title: "danger",
                //                 text: 'No transaksi ini telah lunas',
                //                 icon: "error",
                //                 position: 'top',

                //             });
                //             searchTransaksi.val('');

                //         } else {

                //             var obj = data;
                //             var html = '';
                //             var msg = '';

                //             if (obj[0].data.pesan == null) {
                //                 msg = "-";
                //             } else {
                //                 msg = obj[0].data.pesan;
                //             }
                //             html += '<tr>' +
                //                 '<td><input type="hidden" name="no_transaksi_pembelian[]" value="' +
                //                 obj[0].data.no_transaksi + '"> ' + obj[0].data
                //                 .no_transaksi + '</td>' +
                //                 '<td>' + msg + '</td>' +
                //                 '<td>' + obj[0].data.detail_pembelian.tgl_jatuh_tempo +
                //                 '</td>' +
                //                 '<td>' + formatRupiah(obj[0].data.total, "Rp") +
                //                 '</td>' +
                //                 '<td>' + obj[0].sisa_tagihan + '</td>' +
                //                 '<td><input type="text" class="form-control form-control-sm jumlah_pembayaran" value="' +
                //                 obj[0].sisa_tagihan +
                //                 '" name="jumlah_pembayaran[]"/></td>' +
                //                 '<td><i style="cursor:pointer" class="fas fa-trash text-danger hapus_row"></i></td>' +
                //                 '</tr>';

                //             $(".isi_payment").append(html);

                //             searchTransaksi.val('');

                //             var TotalValue = 0;
                //             $(".isi_payment tr").each(function () {
                //                 TotalValue += parseFloat($(this).find(
                //                         '.jumlah_pembayaran')
                //                     .val());


                //             });

                //             $("[name=total]").val(TotalValue);
                //             $(".total_view").text(formatRupiah(TotalValue, "Rp"));
                //             $(".hapus_row").click(function (e) {
                //                 e.preventDefault();

                //                 var whichtr = $(this).closest("tr");

                //                 whichtr.remove();
                //                 $('[name*=jumlah_pembayaran]').trigger('change');

                //             })

                //         }


                //     }
                // });
        //     }, //HERE - make sure to add the comma after your select
        //     response: function (event, ui) {

        //         if (!ui.content.length) {
        //             var noResult = {
        //                 value: "",
        //                 label: "No results found"
        //             };
        //             ui.content.push(noResult);
        //         }
        //     }
        // }).data("ui-autocomplete")._renderItem = function (ul, item) {

        //     return $("<li>")
        //         .append("<div>" + item.value + " -- (" + item.label + ")</div>")
        //         .appendTo(ul);
        // };


        $(document).on('change', '[name*=jumlah_pembayaran]', function (e) {

            var jumlah = $(this).closest('tr').find('.jumlah_pembayaran').val();
            var TotalValue = 0;

            $(".isi_payment tr").each(function () {
                TotalValue += parseFloat($(this).find(
                        '.jumlah_pembayaran')
                    .val());


            });

            $("[name=total]").val(TotalValue);
            $(".total_view").text(formatRupiah(TotalValue, 'Rp'));

        })

        $(document).off('submit', '#form_payment').on('submit', '#form_payment', function (e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?= route('pembayaran.store') ?>",
                method: "POST",
                data: formdata,
                success: function (response) {
                    var obj = JSON.parse(response);
                    var pageurl = "<?= url('') ?>/" + obj.url;
                    window.location.href = pageurl;
                }


            })

        })




    });

</script>
