@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%;">

            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:50px;">
               
                <div style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                    <h3>Lista de Produtos</h3>
                </div>
            
                <div class="card" style=" margin-top: -8px">
                    <div class="row">
                        <div class="card-body">
                            <table id="#" class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Designacao</th>
                                   
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($listaProduto) && $listaProduto->count())
                                        @foreach ($listaProduto as $listaProdutos)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $listaProdutos->ccoCodigo }}</td>
                                           
                                                <td>{{ $listaProdutos->ccoNome }}</td>
                                                <td>
                                                    @if($listaProdutos->ccoAtivo==true)
                                                        <a type="button"  class="btn btn-primary" style="margin-right: 5px">
                                                            <i class="bi bi-check"></i> 
                                                      </a>
                                                    @else
                                                        <a type="button"  class="btn btn-dark"
                                                        style="margin-right: 5px"><i class="bi bi-x"></i>
                                                        </a>                    
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
                            {!! $listaProduto->appends(Request::all())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
    </section>
@stop
