<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsuarioModel extends Model
{

    protected $table = "tKxUsUtilizador";
    protected $fillable = ['UtCodigo', 'Nombre01', 'UtSenha'];
}
