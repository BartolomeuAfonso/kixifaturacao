<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Config\database;

class tbeCabecalho extends Model
{

    protected $table = 'tbeCabecalho';

    protected $fillable = [
        'ccoNumero', 'SAFTInvoiceNo', 'eraCodigo', 'anaCodigo', 'ulrCodigo', 'cdoCodigo', 'cleCodigo', 'cleBI', 'cleBIVal', 'SAFTCustomerID', 'SAFTCustomerTaxID', 'tpoDataFim01', 'tpoDataFim02', 'ccoDataEmissao', 'ccoDataRegisto', 'ccoSubTotal',
        'ccoIVA', 'ccoTotal', 'ulrEstado', 'ccoEstado', 'ccoDataEstado', 'ccoHash', 'ccoHashControl', 'ccoHashProcessado', 'ivaRegime', 'anaProvincia', 'anaCidade', 'anaEndereco', 'ccoHashResumo', 'ccoDataAnulacao', 'ccoMotivoAnulacao', 'contador', 'nomeCliente', 'enderecoCliente'
    ];

    public static function getUltimaFactura($tipo)
    {
        $tipoFactura = "'$tipo'";
        $fatura = DB::select('select   "tbeCabecalho"."ccoNumero" from "tbeCabecalho" where LEFT("tbeCabecalho"."ccoNumero",2) = ' . $tipoFactura . '  ORDER BY "tbeCabecalho"."contador" DESC ');
        //  dd( $fatura );
        return $fatura[0]->ccoNumero;
    }

    public static function getDadosFactura($codigoFactura)
    {
        $fatura = DB::table('tbeCabecalho')
            ->join('tbeDetalhe', 'tbeCabecalho.ccoNumero', '=', 'tbeDetalhe.ccoNumero')
            ->join('cliente_empresas', 'tbeCabecalho.cleCodigo', '=', 'cliente_empresas.cleCodigo')
            ->join('tbeConceito', 'tbeDetalhe.ccoCodigo', '=', 'tbeConceito.ccoCodigo')
            ->where('tbeCabecalho.ccoNumero', '=', $codigoFactura)
            ->select('tbeCabecalho.ccoNumero', 'tbeCabecalho.SAFTInvoiceNo', 'tbeCabecalho.nomeCliente', 'tbeDetalhe.ccoCodigo', 'tbeCabecalho.cleCodigo', 'tbeCabecalho.ccoDataEmissao',  'tbeCabecalho.ccoDataRegisto', 'tbeCabecalho.ccoSubTotal', 'tbeCabecalho.ccoIVA', 'tbeCabecalho.ccoTotal', 'tbeDetalhe.designacao', 'tbeDetalhe.quantidade', 'tbeDetalhe.UnitPrice', 'tbeDetalhe.dteMontante', 'tbeDetalhe.TaxPercentage', 'tbeDetalhe.TaxExemptionCode')
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

    public static function getUltima($tipo)
    {
        $tipoFactura = "'$tipo'";

        $fatura = DB::select('select "tbeCabecalho"."contador" from "tbeCabecalho" where LEFT("tbeCabecalho"."ccoNumero",2) = ' . $tipoFactura . '  ORDER BY "tbeCabecalho"."contador" DESC ');

        if (empty($fatura[0]->contador)) {

            return 0;
        } else {

            return $fatura[0]->contador;
        }
    }

    /////////-Para API -----------------------------------
  /*
    public static function listarFaturaAPI()
    {

        $tipoFactura = "'GF'";
        $fatura = DB::connection('sqlsrv')->select('SELECT TOP( 200 ) F.ccoNumero as ccoNumero, F.cleCodigo as cleCodigo, C.cleNomeCliente as cleNomeCliente, C.cleTelefone as cleTelefone, F.ccoDataEmissao as  ccoDataEmissao
        FROM            Fatura.tbeCabecalho AS F INNER JOIN
        Fatura.tbeDetalhe AS F1 ON F.ccoNumero = F1.ccoNumero INNER JOIN
        Cliente.tbeCliente AS C ON F.cleCodigo = C.cleCodigo
        COLLATE Modern_Spanish_CI_AI WHERE LEFT( F.ccoNumero, 2 ) = ' . $tipoFactura . ' order by ccoNumero DESC');

        return $fatura;
    }

    public static function getDadosFacturaAPI($codigoFactura)
    {
        $fatura = DB::connection('sqlsrv')->select('SELECT F.ccoNumero, F.SAFTInvoiceNo,C.cleNomeCliente AS cleNomeCliente, F1.ccoCodigo, F.cleCodigo, F.ccoDataEmissao, F.ccoDataRegisto, F.ccoSubTotal, F.ccoIVA, F.ccoTotal, S.ccoDescripcao AS Designacao, F1.dteMontante, F1.dteIva AS dteMontante, F1.ivaRegime,I.SAFTTaxExemptionCode AS TaxExemptionCode, I.ivaPercentagem AS TaxPercentage, 
        1 AS quantidade FROM            Fatura.tbeCabecalho AS F INNER JOIN
        Fatura.tbeDetalhe AS F1 ON F.ccoNumero = F1.ccoNumero INNER JOIN
        Fatura.tbeConceito AS S ON S.ccoCodigo = F1.ccoCodigo INNER JOIN
        Fatura.tbeIva AS I ON S.ccoCodigo = I.ccoCodigo INNER JOIN
        Cliente.tbeCliente AS C ON F.cleCodigo = C.cleCodigo COLLATE Modern_Spanish_CI_AI WHERE F.ccoNumero=' . $codigoFactura . '');
        return $fatura;
    }

    public static function getDadosEmpresaAPI()
    {
        $empresa = DB::connection('sqlsrv')->select('SELECT * FROM Geral.tbeEmpresa');
        return $empresa;
    }

    public static function ClienteEspecificoAPI($codigoCliente)
    {
        $clientes = DB::connection('sqlsrv')->select('SELECT * FROM Cliente.tbeCliente WHERE Cliente.tbeCliente.cleCodigo='.$codigoCliente.'');
        return $clientes;
    }*/
}
