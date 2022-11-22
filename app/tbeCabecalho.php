<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Config\database;

class tbeCabecalho extends Model {

    protected $table = 'tbeCabecalho';

    protected $fillable = [
        'ccoNumero', 'SAFTInvoiceNo', 'eraCodigo', 'anaCodigo', 'ulrCodigo', 'cdoCodigo', 'cleCodigo', 'cleBI', 'cleBIVal', 'SAFTCustomerID', 'SAFTCustomerTaxID', 'tpoDataFim01', 'tpoDataFim02', 'ccoDataEmissao', 'ccoDataRegisto', 'ccoSubTotal',
        'ccoIVA', 'ccoTotal', 'ulrEstado', 'ccoEstado', 'ccoDataEstado', 'ccoHash', 'ccoHashControl', 'ccoHashProcessado', 'ivaRegime', 'anaProvincia', 'anaCidade', 'anaEndereco', 'ccoHashResumo', 'ccoDataAnulacao', 'ccoMotivoAnulacao', 'contador', 'nomeCliente', 'enderecoCliente'
    ];

    public static function getUltimaFactura( $tipo ) {
        $tipoFactura = "'$tipo'";
        $fatura = DB::select( 'select   "tbeCabecalho"."ccoNumero" from "tbeCabecalho" where LEFT("tbeCabecalho"."ccoNumero",2) = ' . $tipoFactura . '  ORDER BY "tbeCabecalho"."contador" DESC ' );
        //  dd( $fatura );
        return $fatura[ 0 ]->ccoNumero;
    }

    public static function getDadosFactura( $codigoFactura ) {
        $fatura = DB::table( 'tbeCabecalho' )
        ->join( 'tbeDetalhe', 'tbeCabecalho.ccoNumero', '=', 'tbeDetalhe.ccoNumero' )
        ->join( 'cliente_empresas', 'tbeCabecalho.cleCodigo', '=', 'cliente_empresas.cleCodigo' )
        ->join( 'tbeConceito', 'tbeDetalhe.ccoCodigo', '=', 'tbeConceito.ccoCodigo' )
        ->where( 'tbeCabecalho.ccoNumero', '=', $codigoFactura )
        ->select( 'tbeCabecalho.ccoNumero', 'tbeCabecalho.SAFTInvoiceNo', 'tbeCabecalho.nomeCliente', 'tbeDetalhe.ccoCodigo', 'tbeCabecalho.cleCodigo', 'tbeCabecalho.ccoDataEmissao',  'tbeCabecalho.ccoDataRegisto', 'tbeCabecalho.ccoSubTotal', 'tbeCabecalho.ccoIVA', 'tbeCabecalho.ccoTotal', 'tbeDetalhe.designacao', 'tbeDetalhe.quantidade', 'tbeDetalhe.UnitPrice', 'tbeDetalhe.dteMontante', 'tbeDetalhe.TaxPercentage', 'tbeDetalhe.TaxExemptionCode' )
        ->get();

        return $fatura;
    }

    public function getLastFacturaHash( $contador ) {
        $fatura = DB::table( 'tbeCabecalho' )
        ->where( 'LEFT(ccoNumero,2)', '=', 'GF' )
        ->where( 'tbeCabecalho.contador', '=', $contador )
        ->select( 'tbeCabecalho.ccoHash' )
        ->first();

        return $fatura;
    }

    public static function getLastFacturaHashNota( $contador ) {
        $fatura = DB::table( 'tbeCabecalho' )
        ->where( 'LEFT(ccoNumero,2)', '=', 'NC' )
        ->where( 'tbeCabecalho.contador', '=', $contador )
        ->select( 'tbeCabecalho.ccoHash' )
        ->first();

        return $fatura;
    }

    public static function getBuscarFactura( $data1, $data2 ) {
        $fatura = DB::table( 'tbeCabecalho' )
        ->whereDate( 'created_at', '>=', $data1 )
        ->whereDate( 'created_at', '<=', $data2 )
        ->select( '*' )
        ->paginate( 20 );
        return $fatura;
    }

    public static function getUltima( $tipo ) {
        $tipoFactura = "'$tipo'";

        $fatura = DB::select( 'select "tbeCabecalho"."contador" from "tbeCabecalho" where LEFT("tbeCabecalho"."ccoNumero",2) = '.$tipoFactura.'  ORDER BY "tbeCabecalho"."contador" DESC ' );

        if ( empty( $fatura[ 0 ]->contador ) ) {

            return 0;

        } else {

            return $fatura[ 0 ]->contador;
        }
    }

    public static function listarProduto() {
        DB::disableQueryLog();
        $produto = DB::connection( 'sqlsrv' )->table( 'tbeConceito' )->limit( 5 )->get();
        return $produto;
    }

}
