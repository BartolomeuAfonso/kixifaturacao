@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard">
        <div class="row"style="margin-left:30%; margin-top: 100px">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div style="background:#005c3c;font-weight: bold; color:#fff;">Editar Empresa</div>
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
                        <form method="post" action="{{ url('atualizar') }}">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <label for="nomeEmpresa" class="label mr-1"><span style="color: red; font-weight: bold;">*</span> Denominação Oficial</label>
                                    <b><input name="nomeEmpresa" value="{{ $cliente->nomeEmpresa }}"
                                            class="form-control" size="12" style="font-weight: bold;">
                                        <input name="cleCodigo" value="{{ $cliente->cleCodigo }}" class="form-control"
                                            size="12" style="font-weight: bold; display: none">
                                        <input name="id" value="{{ $cliente->id }}" class="form-control" size="12"
                                            style="font-weight: bold; display: none">
                                    </b>
                                </div>
                                <div class="col-4">
                                    <label class="label mr-1" for="nif"><span style="color: red; font-weight: bold;">*</span> NIF</label>
                                    <input name="nif" class="form-control" value="{{ $cliente->nif }}"
                                        style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1"><span style="color: red; font-weight: bold;">*</span> Endereço</label>
                                    <input name="endereco" class="form-control" value="{{ $cliente->endereco }}"
                                        style="font-weight: bold;">
                                </div>

                                <div class="col-6">
                                    <label for="sector" class="label mr-1"><span style="color: red; font-weight: bold;">*</span> Telefone</label>
                                    <input name="telefone" class="form-control" value="{{ $cliente->telefone }}"
                                        style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Actividade</label>
                                    <input name="actividade" class="form-control" value="{{ $cliente->objectoSocial }}"
                                        style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label class="label mr-1" for="ano">Data da Constituição</label>
                                    <input name="ano" type="date" class="form-control"
                                        value="{{ $cliente->dataConstituicao }}" style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label for="sector" class="label mr-1">Capital Social</label>
                                    <input name="capitalSocial" class="form-control"
                                        value="{{ $cliente->capitalSocial }}" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="card">
                                <div style="background:#005c3c;font-weight: bold;color: #fff;">Dados do Sócios</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio1" class="form-control" value="{{ $cliente->socio }}"
                                                style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">NIF</label>
                                            <input name="nBi" class="form-control" value="{{ $cliente->nBi }}"
                                                style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Acções</label>
                                            <input name="acoes1" class="form-control" value="" style="font-weight: bold;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio2" class="form-control" value="{{ $cliente->socio1 }}"
                                                style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">NIF</label>
                                            <input name="nBi2" class="form-control" value="{{ $cliente->nBi2 }}"
                                                style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Acções</label>
                                            <input name="acoes2" class="form-control" value="" style="font-weight: bold;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mb-6"
                                        id="btnSubmeterEmissao" onclick="getSucesso()">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
<script>
    function getSucesso() {
        alert("Dados alterado com Sucesso");
    }
</script>
