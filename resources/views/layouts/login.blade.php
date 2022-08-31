<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet"/>
    <link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}"
          rel="stylesheet"/>
    <!-- CSS Files -->
    <link href="{{asset('css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet"/>
    <link href="{{asset('css/estilo-kixicredito.css')}}" rel="stylesheet">
</head>

<body class="bg-kixicredito-green-light">
<div class="main-content">
    <div class="header bg-kixicredito-green-dark py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">Bem-vindo!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-kixicredito-orange" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('img/KP2.png') }}" width="120" class="img img-fluid">
                        </div>
                        <div class="text-center text-muted mt-4 mb-2">
                            <small>Credencias do Utilizador</small>
                        </div>
                        <form role="form"  action='{{url("entrar") }}'  method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="conta utilizador" required name="username" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" required type="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-kixicredito-orange my-4">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="py-5">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6 mx-auto">
                    <div class="copyright text-center text-xl-left text-darker">
                        &copy; 2019 - KixiCrédito - Todos os Direitos Reservados</a>
                    </div>
                    <small class="text-light text-center">Template design &copy; 2018 <a href="https://www.creative-tim.com" class="text-light ml-1" target="_blank">Creative Tim </a></small>
                </div>
            </div>
        </div>
    </footer>
</div>
<!--   Core   -->
<script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!--   Argon JS   -->
<script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script>
    window.TrackJS &&
    TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
    });
</script>
</body>

</html>