<!-- Left Sidenav -->
<aside id="sidebar" class="sidebar" style="background:#f8f9fe ">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ url('home') }}">
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
                <li class="nav-item"><a class="nav-link" href="{{ url('lista') }}"> <i class="bi bi-circle"></i>Lista
                        de Clientes</a></li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Produto</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-produto">
                <li class="nav-item"><a class="nav-link" href="{{ url('produto') }}"> <i
                            class="bi bi-circle"></i>Registo de Produto</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listaProduto') }}"> <i
                            class="bi bi-circle"></i>Lista
                        de Produtos</a></li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-fat" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Facturação</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-fat" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li class="nav-item"><a class="nav-link" href="{{ url('fatura') }}"> <i class="bi bi-circle"></i>Emitir
                        fatura</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listaFactura') }}"> <i
                            class="bi bi-circle"></i>Lista de fatura Manual</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('recibo') }}"> <i class="bi bi-circle"></i>Inserir
                        Recibos Manual</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('listaFacturaAPI') }}"> <i class="bi bi-circle"></i>Lista de fatura
                    </a></li>

            </ul>
        </li>
    </ul>
</aside>
<!-- end left-sidenav-->
