@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%;">

            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:50px;">
               
                <div style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                    <h3>Lista de Faturas</h3>
                </div>
            
                <div class="card" style=" margin-top: -8px">
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
                                    @if (!empty($factura) && $factura->count())
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
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {!! $factura->appends(Request::all())->links() !!}
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