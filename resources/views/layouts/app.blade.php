@php
    $role_id = auth()->user()->role_id;
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">


    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/main.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.snow.css') }} ">
 
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <title> @yield('page-title') {{ env('APP_NAME') }}</title>
    @yield('css')
</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('layouts.dashboard-header')
        @include('layouts.sidebars.laft-sidebar')
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    @yield('main-content')
                </div>
            </div>
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="copy-right col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            {{ date('Y') }} © - All Right Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/chartist-plugin-threshold/dist/chartist-plugin-threshold.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/gaugeJS/dist/gauge.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/chart.js/dist/Chart.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/d3/dist/d3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('assets/libs/cropperjs/dist/cropper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sortablejs/Sortable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-asColor/dist/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-asGradient/dist/jquery-asGradient.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40claviska/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-rowgroup/js/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/libs/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/libs/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.7a.dela') }}">
    </script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jvectormap-next/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ika.jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('assets/libs/cd-jvectormap/world-mill.js') }}"></script>
    <script src="{{ asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script> --}}



    <!-- Theme JS -->
    {{-- <script src="{{ asset('assets/js/theme.min.js') }}"></script> --}}
    @yield('javascript')
</body>

</html>
