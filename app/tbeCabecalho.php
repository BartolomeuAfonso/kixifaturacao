<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tbeCabecalho extends Model
{

    protected $table = "tbeCabecalho";

    protected $fillable = [
        'ccoNumero', 'SAFTInvoiceNo', 'eraCodigo', 'anaCodigo', 'ulrCodigo', 'cdoCodigo', 'cleCodigo', 'cleBI', 'cleBIVal', 'SAFTCustomerID', 'SAFTCustomerTaxID', 'tpoDataFim01', 'tpoDataFim02', 'ccoDataEmissao', 'ccoDataRegisto', 'ccoSubTotal',
        'ccoIVA', 'ccoTotal', 'ulrEstado', 'ccoEstado', 'ccoDataEstado', 'ccoHash', 'ccoHashControl', 'ccoHashProcessado', 'ivaRegime', 'anaProvincia', 'anaCidade', 'anaEndereco', 'ccoHashResumo', 'ccoDataAnulacao', 'ccoMotivoAnulacao', 'contador', 'nomeCliente', 'enderecoCliente'
    ];

    public static function getUltimaFactura()
    {
        return tbeCabecalho::select('*')->latest('contador')->first();
    }

    public static function getDadosFactura($codigoFactura)
    {
        $fatura = DB::table('tbeCabecalho')
            ->join('tbeDetalhe', 'tbeCabecalho.ccoNumero', '=', 'tbeDetalhe.ccoNumero')
            ->join('cliente_empresas', 'tbeCabecalho.cleCodigo', '=', 'cliente_empresas.cleCodigo')
            ->join('tbeConceito', 'tbeDetalhe.ccoCodigo', '=', 'tbeConceito.ccoCodigo')
            ->where('tbeCabecalho.ccoNumero', '=', $codigoFactura)
            ->select('tbeCabecalho.ccoNumero', 'tbeCabecalho.nomeCliente', 'tbeCabecalho.cleCodigo', 'tbeCabecalho.ccoDataEmissao',  'tbeCabecalho.ccoDataRegisto', 'tbeCabecalho.ccoSubTotal', 'tbeCabecalho.ccoIVA', 'tbeCabecalho.ccoTotal', 'tbeDetalhe.designacao', 'tbeDetalhe.quantidade', 'tbeDetalhe.UnitPrice', 'tbeDetalhe.dteMontante', 'tbeDetalhe.TaxPercentage', 'tbeDetalhe.TaxExemptionCode')
            ->get();

        return $fatura;
    }
}
