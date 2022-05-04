
@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard">
        <div class="row" style="margin-left:15%;">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:20px">
                <div class="card">
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                          Lista de Cliente
                        </button>                
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
                                    @foreach($listaCliente as $cliente)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$cliente->cleCodigo}}</td>
                                        <td>{{$cliente->nomeEmpresa}}</td>
                                        <td>{{$cliente->telefone}}</td>
                                        <td>{{$cliente->nif}}</td>             
                                        <td>{{$cliente->endereco}}</td>
                                        <td><a type="button" class="btn btn-primary rounded-pill" href="{{url("editar/$cliente->nomeEmpresa")}}" >Editar</a></td>
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
