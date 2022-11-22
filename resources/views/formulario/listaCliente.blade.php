@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%; ">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:20px">
                <div class="card">

                    <div style="background:#005c3c; color:#fff; font-weight: bold;" aria-current="true">
                        Lista de Clientes
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <table id="table_id" class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Loan Number</th>
                                        <th>Nome</th>
                                        <th>Contacto</th>
                                        <th>Nif</th>
                                        <th>Endereço</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($listaCliente as $cliente)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cliente->cleCodigo }}</td>
                                            <td>{{ $cliente->nomeEmpresa }}</td>
                                            <td>{{ $cliente->telefone }}</td>
                                            <td>{{ $cliente->nif }}</td>
                                            <td>{{ $cliente->endereco }}</td>
                                            <td><a type="button" class="btn btn-primary rounded-pill"
                                                    href="{{ url("editar/$cliente->nomeEmpresa") }}"><i
                                                        class="bi bi-pencil-square"></i> Editar </a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
    </section>
@stop
<script type="text/javascript" src="{{ asset('js/jquery-3.6.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table_id').DataTable({

            "language": {
                "search": "Procurar:",
           //     "bInfo": false, // Desactivar show 
                "bPaginate": true, // Desactivar pesquisa entre 1 a 10
                "sInfo":"",
                "sLengthMenu": "Mostrar _MENU_ Registo",
                "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ registos",
                "sInfoFiltered": "(filtered from _MAX_ total entries)",
                "sNext": "",
                "sPrevious": ""
            }



        });
    });
</script>
