<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tbeConceito extends Model {
    protected $table = 'tbeConceito';

    protected $fillable = [ 'id', 'ccoCodigo', 'ccoOrdem', 'SAFTProductType', 'ccoNome', 'ccoDescripcao', 'ccoAtivo', 'updated_at', 'created_at' ];

    public static function getProdutoID() {
        return tbeConceito::select( '*' )->count( 'ccoCodigo' );
    }

    public static function getProdutoActivo( $data ) {
        $produtos = DB::table( 'tbeConceito' )
        ->join( 'tbeIva', 'tbeConceito.ccoCodigo', '=', 'tbeIva.ccoCodigo' )
        ->where( 'tbeIva.ivaInicio', '<=', $data )
        ->where( 'tbeIva.ivaFim', '>=', $data )
        ->select( 'tbeConceito.ccoCodigo', 'tbeConceito.ccoNome', 'tbeConceito.ccoDescripcao', 'tbeIva.ivaPercentagem', 'tbeIva.SAFTTaxExemptionCode', 'tbeIva.ivaVerba', 'tbeIva.ivaRegime' )
        ->get();
        return $produtos;
    }

    public static function getCodigoProduto( $data, $codigoProduto ) {
        $produtos = DB::table( 'tbeConceito' )
        ->join( 'tbeIva', 'tbeConceito.ccoCodigo', '=', 'tbeIva.ccoCodigo' )
        ->where( 'tbeIva.ivaInicio', '<=', $data )
        ->where( 'tbeIva.ivaFim', '>=', $data )
        ->where( 'tbeConceito.ccoCodigo', '=', $codigoProduto )
        ->select( 'tbeConceito.ccoCodigo', 'tbeConceito.ccoNome', 'tbeConceito.ccoDescripcao', 'tbeIva.ivaPercentagem', 'tbeIva.SAFTTaxExemptionCode', 'tbeIva.ivaVerba', 'tbeIva.ivaRegime' )
        ->get();
        // dd( $produtos );
        return $produtos;
    }

}
