<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbeDetalhe extends Model
{

    protected $table = "tbeDetalhe";

    protected $fillable = ['ccoNumero', 'ccoCodigo', 'ccoOrdem', 'dteLinha', 'dteMontante', 'dteIva', 'ivaRegime', 'designacao', 'TaxType', 'quantidade', 'TaxCode', 'TaxPercentage', 'TaxExemptionCode', 'TaxExemptionReason', 'InvoiceNo', 'Reason', 'Reference', 'UnitPrice', 'updated_at', 'created_at'];
}
