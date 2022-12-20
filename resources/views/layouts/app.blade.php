<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kixifaturação</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
    <!-- App css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/remixicon/remixicon.css')}} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/simple-datatables/style.css')}} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('DataTables/dataTables.css')}} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome-free-6.2.1-web/css/all.css')}} " rel="stylesheet" type="text/css" />

</head>
<body class="account-body" style="background:#f8f9fe;  background-image: url('img/logokixi.png'); background-size: 300px 100px; background-repeat: no-repeat, repeat;background-position: center; margin-top: 50%">
  
    <!-- Inicio da Content -->
        @yield('content')
    <!-- Fim da Content -->

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js')}}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js')}}"></script>       
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>                          
    <!-- jQuery  -->
</body>
</html>
