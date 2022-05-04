<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbeIva extends Model
{
    //

    protected $table = "tbeIva";

    protected $fillable = ['id', 'ccoCodigo', 'ivaInicio', 'ivaFim', 'ivaPercentagem', 'c', 'SAFTTaxType', 'SAFTTaxCode', 'SAFTTaxExemptionCode', 'ivaVerba', 'ivaActivo'];


    public static function getDataMaior()
    {
        return tbeIva::select('*')->latest('id')->first();
    }



}
