<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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


</head>
<body class="account-body" style="background:#eaf0f7">
  
    <!-- Inicio da Content -->
        @yield('content')
    <!-- Fim da Content -->

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/chart.js/chart.min.js')}}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js')}}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js')}}"></script>                                 
    <!-- jQuery  -->
</body>
</html>
