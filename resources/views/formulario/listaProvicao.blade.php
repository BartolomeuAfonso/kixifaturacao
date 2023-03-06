@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:50px">
        <div class="row" style="margin-left:15%;">

            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:50px;">
               
                <div style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                    <h3>Provições</h3>
                </div>
            
                <div class="card" style=" margin-top: -8px">
                    <div class="row">
                        <div class="card-body">
                            <table id="table_id" class="table datatable">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Data</th>
                                        <th >Nivel de Risco</th>
                                        <th >Carteira</th>
                                        <th >% Carteira</th>
                                        <th >Provisão</th>
                                        <th >% Provisao</th>
                                    </tr>
                                </thead>
                                <tbody>                                 
                                        @foreach ($provicao as $provicao)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $provicao->Data }}</td>
                                                <td>{{ $provicao->ProvisaoN }}</td>
                                                <td>{{ $provicao->Carteira }}</td>
                                                <td>{{ $provicao->PercCarteira }}</td>
                                                <td>{{ $provicao->Provisao }}</td>
                                                <td>{{ $provicao->PercProvisao }}</td>                                          
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
