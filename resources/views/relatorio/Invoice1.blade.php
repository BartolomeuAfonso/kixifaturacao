<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="{{ asset('css/facturaStyle.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/common/bootstrap-4.4.0/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body style="font-family: sans-serif">

    <div class="row pb-1">
        <div class="col-7 mr-auto">
            <img src="{{ asset('img/KIXICREDITO.png') }}" class="img-thumbnail border-0" width="205" />
            <table class="table table-sm table-borderless m-0">
                <tr class="m-0 p-0">
                    <th class=" m-0 p-0 pb-1">{{ $dadosFactura[0]->eraNome }}</th>
                </tr>
                <tr class="m-0 p-0">
                    <td class="small m-0 p-0">{{ $dadosFactura[0]->eraSitioWeb }} |
                        {{ $dadosFactura[0]->eraEmailComercial }}
                    </td>
                </tr>
                <tr class="m-0 p-0">
                    <th class="small m-0 p-0">Tel.:{{ $dadosFactura[0]->eraTelefone }}</th>
                </tr>
            </table>
        </div>
        <div class="col-5 ml-auto text-right">
            <h6 class="font-weight-bolder">Factura {{ $factura[0]->ccoNumero }} </h6>
            <p>{{ $versao }}</p>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col-5 ml-auto small">
            Exmo.(a) Sr.(a)
            <div>{{ $cliente[0]->cleNomeCliente }}</div>
            <div>Endereço:{{ $cliente[0]->cleEndereco }}</div>
            <div>
                NIF: </div>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col-12">
            <table class="table table-sm small">
                <tr class="p-0 m-0">
                    <th class="p-0 m-0">Data de Emissão</th>
                    <th class="p-0 m-0">Data Vencimento</th>
                    <th class="p-0 m-0">Referente</th>
                    <th class="p-0 m-0">Cod. Entidade</th>
                    <th class="p-0 m-0">Moeda</th>       
                </tr>
                <tr class="p-0 m-0">
                    <td class="p-0 m-0">{{ date('Y-m-d', strtotime($factura[0]->ccoDataEmissao)) }}</td>
                    <td class="p-0 m-0">
                        {{ date('Y-m-d', strtotime('+30 days', strtotime($factura[0]->ccoDataEmissao))) }}</td>
                    <td class="p-0 m-0"></td>
                    <td class="p-0 m-0">{{ $factura[0]->cleCodigo }}</td>
                    <td class="p-0 m-0">AKZ</td> 
                </tr>
            </table>
        </div>
    </div>


    <div class="row mb-4" style="font-size: x-small">
        <div class="col-12">
            <table class="table table-sm small">
                <thead>
                    <tr class="m-0 p-0">
                        <th class="text-left m-0 p-0">Descricao</th>
                        <th class="text-center m-0 p-0">Qtd.</th>
                        <th class="text-center m-0 p-0">Un.</th>
                        <th class="m-0 p-0 text-center">Pr. Unitário</th>
                        <th class="m-0 p-0 text-center">Taxa %</th>
                        <th class="m-0 p-0 text-center">Código</th>
                        <th class="m-0 p-0 text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factura_item as $fatura_itens)
                        <tr>
                            <td>{{ $fatura_itens->designacao }}</td>
                            <td class="m-0 p-0 text-center">1</td>
                            <td class="m-0 p-0 text-center">un</td>
                            <td class="m-0 p-0 text-center">
                                {{ number_format($fatura_itens->dteMontante, 2, '.', ' ') }}</td>
                            <td class="m-0 p-0 text-center">{{ $fatura_itens->IVA }}</td>
                            <td class="m-0 p-0 text-center">Codigo</td>
                            <td class="m-0 p-0 text-center">
                                {{ number_format($fatura_itens->dteMontante , 2, '.', ' ') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr class="border border-success">
    <div class="row pl-1 pr-1" style="font-size: xx-small; margin-top: 55px">
        <div class="col-7 mr-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th colspan="4">Quadro Resumo Impostos</th>
                    </tr>
                    <tr class="m-0 p-0 small">
                        <th>Taxa (Imposto)</th>
                        <th>Incid./Qtd</th>
                        <th>Valor</th>
                        <th>Motivo Isenção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="m-0 p-0 text-center">
                            @if ($fatura_itens->IVA == 14)
                                (IVA)
                            @else
                                0
                            @endif
                        </td>
                        <td>{{ number_format($factura[0]->ccoTotal - $factura[0]->ccoIVA, 2, '.', ' ') }}</td>
                        <td>
                            {{ number_format($factura[0]->ccoIVA, 2, '.', ' ') }}</td>
                        <td style="margin-left: -5px">
                            {{ $fatura_itens->SAFTTaxExemptionCode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-8 ml-auto" style="margin-top:10px; margin-right:-50px;">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">AKZ</th>
                    </tr>
            </thead>
            <tbody>
                <tr class="smal m-0 p-0">
                    <td>Total líquido</td>
                    <td>
                        {{ number_format($factura[0]->ccoTotal - $factura[0]->ccoIVA, 2, '.', ' ') }}
                    </td>
                </tr>
                <tr class="smal m-0 p-0">
                    <td>Total Imposto</td>
                    <td>
                        {{ number_format($factura[0]->ccoIVA, 2, '.', ' ') }}
                    </td>

                </tr>
                <tr class="m-0 p-0">
                    <th>TOTAL A PAGAR</th>
                    <td>
                        {{ number_format($factura[0]->ccoTotal, 2, '.', ' ') }}
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <footer class="fixed-bottom p-2 small" style="height: 85px">
        <div>
            <span class="text-size-8 ml-4">mme8-Processado por programa validado n.° 301/AGT/2021 © Kixipedidos 6.1 |
                Os bens - serviços foram colocados à disposição do adquirente na data e local do documento</span>
        </div>
        <hr class="border border-success">
        <div style="font-size: xx-small">
            <div>{{ $dadosFactura[0]->eraEDORua }}</div>
            <div>{{ $dadosFactura[0]->eraCidade }} - {{ $dadosFactura[0]->eraPais }}</div>
            <div>Contribuinte Nº.: <span class="font-weight-bolder">{{ $dadosFactura[0]->eraNroContribuinte }}</span>
            </div>
        </div>
        <div class="text-right" style="font-size: xx-small">Pág 1 de 1</div>
    </footer>
</body>

</html>
