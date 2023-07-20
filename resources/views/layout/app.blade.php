<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fastderm | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
   
    
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link href="{{ asset('paper') }}/css/bootstrap-select.css" rel="stylesheet" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.js"></script> --}}
    <style>
        .search-input {
            background-image: 'https://www.pngfind.com/pngs/m/54-545482_vector-search-icon-search-icon-vector-png-transparent.png';
            background-position: right 10px center;
            background-repeat: no-repeat;
            padding-right: 30px; /* Menambahkan padding di sisi kanan untuk membuat ruang bagi ikon */
        }
    </style>
    <style>
.tippy-tooltip {
    background-color: #000;
    color: #fff;
    padding: 8px;
    border-radius: 4px;
  }
        .nav-link.disabled{

            color:white;
            display:none;
        }
      .loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: black; /* Opacity 0.5 untuk latar belakang gelap */
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.loading-content {
  text-align: center;
  color: #fff;
  top:-100px;
}

.fa-spinner {
  font-size: 40px;
  margin-bottom: 10px;
}
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="loading-overlay">
            <div class="loading-content">
              <center><i class="fa fa-spinner fa-spin"></i></center>
              <br>
             <span>Segera Ter load ...</span>
            </div>
          </div>


        <!-- Preloader -->

        @auth()
            @include('layout.page_templates.content')

        @endauth




        <!-- jQuery UI 1.11.4 -->

        <script src="{{ asset('adminlte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)

        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('adminlte') }}/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{ asset('adminlte') }}/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="{{ asset('adminlte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('adminlte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('adminlte') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script
            src="{{ asset('adminlte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script
            src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
        </script>
        <script
            src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/jszip/jszip.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.html5.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.print.min.js">
        </script>
        <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.colVis.min.js">
        </script>
        <!-- Summernote -->
        <script src="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
        <script
            src="{{ asset('adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
        </script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte') }}/dist/js/adminlte.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="{{ asset('adminlte') }}/dist/js/demo.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('adminlte') }}/dist/js/pages/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        {{-- @vite('resources/js/app.js') --}}

        <script>
            $(".selectpicker").selectpicker();


            function rupiah(amount) {
                // Mengubah angka menjadi format mata uang Rupiah
                var formattedAmount = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(parseFloat(amount));

                // Mengganti tanda pemisah ribuan dari koma (,) menjadi titik (.)
                // formattedAmount = formattedAmount.replace(/,/g, '.');

                return formattedAmount;
            }

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

            function get_diff(jumlahHari) {
                // Fungsi ini akan mengembalikan tanggal setelah jumlahHari hari
                // dari hari saat ini
                let tanggal = new Date();
                tanggal.setDate(tanggal.getDate() + jumlahHari);

                let tahun = tanggal.getFullYear();
                let bulan = ('0' + (tanggal.getMonth() + 1)).slice(-2);
                let tanggalAngka = ('0' + tanggal.getDate()).slice(-2);

                return `${tahun}-${bulan}-${tanggalAngka}`;


            }

            $('.nav-link.disabled').click(function(e) {
            e.preventDefault();
            return false;
         });

            $(window).on('load', function () {
                $('.loading-overlay').fadeOut();

            });

            function setIframeHeight(frame) {
                frame.style.height = frame.contentWindow.document.body.scrollHeight + 'px';
            }

            $('.btnBack').click(function () {
                window.history.back();
            });
            if (window.location.pathname !== '/home') {
  // Redirect ke '/home'
               console.log('anda tidak berada di home');
               console.log(window.location.href);
            }else{
                console.log("Anda berada di halaman 'home'.");
            }
        </script>
        @stack('custom-scripts')

</body>

</html>
