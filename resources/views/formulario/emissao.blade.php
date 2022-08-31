@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%; margin-top: 50px">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px">
                <div class="card">
                    <div class="row">
                        <div class="card-body">
                            <table class="table table-striped" id="disponiveis">
                                <thead>
                                    <tr>
                                        <th>Código Produto</th>
                                        <th>Designacao</th>
                                        <th>Quant</th>
                                        <th>Preco</th>
                                        <th>IVA.</th>
                                        <th>Total</th>
                                        <th>Operação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($factura as $fatura_itens)
                                        <tr style="background-color: #aff7ff;">
                                            <td  style="" id="codigoProduto" value="{{ $fatura_itens->ccoCodigo }}">
                                                {{ $fatura_itens->ccoCodigo }}
                                            </td>
                                            <td id="designacao">{{ $fatura_itens->designacao }}</td>
                                            <td id="quantidade" class="m-0 p-0 text-center">
                                                {{ $fatura_itens->quantidade }}</td>

                                            <td id="preco" class="m-0 p-0 text-center">
                                                {{ number_format($fatura_itens->dteMontante, 2, '.', ' ') }}
                                            </td>
                                            <td id="taxa" class="m-0 p-0 text-center">
                                                {{ $fatura_itens->TaxPercentage }}</td>

                                            <td class="m-0 p-0 text-center">
                                                {{ number_format($fatura_itens->dteMontante * $fatura_itens->quantidade, 2, '.', ' ') }}
                                            </td>
                                            <td class="m-0 p-0 text-center">
                                                <input type="checkbox" id="" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row no-print">
                                <div class="col-6">
                                    <button class="btn btn-primary" id="adicionar"><i class="bi bi-arrow-down-square"></i>
                                        Adicionar </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form method="post" name="form" action="{{ url('salvarFatura') }}" target="_blank">
                                @csrf

                                <h5 class="card-title" style="font-weight: bold;">Seleccione o tipo de Documento que
                                    deseja Emitir</h5>
                                <div class="col-12" style="margin-bottom: 20px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="NC" name="tipoFatura"
                                            id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Nota de Crédito - NC

                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="ND" type="radio" name="tipoFatura"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Nota de Débito - ND
                                        </label>

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="RC" type="radio" name="tipoFatura"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Recibos - RC
                                        </label>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Informação Sobre a Factura</th>
                                            <td>

                                                <input type="text" class="form-control" autocomplete="off"
                                                id="nFactura" name="nFactura" value="{{ $factura[0]->ccoNumero }}" >
                                            </td>
                                            <td>

                                                <input type="text" class="form-control" autocomplete="off" name="nome"
                                                id="nome"  value="{{ $cliente->nomeEmpresa }}" >
                                            </td>
                                            <td>

                                                <input type="text" class="form-control" autocomplete="off"
                                                id="codigoCliente" name="codigoCliente" value="{{ $factura[0]->cleCodigo }}"
                                                   >
                                            </td>
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
                                                <th>Total</th>
                                                <th>Operação</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Total Iliquido:</th>
                                                    <td><input style="border-width:0px;border:none;" value="0.0" readonly
                                                            type="text" id="nextTotal" name="nextTotal" />
                                                    </td>
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
                                <div class="col-6">
                                    <button class="btn btn-primary" id="salvar"><i class="bi bi-check"></i>Salvar</button>
                                </div>
                            </form>
                       </div>
                </div>
            </div>
        </div>
        <style>
            #disponiveis thead th {
                font-weight: bold;
                background-color: black;
                color: white;

                padding: 5px 10px;
            }

            #disponiveis tr td {
                padding: 5px 10px;
                text-align: center;

                cursor: pointer;
                /**importante para não mostrar cursor de texto**/
            }

            #disponiveis tr td:last-child {
                text-align: right;
            }

            /**Cores**/
            #disponiveis tr:nth-child(odd) {
                background-color: #eee;
            }

            /**Cor quando passar por cima**/
            #disponiveis tr:hover td {
                background-color: #feffb7;
            }

            /**Cor quando selecionado**/
            #disponiveis tr.selecionado td {
                background-color: #aff7ff;
            }
        </style>
        <script>
            var tabela = document.getElementById("disponiveis");
            var linhas = tabela.getElementsByTagName("tr");
            var list = [];

            for (var i = 0; i < linhas.length; i++) {
                var linha = linhas[i];
                linha.addEventListener("click", function() {
                    //Adicionar ao atual
                    selLinha(this, false); //Selecione apenas um
                    //selLinha(this, true); //Selecione quantos quiser
                });
            }

            /**
            Caso passe true, você pode selecionar multiplas linhas.
            Caso passe false, você só pode selecionar uma linha por vez.
            **/
            function selLinha(linha, multiplos) {
                if (!multiplos) {
                    var linhas = linha.parentElement.getElementsByTagName("tr");
                    for (var i = 0; i < linhas.length; i++) {
                        var linha_ = linhas[i];
                        linha_.classList.remove("selecionado");
                    }
                }
                linha.classList.toggle("selecionado");
            }

            /**
            Exemplo de como capturar os dados
            **/
            var btnVisualizar = document.getElementById("adicionar");
            var dados = "";
            var codigo;
            var desconto = 0;

            btnVisualizar.addEventListener("click", function() {
                var selecionados = tabela.getElementsByClassName("selecionado");
                //Verificar se eestá selecionado
                if (selecionados.length < 1) {
                    alert("Selecione pelo menos uma linha");
                    return false;
                }


                for (var i = 0; i < selecionados.length; i++) {
                    var selecionado = selecionados[i];
                    selecionado = selecionado.getElementsByTagName("td");
                    dados = "" + selecionado[0].innerHTML + " - " + selecionado[1].innerHTML + " - " + selecionado[2]
                        .innerHTML + " - " + selecionado[3].innerHTML + " - " + selecionado[4].innerHTML;
                    var nameList = dados.split(/\s*-\s*/);
                    alert(nameList[0]);

                    var id = nameList[0].replace(/\s/g, '');
                    var preco = prompt("Digite o preço:");

                    var ivavalor = nameList[4];
                    var totalIva = 0;
                    var iva = 0;
                    var quantidade = nameList[2];
                    if (preco != null && preco > 0 && dados != "") {
                        if (ivavalor == 14) {
                            iva = 14;
                            var totalIva = iva / 100;
                            var preco = preco;
                            var desconto = 0;
                            var total = (preco * quantidade) + totalIva * (preco * quantidade);

                        }
                        if (ivavalor == 0) {
                            iva = 0;
                            var totalIva = iva;
                            var preco = preco;
                            var desconto = 0;
                            var total = (preco * quantidade) + totalIva * (preco * quantidade);

                        }
                        list.unshift({
                            "id_servico": id,
                            "descricao": nameList[1],
                            "quantidade": nameList[2],
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
            });

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
                    '<thead id="""><tr><td>Código Produto</td><td>Designação</td><td>Quantidade</td><td>Preço</td><td>IVA</td><td>Desc.</td><td>Total</td><td></td></tr></thead><tbody>';
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

            function formatarPreco(value) {
                var str = parseFloat(value).toFixed(2) + "";
                str = str.replace(".", ",");
                str = "" + str;
                return str;
            }
        </script>
    </section>
@stop
