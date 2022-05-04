
@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard">
        <div class="row" style="margin-left:15%;">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px">
                <div class="card">
                    <div class="row">
                        <div class="card-body">
                            <table id="#" class="table datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nº Factura</th>
                                    <th>Loan Number</th>
                                    <th>Nome</th>                               
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($factura as $faturas)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$faturas->ccoNumero}}</td>
                                        <td>{{$faturas->cleCodigo}}</td>
                                        <td>{{$faturas->nomeCliente}}</td>       
                                        <td>{{$faturas->ccoDataEmissao}}</td>
                                        <td><a type="button" class="btn btn-primary rounded-pill"
                                            style="margin-right: 5px"
                                            href="{{ url("impressao/$faturas->ccoNumero/2") }}"
                                            target="_blank">Imprimir</a></td>
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
