
@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%; ">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:20px">
                <div class="card">
                   
                    <div style="background:#005c3c; color:#fff; font-weight: bold;"
                        aria-current="true" >
                       Lista de Clientes
                     </div>
                
                    <div class="row">
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loan Number</th>
                                    <th>Nome</th>
                                    <th>Contacto</th>
                                    <th>Nif</th>                                  
                                    <th>Endereço</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($listaCliente) && $listaCliente->count())
                                        @foreach($listaCliente as $cliente)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$cliente->cleCodigo}}</td>
                                            <td>{{$cliente->nomeEmpresa}}</td>
                                            <td>{{$cliente->telefone}}</td>
                                            <td>{{$cliente->nif}}</td>             
                                            <td>{{$cliente->endereco}}</td>
                                            <td><a type="button" class="btn btn-primary rounded-pill" href="{{url("editar/$cliente->nomeEmpresa")}}" ><i class="bi bi-pencil-square"></i> Editar </a></td>
                                        </tr>
                                        @endforeach
                                     @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {!! $listaCliente->appends(Request::all())->links() !!}
                        </div>
                </div>
            </div> 
        </div>
    </section>
@stop
