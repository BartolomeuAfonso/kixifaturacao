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
use PDF;

class FaturaController extends Controller
{

    public function index()
    {
        //$produto = tbeConceito::all();
        $data = tbeIva::getDataMaior()->ivaFim;
        $produto = tbeConceito::getProdutoActivo($data);
        $cliente = clienteEmpresa::all();

        return view('formulario.fatura', compact('produto', 'cliente'));
    }

    public function listaFactura()
    {

        $factura = tbeCabecalho::all();
        return view('formulario.listaFactura', compact('factura'));
    }


    // Gravar itens da Fatura
    public function salvarFatura(Request $request)
    {

      //  $numero_faura = $this->UltimaFactura()->ccoNumero;
         try {
            $this->GetFactura($request);
        
            $numero_faura = $this->UltimaFactura()->ccoNumero;
            $data = tbeIva::getDataMaior()->ivaFim;
            for ($i = 0; $i < count($request->codigo); $i++) {
                $faturaitens = new tbeDetalhe();
                $codigoSAFT = tbeConceito::getCodigoProduto($data, $request->codigo[$i])->SAFTTaxExemptionCode;
                //    dd($codigoSAFT);

                if ($request->iva[$i] == 0.14) {
                    $faturaitens->TaxPercentage = 14;
                    $faturaitens->ivaRegime = 1;
                } else {
                    $faturaitens->TaxPercentage = 0;
                    $faturaitens->ivaRegime = 0;
                }
                $faturaitens->ccoNumero = $numero_faura;
                $faturaitens->ccoCodigo = $request->codigo[$i];
                $faturaitens->ccoOrdem = 1;
                $faturaitens->dteMontante = $request->preco[$i];
                $faturaitens->dteLinha = $i + 1;
                $faturaitens->quantidade = $request->quantidade[$i];
                $faturaitens->designacao = $request->descricao[$i];
                $faturaitens->dteIva =  $request->iva[$i] * $request->preco[$i];
                $faturaitens->UnitPrice =  $request->preco[$i];
                $faturaitens->TaxExemptionCode = $codigoSAFT;
                $faturaitens->save();
            }
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao tentar salvar itens da Fatura.');
        }
        
        return $this->ImprimirFatura($numero_faura, 1);
        //  echo "<script>window.open('".rota."', '_blank')</script>";
    }

    // Obter ultimo elemento da Fatura
    public function UltimaFactura()
    {
        $ultima = tbeCabecalho::getUltimaFactura();
        return $ultima;
    }

    public function getCliente($codigo)
    {
        $cliente = clienteEmpresa::ClienteEspecifico($codigo);
        return $cliente;
    }

    // Salvar Fatura
    public function GetFactura($request)
    {

        $cont = $this->UltimaFactura()->contador + 1;
        try {
            $fatura = new tbeCabecalho();
            $fatura->ccoNumero = 'GF/' . '0' . date('Y', strtotime('now')) . '/' . $cont;
            $fatura->nomeCliente = $this->getCliente($request->codigoCliente)->nomeEmpresa;
            $fatura->cleCodigo = $request->codigoCliente;
            $fatura->cleBI = $this->getCliente($request->codigoCliente)->nif;
            $fatura->cleBIVal = $this->getCliente($request->codigoCliente)->nif;
            $fatura->enderecoCliente  =  $this->getCliente($request->codigoCliente)->endereco;
            $fatura->ccoSubTotal =  $request->ccoSubTotal;
            $fatura->ccoIVA = $request->descontoIva;
            $fatura->ccoTotal = $request->grossTotal;
            $fatura->ccoEstado = 'N';
            $fatura->ccoDataEmissao = date('Ymd', strtotime('now'));
            $fatura->ccoDataEstado =  date('Ymd H:i:s', strtotime('now'));
            $fatura->ccoDataRegisto = date('Ymd H:i:s', strtotime('now'));
            $fatura->anaProvincia = 'Luanda';
            $fatura->anaCidade  = 'Luanda';
            $fatura->anaEndereco = 'Rua Comandante Bula Nº 116-118, Bairro Operário/Sambizanga, Luanda';
            $fatura->contador = $cont;
            $fatura->save();
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao tentar faturar.');
        }
    }


    public function ImprimirFatura($codigoFactura, $codigo)
    {


        $factura = tbeCabecalho::getDadosFactura($codigoFactura);
        $codigoCliente = $factura[0]->cleCodigo;
        $dadosFactura = tbeEmpresa::getDadosEmpresa();
        $cliente = clienteEmpresa::ClienteEspecifico($codigoCliente);
        if ($codigo == 1) {
            $versao = "Orignal";
        } else {
            $versao = "2ª Via em conformidade com a original";
        }
        return PDF::loadView('relatorio.Invoice', compact('dadosFactura', 'versao', 'cliente', 'factura'))->setPaper('a4', 'portrait')->stream('Fatura.pdf');
    }
}
