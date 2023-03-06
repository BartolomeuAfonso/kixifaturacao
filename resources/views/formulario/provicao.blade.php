@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:50px">
        <div class="row" style="margin-left:15%;">

            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px; margin-top:50px;">
               
                <div style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                    <h3>Detalhes da Provição</h3>
                </div>
                <form method="GET" action="{{ url('buscarProvicao') }}" target="_blank">
                    @csrf
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-6">
                                <select id="agencia" style="background:#808080; color:#fff" class="form-control select2bs4" name="agencia"
                                    style="margin-top: 2px; margin-left: -20px">
                                    <option value=""  style="color:#fff"  disabled selected>{{ $oficina[0]->OfNombre }}</option>
                                    @foreach ($oficina as $oficinas)
                                        <option value="{{ $oficinas->OfCodigo }}"  >
                                            {{ $oficinas->OfNombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div  class="col-4">  
                                <input id="data" name="data" type="date"
                                    value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}" class="form-control">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary mb-6"  id="btnProvicao"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
               
            </div>
            
            </div>
        </div>
    </section>
@stop
