<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbeIva extends Model
{
    //

    protected $table = "tbeIva";

    protected $fillable = ['id', 'ccoCodigo', 'ivaInicio', 'ivaFim', 'ivaPercentagem', 'ivaRegime', 'SAFTTaxType', 'SAFTTaxCode', 'SAFTTaxExemptionCode', 'ivaVerba', 'ivaActivo', 'updated_at', 'created_at'];


    public static function getIvaID()
    {
        // return tbeIva::select('*')->latest('id')->first();
        return tbeIva::select('*')->max('id');
    }

    public static function getDataMaior()
    {
        return tbeIva::select('*')->latest('id')->first();
    }
}
