<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FaturaControllerAPI extends Controller
{

    protected $fieldInvoiceNo = "LEFT(ccoNumero, 2)+ ' '+SUBSTRING(ccoNumero,3,7)+LTRIM(RTRIM(STR(CAST(RIGHT(ccoNumero,6) as int),10,0)))";
    protected $fieldInvoiceNORC = "LEFT(SAFTInvoiceNo, 2)+ ' '+SUBSTRING(SAFTInvoiceNo,3,7)+LTRIM(RTRIM(STR(CAST(RIGHT(SAFTInvoiceNo,6) as int),10,0)))";

    public static function listarFaturaAPI()
    {

        $tipoFactura = "'GF'";
        $fatura = DB::connection('sqlsrv2')->select('SELECT TOP(100) F.ccoNumero as ccoNumero, F.cleCodigo as cleCodigo, C.cleNomeCliente as nomeCliente, C.cleTelefone as cleTelefone, F.ccoDataEmissao as  ccoDataEmissao
        FROM            Fatura.tbeCabecalho AS F INNER JOIN
        Fatura.tbeDetalhe AS F1 ON F.ccoNumero = F1.ccoNumero INNER JOIN
        Cliente.tbeCliente AS C ON F.cleCodigo = C.cleCodigo
        COLLATE Modern_Spanish_CI_AI WHERE LEFT( F.ccoNumero, 2 ) = ' . $tipoFactura . ' order by ccoNumero DESC');

        return $fatura;
    }

    public static function getDadosFacturaAPI($codigoFactura)
    {

        $codigoFactura = "'$codigoFactura'";
        $fatura = DB::connection('sqlsrv2')->select('SELECT F.ccoNumero, F.SAFTInvoiceNo, F.cleCodigo, F.ccoDataEmissao, F.ccoDataRegisto, F.ccoSubTotal, F.ccoIVA, F.ccoTotal FROM  Fatura.tbeCabecalho AS F WHERE F.ccoNumero=' . $codigoFactura . '');
        //    dd($fatura);
        return $fatura;
    }

    public static function getDadosEmpresaAPI()
    {
        $empresa = DB::connection('sqlsrv2')->select('SELECT * FROM Geral.tbeEmpresa');
        return $empresa;
    }

    public static function ClienteEspecificoAPI($codigoCliente)
    {
        $codigoFactura = "'$codigoCliente'";
        $clientes = DB::connection('sqlsrv2')->select('SELECT * FROM Cliente.tbeCliente WHERE Cliente.tbeCliente.cleCodigo=' . $codigoFactura . '');
        return $clientes;
    }

    public static function getDadosIntesFacturaAPI($codigoFactura)
    {

        $codigoFactura = "'$codigoFactura'";
        $fatura = DB::connection('sqlsrv2')->select('SELECT C.ccoNome AS designacao , F1.dteMontante AS dteMontante,I.ivaPercentagem AS IVA, I.SAFTTaxExemptionCode AS SAFTTaxExemptionCode FROM Fatura.tbeDetalhe AS F1 INNER JOIN Fatura.tbeConceito C ON F1.ccoCodigo = C.ccoCodigo 
        INNER JOIN Fatura.tbeIva I ON I.ccoCodigo = C.ccoCodigo WHERE F1.ccoNumero=' . $codigoFactura . '');

        return $fatura;
    }

    public function getInformacaoFiltro($data1, $data2)
    {
      $RG = "'GF'";
      $datainicio =  "'$data1'";
      $dataFim =  "'$data2'";
      $sql = DB::connection('sqlsrv2')->select('SELECT count(*) as totalRegistos, Max(ccoDataEmissao) dataFim, Min(ccoDataEmissao) dataInicio, DATEDIFF(DAY, Min(ccoDataEmissao),Max(ccoDataEmissao)) periodo from Fatura.tbeCabecalho where ccoHash is null and LEFT(ccoNumero, 2) != ' . $RG . ' and ccoDataEmissao >= ' . $datainicio . ' and ccoDataEmissao <= ' . $dataFim . '');
      return response()->json($sql);
    }

    public function getRegistoPeriodo($dataInicio, $dataFim)
    {
        $RG = "'RG'";
        $sql = DB::connection('sqlsrv2')->select('SELECT *, ccoNumero as InvoiceNo from Fatura.tbeCabecalho where ccoHash is null and LEFT(ccoNumero, 2) != ' . $RG . '  and ccoDataEmissao >= ' . $dataInicio . ' and ccoDataEmissao <= ' . $dataFim . ' order by ccoNumero ASC');
         return $sql;
    }

    public function getListaFacturasPendentes()
    {
        $RG = "'RG'";
        $sql = DB::connection('sqlsrv2')->select('SELECT COUNT(*) as totalFacturas, LEFT(cleCodigo, 2) FROM Fatura.tbeCabecalho where ccoHash is null and LEFT(ccoNumero, 2) != ' . $RG . ' group by LEFT(cleCodigo, 2)');
        return $sql;
    }

}
