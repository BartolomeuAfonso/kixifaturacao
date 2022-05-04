<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tbeEmpresa extends Model
{
    protected $table = "tbeEmpresa";

    protected $fillable = ['eraCodigo', 'eraNome', 'eraNomeComercial', 'eraTelefone', 'eraSitioWeb', 'eraEmailFiscal', 'eraEmailComercial', 'eraEDORua', 'eraEDONumero', 'eraCidade', 'eraProvinca', 'eraPais', 'eraCaixaPostal', 'eraNroContribuinte', 'eraRegistoComercial'];


    public static function getDadosEmpresa()
    {
        $empresa = DB::table('tbeEmpresa')->latest('eraCodigo')->first();

        return $empresa;
    }


    

    



}
