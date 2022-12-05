@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:50px">
        <div class="row" style="margin-left:15%;">

            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:50px;">
               
                <div style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                    <h3>Lista de Faturas</h3>
                </div>
            
                <div class="card" style=" margin-top: -8px">
                    <form method="get" action="{{ url('buscar') }}" style="margin-left:10px">
                        <div class="row">
                            <div class="col-2">
                                <input type="text" style="display: none;font-weight: bold;" value="1" name="id"
                                    class="form-control" id="id">
                                <label for="sector" class="label mr-1">Data Inicial</label>
                                <input name="dataInicio" value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}"
                                    id="dataInicio" type="date" class="form-control">
                            </div>
                            <div class="col-2">
                                <label class="label mr-1" for="ano">Data Final</label>
                                <input name="dataFim" value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}"
                                    id="dataFim" type="date" class="form-control">
                            </div>
                            <div class="col-2" style="margin-top: 27px;">
                                <button type="submit" class="btn btn-primary mb-2" id="btnSubmeterFiltro"><i class="bi bi-search"></i> Buscar</button>
                            </div>
                        </div>
                    </form-->
                    <div class="row">
                        <div class="card-body">
                            <table id="table_id" class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nº Factura</th>
                                        <th>Loan Number</th>
                                        <th>Nome</th>
                                        <th>Data</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($factura as $faturas)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $faturas->ccoNumero }}</td>
                                                <td>{{ $faturas->cleCodigo }}</td>
                                                <td>{{ $faturas->nomeCliente }}</td>
                                                <td>{{ $faturas->ccoDataEmissao }}</td>
                                                <td><a type="button" class="btn btn-primary rounded-pill"
                                                        style="margin-right: 5px"
                                                        href='{{ url('impressao/' . base64_encode($faturas->ccoNumero) . '/2') }}'
                                                        target="_blank"><i class="bi bi-printer-fill"></i> Reemprimir
                                                    </a>
                                                </td>

                                                <td>
                                                    @if(substr($faturas->ccoNumero , 0, 2) =='GF')
                                                        <a type="button" class="btn btn-danger  rounded-pill"
                                                        style="margin-right: 5px"
                                                        href='{{ url('emitir/' . base64_encode($faturas->ccoNumero)) }}'
                                                        target="_blank"><i class="bi bi-trash3-fill"></i> Notas e Débitos
                                                    </a>
                                                @else

                                                @endif          
                                                </td>
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
             //   "sInfo":"",
                "sLengthMenu": "Mostrar _MENU_ Registo",
                "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ registos",
                "sInfoFiltered": "(filtered from _MAX_ total entries)",
            }



        });
    });
</script>