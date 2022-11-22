
<!-- Top Bar Start -->
<div class="topbar" style="background:#005c3c">
    <header id="header" class="header fixed-top d-flex align-items-center" style="background:#005c3c ">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('home')}}" class="logo d-flex align-items-center">
                <!--img src="" width="80" class="img img-fluid"-->
                <span class="d-none d-lg-block" style="color:aliceblue">
                    Kixi Faturação
                </span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn" style="color:aliceblue
            "></i>
        </div><!-- End Logo -->

        
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                        <img    
                        style="border:solid #6c757d 1px"                       
                        src="img/users/{{Session::get('user')->UtCodigo}}<?php echo '.jpg'?>"
                        alt="user-image"
                        class="rounded-circle"
                        width="45px"
                        height="50px"/>
                
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
