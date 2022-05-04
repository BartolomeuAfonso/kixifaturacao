<!-- Left Sidenav -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{url('entrar')}}">
                <i class="bi bi-grid"></i>
                <span>Módulo Facturação</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ url('clientes') }}"> <i
                            class="bi bi-circle"></i>Registo de Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('lista') }}"> <i
                            class="bi bi-circle"></i>Lista de Clientes</a></li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-fat" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Facturação</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-fat" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ url('fatura') }}"> <i
                            class="bi bi-circle"></i>Inserção</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listaFactura') }}"> <i
                            class="bi bi-circle"></i>Lista</a></li>

            </ul>
        </li>
    </ul>
</aside>
<!-- end left-sidenav-->
