
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Extra details for Live View on GitHub Pages -->

    <title>
        Fastderm-App
    </title>
  

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet" />
 
        <link href="{{ asset('paper') }}/css/bootstrap-select.css" rel="stylesheet" />
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files -->

    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style type="text/css">
    .loader {
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>

</head>

<body class="{{ $class }}">

    @auth()
        @include('layouts.page_templates.auth')
        @include('layouts.navbars.fixed-plugin')
    @endauth

    @guest
        @include('layouts.page_templates.guest')
    @endguest

    <!--   Core JS Files   -->


    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.0/dist/js/bootstrap-select.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript">
    </script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('paper') }}/demo/demo.js"></script>


    <!-- Sharrre libray -->

    <script>
    
            // $(".selectpicker").selectpicker('render');
            $.fn.dataTable.ext.errMode = 'none';
            // $('.myTable').DataTable({
            //     dom: 'Bfrtip',
            //     extend: 'collection',
            //     className: 'custom-html-collection',
            //     buttons: [
            //         'colvis'
            //     ],
            //     "order": [
            //         [1, 'asc']
            //     ],
            //     "oLanguage": {
            //         "sEmptyTable": "<div style='height:250px;'><img class='m-auto' width='250px' src='<?= asset('paper/img/nodata.png') ?>'><br><center><b>Tidak Ada transaksi untuk saat ini</b></center></div>"
            //     }
            // });


            // $(".dt-buttons button").css('background-color', 'gray');
            // $(".dt-buttons").css('margin-left', '10px');
            // $(".dt-buttons span:first-child ").html('<span class="fas fa-cog"></span>');
       


        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".minimal_btn ").click(function (e) {
            e.preventDefault();

            $(".open").toggle(function () {
                $('.sidebar').css('width', '70px');
                $('.sidebar-wrapper').css('width', '70px');
                $('.main-panel').css('width', '96%');

            })


        })

        


       

    </script>
    

<script>
    $(document).ready(function() {
        $("[name=tindakan_product]").change(function(e){
    
            e.preventDefault();
            var isi = $(this).val();
    
            if(isi == 1){
                window.location.href = "{{ route('product.create') }}";
            }
    
        })
        
    });
    
    
    
    </script>
    @stack('scripts')

    @include('layouts.widget_js');
    @include('layouts.navbars.fixed-plugin-js')
    @include('pembelian.js.pembelian_payment_js')
    @include('pembelian.js.supplier_js')


</body>

</html>
