@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:30%; margin-top: 50px">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div style="background:#005c3c;font-weight: bold; color:#fff;">Produtos/Serviços</div>
                        </div>
                        @if ($errors->all())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        @if (session('sucesso'))
                            <div style="height:40px;background:#bdf7c9"
                                class="alert icon-custom-alert  alert-outline-success b-round fade show" role="alert">
                                <div style="color:#000" class="alert-text">
                                    {{ session('sucesso') }}
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div style="height:40px;background:#ffb459"
                                class="alert icon-custom-alert  alert-outline-warning b-round fade show" role="alert">
                                <div style="color:#000" class="alert-text">
                                    {{ session('error') }}
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method="post" id="validarFormularioPessoa" action="{{ url('registarProduto') }}"
                            onsubmit="validate()">
                            @csrf
                            <div class="row">
                                <div class="col-2">
                                    <label for="codigo" class="label mr-1"><span
                                            style="color: red; font-weight: bold;">*</span> Código</label>
                                    <b><input name="codigo" id="codigo"class="form-control" size="12" style="font-weight: bold;"
                                            maxlength="4"></b>
                                </div>
                                <div id="mostra_bi" class="col-">
                                    <label class="label mr-1" for="nif"><span style="color: red"; font-weight:
                                            bold;>*</span> Designação</label>
                                    <input name="designacao" id="designacao" class="form-control"
                                        style="font-weight: bold;">
                                </div>
                            </div>
                            <br>
                            <div class="card" style="margin-top:10px">

                                <div style="background:#005c3c;font-weight: bold;color: #fff;">Configuração do Produto
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="sector" class="label mr-1"> IVA?</label>
                                        <select class="form-control" id="iva" name="iva">
                                            <option value="SIM">SIM</option>
                                            <option value="NÃO">NÃO</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="sector" class="label mr-1">Data Iníco</label>
                                        <input name="data_inicio" id="data_inicio"  type="date"
                                            value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}" class="form-control"
                                            style="font-weight: bold;">
                                    </div>
                                    <div class="col-4">
                                        <label for="sector" class="label mr-1">Data Fim</label>
                                        <input name="data_final"  id="data_final" type="date"
                                            value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}" class="form-control"
                                            style="font-weight: bold;">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 5px">
                                <span style="color: red">* Todos os campos são obrigatório.</span>
                            </div>
                            <br>
                            <div class="row" style="margin-left: 5px">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mb-6" id="btnSubmeterEmissao">
                                        <i class="bi bi-check"></i>
                                        Salvar</button>
                                </div>
                            </div>
                            <br>
                      </form>
                 </div>
            </div>
        </div>
    </div>
</section>
@stop
