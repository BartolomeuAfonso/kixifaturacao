<!-- Left Sidenav -->
<aside id="sidebar" class="sidebar" style="background:#FFFFFF">

    <ul class="sidebar-nav" id="sidebar-nav" >
        <li class="nav-item" >
            <a class="nav-link " href="{{ url('home') }}">
                <i class="fa-solid fa-grip" style="color: #005c3c"></i>
                <span style="color: #000000;font-weight: bold;" >Módulo Facturação</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" style="background:#005c3c ">
                <i class="fa-regular fa-user" style="color:#F89C1C"></i><span style="color:#F89C1C; padding-left: 10px"> Clientes</span><i class="bi bi-chevron-down ms-auto" style="color:#ffff"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ url('clientes') }}"> <i
                            class="bi bi-circle"></i>Registo de Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('lista') }}"> <i class="bi bi-circle"></i>Lista
                        de Clientes</a></li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#" style="background:#005c3c ">
                <i class="fab fa-stack-overflow" style="color:#F89C1C"></i><span  style="color:#F89C1C">Produto</span><i class="bi bi-chevron-down ms-auto" style="color:#ffff"></i>
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
            <a class="nav-link collapsed" data-bs-target="#components-fat" data-bs-toggle="collapse" href="#" style="background:#005c3c ">
                <i class="fa-regular fa-file-lines" style="color:#F89C1C"></i><span  style="color:#F89C1C">Facturação</span><i class="bi bi-chevron-down ms-auto"  style="color:#ffff"></i>
            </a>
            <ul id="components-fat" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li class="nav-item"><a class="nav-link" href="{{ url('fatura') }}"> <i class="bi bi-circle"></i>Emitir
                        fatura</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('listaFactura') }}"> <i
                            class="bi bi-circle"></i>Lista de fatura Manual</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('recibo') }}"> <i class="bi bi-circle"></i>Inserir
                        Recibos Manual</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('listaFacturaAPI') }}"> <i class="bi bi-circle"></i>Lista de fatura da Consolidado
                    </a></li>

            </ul>
        </li>
    </ul>
</aside>
<!-- end left-sidenav-->
