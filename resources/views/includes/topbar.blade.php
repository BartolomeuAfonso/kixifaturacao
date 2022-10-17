
<!-- Top Bar Start -->
<div class="topbar" style="background:#005c3c">
    <header id="header" class="header fixed-top d-flex align-items-center" style="background:#005c3c ">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('home')}}" class="logo d-flex align-items-center">
                <img src="{{ asset('img/KP2.png') }}" width="120" class="img img-fluid">
                <span class="d-none d-lg-block">
                    
                </span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn" style="color:aliceblue
            "></i>
        </div><!-- End Logo -->

        <div class="search-bar" >
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">

                        <!--ltrim eliminar primeiro caracter-->
                        <!--ltrim eliminar primeiro e ultimo caracter substr(ltrim(Session::get('user')->UtCodigo,Session::get('user')->UtCodigo[0]),0,-1)-->
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white">{{Session::get('user')->Nombre01}}</span>
                    </a>
                     <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('sair') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sair</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</div>
