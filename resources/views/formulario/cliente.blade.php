@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard">
        <div class="row" style="margin-left:30%">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card" style="box-sizing: border-box;">
                            <div class="list-group-item list-group-item-action active"  style="font-weight: bold; color: write">1. Registo de Empresa</div>
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
                        <form method="post" action="{{ url('registar') }}">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <label for="nomeEmpresa" class="label mr-1">Denomina????o Oficial</label>
                                    <b><input name="nomeEmpresa" class="form-control" size="12"
                                            style="font-weight: bold;"></b>
                                </div>
                                <div class="col-4">
                                    <label class="label mr-1" for="nif">NIF</label>
                                    <input name="nif" class="form-control" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Endere??o</label>
                                    <input name="endereco" class="form-control" style="font-weight: bold;">
                                </div>

                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Telefone</label>
                                    <input name="telefone" class="form-control" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Actividade</label>
                                    <input name="actividade" class="form-control" style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label class="label mr-1" for="ano">Data da Constitui????o</label>
                                    <input name="ano" type="date" class="form-control" style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label for="sector" class="label mr-1">Capital Social</label>
                                    <input name="capitalSocial" class="form-control" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="card">
                                <div class="list-group-item list-group-item-action active"  style="font-weight: bold; color: write" >2. Dados do S??cios</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio1" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">N??B.I</label>
                                            <input name="nBi" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Ac????es</label>
                                            <input name="acoes1" class="form-control" style="font-weight: bold;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio2" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">N??B.I</label>
                                            <input name="nBi2" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Ac????es</label>
                                            <input name="acoes2" class="form-control" style="font-weight: bold;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mb-6"
                                        id="btnSubmeterEmissao" onclick="getSucesso()">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
