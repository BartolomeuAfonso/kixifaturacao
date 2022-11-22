<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\clienteEmpresa;
use App\tbeConceito;
use App\tbeDetalhe;
use App\tbeCabecalho;
use App\tbeEmpresa;
use App\tbeIva;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\hashModel;
use App\tbeCabecalhoManual;
use App\tbeDetalheManual;
use PDF;
use Exception;

class FaturaController extends Controller
 {

    public function index()
 {
        //$produto = tbeConceito::all();
        $data = tbeIva::getDataMaior()->ivaFim;
        $produto = tbeConceito::getProdutoActivo( $data );
        $cliente = clienteEmpresa::all();
        return view( 'formulario.fatura', compact( 'produto', 'cliente' ) );
    }

    public function indexRecibo()
 {
        //$produto = tbeConceito::all();
        $data = tbeIva::getDataMaior()->ivaFim;
        $produto = tbeConceito::getProdutoActivo( $data );
        $cliente = clienteEmpresa::all();
        return view( 'formulario.recibo', compact( 'produto', 'cliente' ) );
    }

    public function listaFactura()
 {

        $factura = tbeCabecalho::paginate( 10 );
        return view( 'formulario.listaFactura', compact( 'factura' ) );
    }

    public function listaFacturaAPI()
 {

    $produto = tbeCabecalho::listarProduto();
    dd($produto);
    /*
        try {
            $client = new Client();
            $factura = 'http://192.168.5.21/KIXIAPI/public/api/loginAPI';

            // $factura = tbeCabecalho::paginate( 10 );
            return view( 'formulario.listaFacturaAPI', compact( 'factura' ) );
        } catch ( RequestException $e ) {
            echo GuzzleHttp\Psr7\str( $e->getRequest() );
            if ( $e->hasResponse() ) {
                echo GuzzleHttp\Psr7\str( $e->getResponse() );
            }
        }*/

    }

    public function salvarFatura( Request $request )
 {
        try {
            $this->GetFactura( $request );
            //  dd( $request->request );
            $numero_faura = tbeCabecalho::getUltimaFactura( $request->tipoFatura );
            $data = tbeIva::getDataMaior()->ivaFim;
            for ( $i = 0; $i < count( $request->codigo );
            $i++ ) {
                $faturaitens = new tbeDetalhe();

                $codigoSAFT = '';
                //tbeConceito::getCodigoProduto( $data, $request->codigo[ $i ] )->SAFTTaxExemptionCode;

                if ( $request->iva[ $i ] == 0.14 ) {
                    $faturaitens->TaxPercentage = 14;
                    $faturaitens->ivaRegime = 1;
                } else {
                    $faturaitens->TaxPercentage = 0;
                    $faturaitens->ivaRegime = 0;
                }
                $faturaitens->ccoNumero = $numero_faura;
                $faturaitens->ccoCodigo = $request->codigo[ $i ];
                $faturaitens->ccoOrdem = 1;
                $faturaitens->dteMontante = $request->preco[ $i ];
                $faturaitens->dteLinha = $i + 1;
                $faturaitens->quantidade = $request->quantidade[ $i ];
                $faturaitens->designacao = $request->descricao[ $i ];
                $faturaitens->dteIva =  $request->iva[ $i ] * $request->preco[ $i ];
                $faturaitens->UnitPrice =  $request->preco[ $i ];
                $faturaitens->TaxExemptionCode = $codigoSAFT;
                $faturaitens->save();
            }
        } catch ( Exception $e ) {
            return back()->with( 'error', 'Erro ao tentar salvar itens da Fatura.' );
        }

        return $this->ImprimirFatura( $numero_faura, 1 );
    }

    // Obter ultimo elemento da Fatura

    public function getCliente( $codigo )
 {
        $cliente = clienteEmpresa::ClienteEspecifico( $codigo );
        return $cliente;
    }

    // Salvar Fatura

    public function GetFactura( $request )
 {

        $cont = tbeCabecalho::getUltima( $request->tipoFatura );

        try {
            $fatura = new tbeCabecalho();
            if ( $request->tipoFatura == 'GF' ) {
                $cont = $cont + 1;
                $tipoFatura =  $request->tipoFatura . '/' . '01' . date( 'Y', strtotime( 'now' ) ) . '/' . $cont;
            } else {
                $cont = $cont + 1;
                $tipoFatura =  $request->tipoFatura . '/' . '01' . date( 'Y', strtotime( 'now' ) ) . '/' . $cont;
                $fatura->SAFTInvoiceNo = $request->nFactura;
            }
            $Uuid = Str::uuid()->toString();
            $fatura->id =   $Uuid;
            $fatura->ccoNumero = $tipoFatura;
            $fatura->nomeCliente = $this->getCliente( $request->codigoCliente )->nomeEmpresa;
            $fatura->cleCodigo = $request->codigoCliente;
            $fatura->cleBI = $this->getCliente( $request->codigoCliente )->nif;
            $fatura->cleBIVal = $this->getCliente( $request->codigoCliente )->nif;
            $fatura->enderecoCliente  =  $this->getCliente( $request->codigoCliente )->endereco;
            $fatura->ccoSubTotal =  $request->nextTotal;
            $fatura->ccoIVA = $request->descontoIva;
            $fatura->ccoTotal = $request->grossTotal;
            $fatura->ccoEstado = 'N';
            $fatura->ccoDataEmissao = date( 'Ymd', strtotime( 'now' ) );
            $fatura->ccoDataEstado =  date( 'Ymd H:i:s', strtotime( 'now' ) );
            $fatura->ccoDataRegisto = date( 'Ymd H:i:s', strtotime( 'now' ) );
            $fatura->anaProvincia = 'Luanda';
            $fatura->anaCidade  = 'Luanda';
            $fatura->anaEndereco = 'Rua Comandante Bula Nº 116-118, Bairro Operário/Sambizanga, Luanda';
            $fatura->contador = $cont;
            $fatura->save();
        } catch ( Exception $e ) {
            return back()->with( 'error', 'Erro ao tentar faturar.' );
        }
    }

    public function ImprimirFatura( $codigoFactura1, $codigo )
 {

        if ( $codigo == 1 ) {
            $versao = 'Orignal';
            $factura = tbeCabecalho::getDadosFactura( $codigoFactura1 );
            $codigoCliente = $factura[ 0 ]->cleCodigo;
            $dadosFactura = tbeEmpresa::getDadosEmpresa();
            $cliente = clienteEmpresa::ClienteEspecifico( $codigoCliente );
            $tipoFactura = substr( $codigoFactura1, 0, 2 );
        } else {

            $codigoFactura = base64_decode( $codigoFactura1 );
            $tipoFactura = substr(
                $codigoFactura,
                0,
                2
            );

            $factura = tbeCabecalho::getDadosFactura( $codigoFactura );
            $codigoCliente = $factura[ 0 ]->cleCodigo;
            $dadosFactura = tbeEmpresa::getDadosEmpresa();
            $cliente = clienteEmpresa::ClienteEspecifico( $codigoCliente );
            $versao = '2ª Via em conformidade com a original';
        }
        return PDF::loadView( 'relatorio.Invoice', compact( 'dadosFactura', 'versao', 'cliente', 'factura', 'tipoFactura' ) )->setPaper( 'a4', 'portrait' )->stream( 'Fatura.pdf' );
    }

    public function buscarFactura( Request $request )
 {
        $factura = tbeCabecalho::getBuscarFactura( $request->dataInicio, $request->dataFim );
        return view( 'formulario.listaFactura', compact( 'factura' ) );
    }

    public function emitirServico( $codigoFactura1 )
 {

        $codigoFactura = base64_decode( $codigoFactura1 );
        $factura = tbeCabecalho::getDadosFactura( $codigoFactura );
        $codigoCliente = $factura[ 0 ]->cleCodigo;
        $cliente = clienteEmpresa::ClienteEspecifico( $codigoCliente );
        return view( 'formulario.emissao', compact( 'factura', 'cliente' ) );
    }

    public function salvarReciboManual( Request $request )
 {
        try {
            $this->GetFacturaRecibo( $request );
            //  dd( $request->tipoFatura );
            $numero_faura = tbeCabecalhoManual::getUltimaFactura( 'RG' );
            $data = tbeIva::getDataMaior()->ivaFim;
            for ( $i = 0; $i < count( $request->descricao );
            $i++ ) {
                $faturaitens = new tbeDetalheManual();
                if ( $request->iva[ $i ] == 0.14 ) {
                    $faturaitens->TaxPercentage = 14;
                    $faturaitens->ivaRegime = 1;
                } else {
                    $faturaitens->TaxPercentage = 0;
                    $faturaitens->ivaRegime = 0;
                }
                $faturaitens->ccoNumero = $numero_faura;
                $faturaitens->ccoCodigo = $request->descricao[ $i ];
                $faturaitens->ccoOrdem = 1;
                $faturaitens->dteMontante = $request->preco[ $i ];
                $faturaitens->dteLinha = $i + 1;
                $faturaitens->quantidade = $request->quantidade[ $i ];
                $faturaitens->designacao = $request->descricao[ $i ];
                $faturaitens->dteIva =  $request->iva[ $i ] * $request->preco[ $i ];
                $faturaitens->UnitPrice =  $request->preco[ $i ];
                //  $faturaitens->TaxExemptionCode = $codigoSAFT;
                $faturaitens->save();
            }
        } catch ( Exception $e ) {
            return back()->with( 'error', 'Erro ao tentar salvar itens da Fatura.' );
        }

        return $this->ImprimirRecibo( $numero_faura, 1 );
    }

    public function GetFacturaRecibo( $request )
 {

        $cont = tbeCabecalhoManual::getUltimaRecibo();
        try {
            $fatura = new tbeCabecalhoManual();
            $tipoFatura =  'RG' . '/' . '01' . date( 'Y', strtotime( 'now' ) ) . '/' . $cont;
            $Uuid = Str::uuid()->toString();
            $fatura->id =   $Uuid;
            $fatura->ccoNumero = $tipoFatura;
            $fatura->nomeCliente = $this->getCliente( $request->codigoCliente )->nomeEmpresa;
            $fatura->cleCodigo = $request->codigoCliente;
            $fatura->cleBI = $this->getCliente( $request->codigoCliente )->nif;
            $fatura->cleBIVal = $this->getCliente( $request->codigoCliente )->nif;
            $fatura->enderecoCliente  =  $this->getCliente( $request->codigoCliente )->endereco;
            $fatura->ccoSubTotal =  $request->ccoSubTotal;
            $fatura->ccoIVA = $request->descontoIva;
            $fatura->ccoTotal = $request->grossTotal;
            $fatura->ccoEstado = 'N';
            $fatura->ccoDataEmissao = date( 'Ymd', strtotime( 'now' ) );
            $fatura->ccoDataEstado =  date( 'Ymd H:i:s', strtotime( 'now' ) );
            $fatura->ccoDataRegisto = date( 'Ymd H:i:s', strtotime( 'now' ) );
            $fatura->anaProvincia = 'Luanda';
            $fatura->anaCidade  = 'Luanda';
            $fatura->anaEndereco = 'Rua Comandante Bula Nº 116-118, Bairro Operário/Sambizanga, Luanda';
            $fatura->contador = $cont + 1;
            $fatura->save();
        } catch ( Exception $e ) {
            return back()->with( 'error', 'Erro ao tentar faturar.' );
        }
    }

    public function ImprimirRecibo( $codigoFactura1, $codigo )
 {

        if ( $codigo == 1 ) {
            $versao = 'Orignal';
            $factura = tbeCabecalhoManual::getDadosFactura( $codigoFactura1 );
            $codigoCliente = $factura[ 0 ]->cleCodigo;
            $dadosFactura = tbeEmpresa::getDadosEmpresa();
            $cliente = clienteEmpresa::ClienteEspecifico( $codigoCliente );
            $tipoFactura = substr( $codigoFactura1, 0, 2 );
        } else {

            $codigoFactura = base64_decode( $codigoFactura1 );
            $tipoFactura = substr(
                $codigoFactura,
                0,
                2
            );

            $factura = tbeCabecalhoManual::getDadosFactura( $codigoFactura );
            $codigoCliente = $factura[ 0 ]->cleCodigo;
            $dadosFactura = tbeEmpresa::getDadosEmpresa();
            $cliente = clienteEmpresa::ClienteEspecifico( $codigoCliente );
            $versao = '2ª Via em conformidade com a original';
        }
        return PDF::loadView( 'relatorio.ImprimiRecibo', compact( 'dadosFactura', 'versao', 'cliente', 'factura', 'tipoFactura' ) )->setPaper( 'a4', 'portrait' )->stream( 'Fatura.pdf' );
    }
}
