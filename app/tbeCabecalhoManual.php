<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tbeCabecalhoManual extends Model
{

    protected $table = "tbeCabecalhoManual";

    protected $fillable = [
        'ccoNumero', 'SAFTInvoiceNo', 'eraCodigo', 'anaCodigo', 'ulrCodigo', 'cdoCodigo', 'cleCodigo', 'cleBI', 'cleBIVal', 'SAFTCustomerID', 'SAFTCustomerTaxID', 'tpoDataFim01', 'tpoDataFim02', 'ccoDataEmissao', 'ccoDataRegisto', 'ccoSubTotal',
        'ccoIVA', 'ccoTotal', 'ulrEstado', 'ccoEstado', 'ccoDataEstado', 'ccoHash', 'ccoHashControl', 'ccoHashProcessado', 'ivaRegime', 'anaProvincia', 'anaCidade', 'anaEndereco', 'ccoHashResumo', 'ccoDataAnulacao', 'ccoMotivoAnulacao', 'contador', 'nomeCliente', 'enderecoCliente'
    ];

    public static function getUltimaFactura($tipo)
    {
        $tipoFactura = "'RG'";
        $fatura = DB::select('select   "tbeCabecalhoManual"."ccoNumero" from "tbeCabecalhoManual" where LEFT("tbeCabecalhoManual"."ccoNumero",2) = ' . $tipoFactura . '  ORDER BY "tbeCabecalhoManual"."contador" DESC ');
        //  dd($fatura);
        return $fatura[0]->ccoNumero;
    }

    public static function getDadosFactura($codigoFactura)
    {
        $fatura = DB::table('tbeCabecalhoManual')
            ->join('tbeDetalheManual', 'tbeCabecalhoManual.ccoNumero', '=', 'tbeDetalheManual.ccoNumero')
            ->join('cliente_empresas', 'tbeCabecalhoManual.cleCodigo', '=', 'cliente_empresas.cleCodigo')
            ->where('tbeCabecalhoManual.ccoNumero', '=', $codigoFactura)
            ->select('tbeCabecalhoManual.ccoNumero', 'tbeCabecalhoManual.SAFTInvoiceNo', 'tbeCabecalhoManual.nomeCliente', 'tbeDetalheManual.ccoCodigo', 'tbeCabecalhoManual.cleCodigo', 'tbeCabecalhoManual.ccoDataEmissao',  'tbeCabecalhoManual.ccoDataRegisto', 'tbeCabecalhoManual.ccoSubTotal', 'tbeCabecalhoManual.ccoIVA', 'tbeCabecalhoManual.ccoTotal', 'tbeDetalheManual.designacao', 'tbeDetalheManual.quantidade', 'tbeDetalheManual.UnitPrice', 'tbeDetalheManual.dteMontante', 'tbeDetalheManual.TaxPercentage', 'tbeDetalheManual.TaxExemptionCode')
            ->get();

        return $fatura;
    }




    public function getLastFacturaHash($contador)
    {
        $fatura = DB::table('tbeCabecalho')
            ->where('LEFT(ccoNumero,2)', '=', 'GF')
            ->where('tbeCabecalho.contador', '=', $contador)
            ->select('tbeCabecalho.ccoHash')
            ->first();

        return $fatura;
    }

    public static function getLastFacturaHashNota($contador)
    {
        $fatura = DB::table('tbeCabecalho')
            ->where('LEFT(ccoNumero,2)', '=', 'NC')
            ->where('tbeCabecalho.contador', '=', $contador)
            ->select('tbeCabecalho.ccoHash')
            ->first();

        return $fatura;
    }

    public static function getBuscarFactura($data1, $data2)
    {
        $fatura = DB::table('tbeCabecalho')
            ->whereDate('created_at', '>=', $data1)
            ->whereDate('created_at', '<=', $data2)
            ->select('*')
            ->paginate(20);
        return $fatura;
    }


    public static function getUltimaRecibo()
    {
        $tipoFactura = "'RG'";

        $fatura = DB::select('select "tbeCabecalhoManual"."contador" from "tbeCabecalhoManual" where LEFT("tbeCabecalhoManual"."ccoNumero",2) = ' . $tipoFactura . '  ORDER BY "tbeCabecalhoManual"."contador" DESC ');


        if (empty($fatura[0]->contador)) {

            return 1;
        } else {

            return $fatura[0]->contador;
        }
    }
}
