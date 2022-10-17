<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbeConceito;
use App\tbeIva;
use Illuminate\Support\Facades\Validator;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    use Uuid;


    public function index()
    {
        return view('formulario.produto');
    }


    public function listaProduto()
    {
        $listaProduto = tbeConceito::paginate(10);
        return view('formulario.listaProduto', compact('listaProduto'));
    }

    public function getIdUltimo()
    {
        $id = tbeConceito::getProdutoID();
        return $id;
    }

    public function getIdIVA()
    {
        $id = tbeIva::getIvaID();
        return $id;
    }


    public function registarProduto(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'codigo' => 'required',
                'designacao' => 'required',
                'data_inicio' => 'required',
                'data_final' => 'required'
            ]
        );
        try {

            if ($validator->fails()) {
                return redirect('produto')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $produto = new tbeConceito();
                $id =  $this->getIdUltimo();

                $Uuid = Str::uuid()->toString();
                $produto->id = $Uuid;
                $produto->ccoCodigo = $request->input('codigo');
                $produto->ccoOrdem =  $id + 1;
                $produto->SAFTProductType = 'O';
                $produto->ccoNome = $request->input('designacao');
                $produto->ccoDescripcao = $request->input('designacao');
                $produto->ccoAtivo = 1;
                $produto->save();


                if ($request->iva == 'SIM') {
                    $produtoIva = new tbeIva();
                    $idVA =  $this->getIdIVA();
                    $produtoIva->id = $idVA + 1;
                    $produtoIva->ccoCodigo = $request->input('codigo');
                    $produtoIva->ivaInicio = $request->input('data_inicio');
                    $produtoIva->ivaFim = $request->input('data_final');
                    $produtoIva->SAFTTaxExemptionCode = '';
                    $produtoIva->ivaVerba = 'Regime Geral';
                    $produtoIva->ivaPercentagem = 14;
                    $produtoIva->SAFTTaxType = 'IVA';
                    $produtoIva->SAFTTaxCode = 'NOR';
                    $produtoIva->ivaActivo = 1;
                    $produtoIva->ivaRegime = 1;
                    $produtoIva->save();
                } else {
                    $produtoIva = new tbeIva();
                    $idVA =  $this->getIdIVA();
                    $produtoIva->id = $idVA + 1;
                    $produtoIva->ccoCodigo = $request->input('codigo');
                    $produtoIva->ivaInicio = $request->input('data_inicio');
                    $produtoIva->ivaFim = $request->input('data_final');
                    $produtoIva->SAFTTaxExemptionCode = 'M04';
                    $produtoIva->ivaVerba = 'IVA - Regime de Não Sujeição';
                    $produtoIva->ivaPercentagem = 0;
                    $produtoIva->SAFTTaxType = 'NS';
                    $produtoIva->SAFTTaxCode = 'NS';
                    $produtoIva->ivaActivo = 1;
                    $produtoIva->ivaRegime = 0;
                    $produtoIva->save();
                }
                return back()->with('error', 'Dados salvo com sucesso');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao tentar registar Produto.');
        }
    }
}
