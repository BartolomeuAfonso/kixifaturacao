@extends('layouts.app')
@section('content')

 <!-- TopBar-->
 @include('includes.topbar')

 <div style="background:#f8f9fe;">

    <!-- SIDE MENU BAR-->
    @include('includes.sidebar')
   

    <!-- Page Content-->
   
        <!-- Inicio da Content depois de logado -->

            @yield('content1')
        <!-- Fim da Content depois de logado -->

        <!-- TopBar-->

  
    <!-- end page content -->
</div>
@stop