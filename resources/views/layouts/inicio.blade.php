@extends('layouts.app')
@section('content')

 <!-- TopBar-->
 @include('includes.topbar')

<div class="page-wrapper">
    <!-- SIDE MENU BAR-->
    @include('includes.sidebar')

    <!-- Page Content-->
    <@class(['p-4', 'font-bold' => true]) class="page-content">
        <!-- Inicio da Content depois de logado -->
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
            @yield('content1')
        <!-- Fim da Content depois de logado -->

        <!-- TopBar-->
        @include('includes.footer')
    </div>
    <!-- end page content -->
</div>
@stop