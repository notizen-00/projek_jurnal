<script>
    var table = $('.myTable').DataTable();
    $(document).ready(function () {
        $('.toggle-widget').click(function (e) {

            e.preventDefault();
            $('.sidebar').css('width', '230px');
            $('.sidebar-wrapper').css('width', '230px');
            $('.nav-widget p').toggleClass('d-none');
            $('.main-panel').css('width', 'calc(100% - 230px)');
            $(".sidebar .nav i").css('line-height', '30px');
            console.log('oiasnd');
        }, function () {
            $('.sidebar').css('width', '70px');
            $('.sidebar-wrapper').css('width', '70px');
            $('.main-panel').css('width', 'calc(100% - 70px)');
            $('.nav-widget p').toggleClass('d-none');
            $(".sidebar .nav i").css('line-height', '50px');
        });

        $(".element").click(function (e) {
            e.preventDefault();

            $(".dropdown-widget").toggleClass('d-none');

        })

        $(document).on('click', 'a.nav-widget', function (e) {
            e.preventDefault();

            var pageURL = $(this).attr('href');
            pageURL += '?_=' + new Date().getTime();

            $.ajax({
                url: pageURL,
                dataType: "html",
                beforeSend: function () {
                    console.log('masih loading');
                    
                    $(".selectpicker").selectpicker('destroy');
                    table.destroy();
                    $(".content").html('');

                },
                success: function (data) {

                    // $('.content').html(data);
                        $('.content').load(pageURL, function () {
                            // success load code

                            $('.myTable').DataTable({
                                // datatable options
                            });

                            $(".selectpicker").selectpicker();

                            $(".dt-buttons button").css('background-color',
                                'gray');
                            $(".dt-buttons").css('margin-left', '10px');
                            $(".dt-buttons span:first-child ").html(
                                '<span class="fas fa-cog"></span>');
                        
                        });
                        
                        $.ajax({
                                dataType: 'html',
                                url: "<?= route('widget.content') ?>",
                                success: function (data) {
                                    $(".widget-top").html(data);
                                }
                            });
                  

                },
                complete: function (event, xhr, settings) {

                }
            });



        });
        
        $("a.nav-widget").off('click');

        $(document).on('click', '.close-widget', function (e) {
            e.preventDefault();
            event.stopPropagation();
            var id = $(this).attr('data-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'post',
                data: {
                    id: id
                },
                url: "<?= route('widget.update') ?>",
                success: function (data) {


                    var pageWidget = "<?= url('widget') ?>";
                    $('.widget-top').load(pageWidget);
                   



                }

            })

        })
    });

</script>
