<?php

namespace App;

use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;


class FaturaConsolidado extends Eloquent 
{

    protected $connection = 'connections';
    protected $table = "tbeConceito";

    

}
