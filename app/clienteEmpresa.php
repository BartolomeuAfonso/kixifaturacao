<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class clienteEmpresa extends Model
{

    protected $table = "cliente_empresas";

    protected $fillable = ['id','cleCodigo', 'nomeEmpresa', 'nif', 'telefone', 'socio', 'socio1', 'sector', 'capitalSocial', 'objectoSocial', 'nBi', 'nBi2', 'dataConstituicao', 'endereco', 'numerador', 'updated_at', 'created_at'];


    public static function getContador()
    {
        return clienteEmpresa::select('*')->latest('numerador')->first();
    }


    public static function ClienteEspecifico($codigoCliente)
    {
        $clientes = DB::table('cliente_empresas')
            ->where('cleCodigo', '=', $codigoCliente)
            ->first();

        return $clientes;
    }

    public static function getNome($nome)
    {
        $clientes = DB::table('cliente_empresas')
            ->where('nomeEmpresa', '=', $nome)
            ->first();

        return $clientes;
    }
}
