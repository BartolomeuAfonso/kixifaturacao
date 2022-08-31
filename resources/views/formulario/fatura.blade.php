@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%; margin-top: 50px">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px">
                <div class="card">
                    <div class="card"  style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                        <div ><h2>Emissão de Factura</h2></div>
                    </div>
                    <div class="row">
                        <form method="post" name="form" action="{{ url('salvarFatura') }}" target="_blank">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <h5 class="card-title" style="font-weight: bold;">Seleccione o tipo de Fatura que
                                        deseja Emitir</h5>
                                    <div class="col-12" style="margin-bottom: 20px">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="GF" name="tipoFatura"
                                                id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Fatura Generica - GF

                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="FP" type="radio" name="tipoFatura"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Fatura Proforma - FP

                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <table class="table table-striped" id="dadosCliente">
                                            <tr>
                                                <th>Pesquisar nome</th>
                                                <td>

                                                    <input type="text" class="form-control" autocomplete="off"
                                                        name="texto" onkeyup="trocaOpcao(this.value, document.form.nome);">
                                                </td>
                                                <td>
                                                    <select id="nome" class="form-control select2bs4" name="codigoCliente">
                                                        <option value="" disabled selected>Nada Selecionado...</option>
                                                        @foreach ($cliente as $clientes)
                                                            <option value="{{ $clientes->cleCodigo }}">
                                                                {{ $clientes->nomeEmpresa }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Produtos/Serviços</th>
                                                <td>
                                                    <select class="form-control" id="produto" name="produto">
                                                        <option value="" disabled selected>Nada Selecionado...</option-->
                                                            @foreach ($produto as $produtos)
                                                        <option id="idProduto"
                                                            value="{{ $produtos->ccoCodigo }}-{{ $produtos->ccoNome }}-{{ $produtos->ivaRegime }}">
                                                            {{ $produtos->ccoNome }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <input class="form-control" id="quantidade" value="1">
                                                </td>
                                                <td class="col-4" style="text-align: left">
                                                    <button type="button" class="btn btn-primary btn-sm float-left"
                                                        style="margin-left:100px" onClick="getPreco();"><i
                                                            class="bi bi-arrow-down-square"></i> Adicionar</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-12 table-responsive" style="margin-top: 25px;">
                                        <table class="table table-striped" id="tabelaPedido">
                                            <thead>
                                                <tr>
                                                    <th>Código Produto</th>
                                                    <th>Designacao</th>
                                                    <th>Quant</th>
                                                    <th>Preco</th>
                                                    <th>IVA.</th>
                                                    <th>Desc.</th>
                                                    <th>Total</th>
                                                    <th>Operação</th>
                                                </tr>
                                            </thead>
                                            <tbody id="products" name="list">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Total Iliquido:</th>
                                                    <td><input style="border-width:0px;border:none;" value="0.0" readonly
                                                            type="text" id="nextTotal" name="nextTotal" /></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Desconto: </th>
                                                    <td><input style="border-width:0px;border:none;" value="0.0" readonly
                                                            type="text" id="descontoFactura" name="descontoFactura" /></td>
                                                </tr>
                                                <tr>
                                                    <th>Total IVA:</th>
                                                    <td><input style="border-width:0px;border:none;" value="0.0" readonly
                                                            type="text" id="descontoIva" name="descontoIva" /></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Liquido:</th>
                                                    <td><input style="border-width:0px;border:none;" value="0.0" readonly
                                                            type="text" id="grossTotal" name="grossTotal" /></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="row no-print">
                                    <div class="col-6">
                                        <button class="btn btn-primary"><i class="bi bi-check"></i>Salvar</button>
                                    </div>
                                </div>
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
    var list = [];

    function getTotal(list) {
        var total = 0;
        let num = 0;
        for (var key in list) {
            total += list[key].preco * list[key].quantidade;

        }

        num = total;
        let n = num.toFixed(2);
        document.getElementById("nextTotal").value = n;
    }

    function getTotalIva(list) {
        var total = 0;
        let num = 0;

        for (var key in list) {
            total += (list[key].preco * list[key].quantidade * list[key].iva);

        }
        num = total;
        let n = num.toFixed(2);
        document.getElementById("descontoIva").value = n;
    }

    function getTotalGeral(list) {
        var total = 0;
        let num = 0;
        for (var key in list) {
            total += (list[key].preco * list[key].quantidade) + (list[key].preco * list[key].quantidade * list[key]
                .iva);

        }
        num = total;
        let n = num.toFixed(2);
        document.getElementById("grossTotal").value = n;
    }

    function setList(list) {

        console.log(list);
        var table =
            '<thead id=""class="table table-striped"><tr><td>Código Produto</td><td>Designação</td><td>Quantidade</td><td>Preço</td><td>IVA</td><td>Desc.</td><td>Total</td><td></td></tr></thead><tbody>';
        for (var key in list) {
            table += '<tr><td><input style="border-width:0px;border:none;" readonly type="text" value="' + list[key]
                .id_servico +
                '" name="codigo[]"></td><td><input style="border-width:0px;border:none;" readonly type="text" value="' +
                list[key].descricao +
                '" name="descricao[]"></td><td><input style="border-width:0px;border:none;" readonly type="text" value="' +
                list[key].quantidade +
                '" name="quantidade[]"></td><td><input style="border-width:0px;border:none;" readonly type="text" value="' +
                list[key].preco +
                '" name="preco[]"></td><td><input style="border-width:0px;border:none;" readonly type="text" value="' +
                list[key].iva +
                '" name="iva[]"></td><td><input style="border-width:0px;border:none;"  readonly type="text" value="' +
                list[key].desc + '" name="desc[]"></td><td>' + formatarPreco(list[key].total) +
                '</td><td><button class="btn btn-danger" style="width:90px; heigth:" onclick="removerLinha(' + key +
                ');">Remover</button></td></tr>';
        }
        table += '</tbody>';
        document.getElementById('tabelaPedido').innerHTML = table;
        getTotal(list);
        getTotalIva(list);
        getTotalGeral(list);

    }

    function limparLista() {
        if (confirm("Deseja limpar a lista?")) {
            list = [];
            setList(list);
        }
    }

    function removerLinha(id) {
        if (confirm("Pretende remover este item?")) {
            if (id === list.length - 1) {
                list.pop();
            } else if (id === 0) {
                list.shift();
            } else {
                var arrAuxIni = list.slice(0, id);
                var arrAuxEnd = list.slice(id + 1);
                list = arrAuxIni.concat(arrAuxEnd);
            }
            setList(list);
        }
    }

    function formatarPreco(value) {
        var str = parseFloat(value).toFixed(2) + "";
        str = str.replace(".", ",");
        str = "" + str;
        return str;
    }

    function getPreco() {
        var preco = prompt("Digite o preço:");

        var names = document.getElementById('produto').value;
        var quantidade = document.getElementById("quantidade").value;
        if (preco != null && preco > 0 && names != "") {
            var names = document.getElementById('produto').value;
            var nameList = names.split(/\s*-\s*/);
            var codigo = nameList[0];
            var descricao = nameList[1];
            var ivavalor = nameList[2];
            var totalIva = 0;
            var iva = 0;
            alert(ivavalor);
            if (ivavalor == 1) {
                iva = 14;
                var totalIva = iva / 100;
                var preco = preco;
                var desconto = 0;
                var total = (preco * quantidade) + totalIva * (preco * quantidade);

            }
            if (ivavalor == 0) {
                iva = 0;
                var totalIva = iva;
                // var quantidade = document.getElementById("quantidade").value;
                var preco = preco;
                var desconto = 0;
                var total = (preco * quantidade) + totalIva * (preco * quantidade);

            }

            // formatarPreco(iva); // * preco * quantidade);

            list.unshift({
                "id_servico": codigo,
                "descricao": descricao,
                "quantidade": quantidade,
                "preco": preco,
                "iva": totalIva,
                "desc": desconto,
                "total": total
            });
            setList(list);
        } else {
            return alert("Não é permitido valor null ou inferior que 0");
        }
    }

    function trocaOpcao(valor, objSel) {
        for (i = 0; i < objSel.length; i++) {
            qtd = valor.length;
            if (objSel.options[i].text.substring(0, qtd).toUpperCase() == valor.toUpperCase()) {
                objSel.selectedIndex = i;
                break;
            }
        }
    }
</script>
