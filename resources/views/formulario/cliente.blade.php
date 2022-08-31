@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:30%; margin-top: 50px">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div style="background:#005c3c;font-weight: bold; color:#fff;">1. Registo de Empresa</div>
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
                        <form method="post" id="validarFormularioPessoa" action="{{ url('registar') }}"
                            onsubmit="validate()">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="nomeEmpresa" class="label mr-1">Denominação Oficial</label>
                                    <b><input name="nomeEmpresa" class="form-control" size="12"
                                            style="font-weight: bold;"></b>
                                </div>
                                <div id="mostra_bi" class="col-6">
                                    <label class="label mr-1" for="nif">NIF</label>
                                    <input name="nif" id="nif" class="form-control" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Endereço</label>
                                    <input name="endereco" class="form-control" style="font-weight: bold;">
                                </div>

                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Telefone</label>
                                    <input name="telefone" id="telefone" class="form-control" style="font-weight: bold;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1">Actividade Comercial</label>
                                    <input name="actividade" class="form-control" style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label class="label mr-1" for="ano">Data da Constituição</label>
                                    <input name="ano" type="date"
                                        value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}" class="form-control"
                                        style="font-weight: bold;">
                                </div>
                                <div class="col-3">
                                    <label for="sector" class="label mr-1">Capital Social</label>
                                    <input data-mask='#.##0,00' name="capitalSocial" id="myinput" class="form-control"
                                        style="font-weight: bold;">

                                </div>
                            </div>
                            <div class="card" style="margin-top:10px">
                                <div style="background:#005c3c;font-weight: bold;color: #fff;">2. Dados do Sócios</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio1" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">NºB.I</label>
                                            <input name="nBi" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Acções</label>
                                            <input name="acoes1" class="form-control" style="font-weight: bold;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio2" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">NºB.I</label>
                                            <input name="nBi2" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Acções</label>
                                            <input name="acoes2" class="form-control" style="font-weight: bold;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mb-6" id="btnSubmeterEmissao">
                                        <i class="bi bi-check"></i>
                                        Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
<script src="https://jsuites.net/v4/jsuites.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery12.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mask.js') }}"></script>
<script>
    function validate() {
        var nif = document.getElementById('nif').value;
        var validar = /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/;
        return validar.test(nif);
    }

    $(document).ready(function() {

                $("#validarFormularioPessoa").validate({
                    rules: {
                        nif: {
                            required: true,
                            pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
                            minlength: 14,
                            maxlength: 14
                        },
                    },
                    messages: {

                        nif: {
                            required: "O número do Bilhete deve ser fornecido.",
                            pattern: "O padrão do bilhete está inválido.",
                            minlength: "O tamanho mínimo deve ser 14 dígitos",
                            maxlength: "O tamanho máximo deve ser 14 dígitos"
                        }
                    },
                    errorElement: "em",
                    errorPlacement: function(error, element) {
                        // Add the `invalid-feedback` class to the error element
                        error.addClass("invalid-feedback");
                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.next("label"));
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    }
                });
            }
</script>
