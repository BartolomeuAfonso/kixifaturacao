<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class clienteEmpresa extends Model {

    protected $table = 'cliente_empresas';

    protected $fillable = [ 'id', 'cleCodigo', 'nomeEmpresa', 'nif', 'telefone', 'socio', 'socio1', 'sector', 'capitalSocial', 'objectoSocial', 'nBi', 'nBi2', 'dataConstituicao', 'endereco', 'numerador', 'updated_at', 'created_at' ];

    public static function getContador() {
        return clienteEmpresa::select( '*' )->latest( 'numerador' )->first();
    }

    public static function ClienteEspecifico( $codigoCliente ) {
        $clientes = DB::table( 'cliente_empresas' )
        ->where( 'cleCodigo', '=', $codigoCliente )
        ->first();

        return $clientes;
    }

    public static function getNome( $nome ) {
        $clientes = DB::table( 'cliente_empresas' )
        ->where( 'nomeEmpresa', '=', $nome )
        ->first();
    //    dd($clientes);
        if ($clientes == "nullo" ) {
            return "";
        } else {
            return $clientes;
        }

    }

    public static function getNIF( $nome ) {
      //  dd($nome);
        $clientes = DB::table( 'cliente_empresas' )
        ->where( 'nif', '=', $nome )
        ->select( 'nif' )->first();
       // dd($clientes);
         return $clientes;

    }

    public static function getPais() {
        $pais = DB::table( 'tClPais' ) ->select( 'tClPais.ppsPOR', 'tClPais.ppsSimbolo2' )->get();
        
        return $pais;
    }
}
