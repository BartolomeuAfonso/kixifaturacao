<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hashModel extends Model
{

    protected $fillable =  ['chaveConfig', 'hash_str', 'InvoiceDate', 'SystemEntryDate', 'InvoiceNo', 'GrossTotal', 'hash_posterior'];


    public function __construct($InvoiceDate = null, $SystemEntryDate = null, $InvoiceNo = null, $GrossTotal = null, $hash_posterior = null)
    {
        parent::__construct();
        $this->InvoiceDate = date('Y-m-d', strtotime($InvoiceDate));
        $this->SystemEntryDate = date("Y-m-d", strtotime($SystemEntryDate)) . "T" . date("H:i:s", strtotime($SystemEntryDate));
        $this->InvoiceNo = $InvoiceNo;
        $this->GrossTotal = $GrossTotal;
        $this->hash_posterior = $hash_posterior;
    }

    public function obter_chave_publica()
    {

        return storage_path('/app/configuracoes_files/Chaves_Saft/ChavePublicaKixi.txt');
        //  return file_get_contents("configuracoes_files/Chaves_Saft/ChavePublicaKixi.txt");
    }

    public function obter_chave_privada()
    {

        //  return file_get_contents("configuracoes_files/Chaves_Saft/ChavePrivadaKixi.pem");
        return storage_path('/aap/configuracoes_files/Chaves_Saft/ChavePrivadaKixi.txt');
    }
    public function generate_hash()
    {

        $this->hash_str = strval($this->InvoiceDate . ";" . $this->SystemEntryDate . ";" . $this->InvoiceNo . ";" . $this->GrossTotal . ";" . $this->hash_posterior);
       /*
        //openssl_sign($this->hash_str, $signature, $this->obter_chave_privada(), OPENSSL_ALGO_SHA256);
         //   openssl_sign($this->hash_str, $signature, $this->obter_chave_privada(), OPENSSL_ALGO_SHA1);
        $private_key = storage_path('/aap/configuracoes_files/Chaves_Saft/ChavePrivadaKixi.txt');
        if (openssl_sign($this->hash_str, $signature, $private_key, OPENSSL_ALGO_SHA1)) {
            return base64_encode($signature);
        }
        //  return base64_encode($signature);*/
       
        $pkeyid = openssl_pkey_get_private('/aap/configuracoes_files/Chaves_Saft/ChavePrivadaKixi.pem');
        openssl_sign($this->hash_str, $signature, $pkeyid, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }
}
