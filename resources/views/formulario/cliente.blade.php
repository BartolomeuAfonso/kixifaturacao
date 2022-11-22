@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:30%; margin-top: 50px">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div style="background:#005c3c;font-weight: bold; color:#fff;">Registro de Cliente</div>
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
                            <div style="height:40px;background:#f11414"
                                class="alert icon-custom-alert  alert-outline-warning b-round fade show" role="alert">
                                <div style="color:#000" class="alert-text">
                                    {{ session('error') }}
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="mdi mdi-close text-red"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method="post" id="validarFormularioPessoa" action="{{ url('registar') }}">
                            @csrf
                            <div class="row">
                                <label for="nomeEmpresa" class="label mr-1"><span
                                        style="color: red; font-weight: bold;"></span> Tipo de Identidade</label>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Singular" name="tipoPessoa"
                                            id="tipoPessoa" checked onclick="mudaestado(1)">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Singular

                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"  value="Juridica"  name="tipoPessoa"
                                            id="tipoPessoa" onclick="mudaestado(2)">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Jurídica

                                        </label>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <label for="nacionadade" class="label mr-1" style="margin-left: -20px"><span
                                                style="color: red; font-weight: bold;"></span>  Nacionalidade(País)</label>
                                        <select id="nacionadade" class="form-control select2bs4" name="nacionadade"
                                            style="margin-top: 2px; margin-left: -20px">
                                            <option value="" disabled selected>Nada Selecionado...</option>
                                            @foreach ($pais as $paises)
                                                <option value="{{ $paises->ppsSimbolo2 }}">
                                                    {{ $paises->ppsPOR }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="nomeEmpresa" class="label mr-1"><span
                                            style="color: red; font-weight: bold;">*</span> Denominação Oficial</label>
                                    <b><input name="nomeEmpresa" class="form-control" size="12"
                                            style="font-weight: bold;"></b>
                                </div>
                                <div id="mostra_bi" class="col-6">
                                    <label class="label mr-1" for="nif"><span style="color: red"; font-weight:
                                            bold;>*</span> NIF</label>
                                    <input name="nif" id="nif" class="form-control" style="font-weight: bold;"
                                        maxlength="14" onclick="validaBI(document.getElementById('nif'))">
                                    <label id="info-alert-2" style="color:red;font-size:14px;display:none">NIF inválido: valor introduzido não é correto.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="sector" class="label mr-1"><span
                                            style="color: red; font-weight: bold;">*</span> Endereço</label>
                                    <input name="endereco" class="form-control" style="font-weight: bold;">
                                </div>

                                <div class="col-6">
                                    <label for="sector" class="label mr-1"><span
                                            style="color: red; font-weight: bold;">*</span> Telefone</label>
                                    <input name="telefone" id="telefone" class="form-control"
                                        style="font-weight: bold;">
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
                            <div class="card" style="margin-top:10px;display:none" id="dadosSocios">
                                <div style="background:#005c3c;font-weight: bold;color: #fff;">Dados dos Sócios</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">Nome</label>
                                            <input name="socio1" class="form-control" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <label for="sector" class="label mr-1">NIF</label>
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
                                            <label for="sector" class="label mr-1">NIF</label>
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
                            <div>
                                <span style="color: red">* Todos os campos são obrigatório.</span>
                            </div>
                            <br>
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

    var validar = /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/;
    var numero = /^[0-9]{10}$/;

    function mudaestado(estado) {
        if (estado == 1) {
            document.getElementById("dadosSocios").style.display = 'none';
            return true;
        } else {
            document.getElementById("dadosSocios").style.display = 'block';
            return false;
        }
    }

    function validaBI(bilhete) {
     var n = validar.exec(bilhete.value);
     var nacionalidade =  document.getElementById("nome").value;
  
     var tipoIdentidade =  document.querySelector('input[name="tipoPessoa"]:checked').value;

     if(tipoIdentidade=='Singular' && nacionalidade=='AO' ){
        if(!n){
            window.alert("O número de idenficação fiscal encontra-se errado!");
        }else{
            document.getElementById('nif').style.Color='green';
        }
     }
     
     if(tipoIdentidade=='Juridica' && nacionalidade=='AO' ){
      console.log(tipoIdentidade);
        var  n = numero.exec(bilhete.value);
        if(!n){
            window.alert("O número de idenficação fiscal encontra-se errado!");
        }else{
            document.getElementById('nif').style.Color='green';
          // alert("Obrigado, o seu número de idenficação está correcto");
        }
     } 
     if(tipoIdentidade=='Singular' || tipoIdentidade=='Juridica' && nacionalidade!='AO'){


     }

    }

   

</script>
