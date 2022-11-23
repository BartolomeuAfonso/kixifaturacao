<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clienteEmpresa;
use Illuminate\Support\Facades\Validator;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Str;

class ClienteController extends Controller
 {

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    use Uuid;

    public function index()
 {

        $pais = clienteEmpresa::getPais();
        //   dd( $pais );
        return view( 'formulario.cliente', compact( 'pais' ) );
    }

    public function listaCliente()
 {
        $listaCliente = clienteEmpresa::paginate( 10 );
        return view( 'formulario.listaCliente', compact( 'listaCliente' ) );
    }

    // Registar Cliente

    public function registarCliente( Request $request )
 {

        $validarBI = '/^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/';
        $validarNIF = '/^[0-9]{10}$/';
        $contador = $this->getContador()->numerador + 1;
        $capitalSocial = str_replace( '.', '', $request->capitalSocial );
        $nomeCliente = clienteEmpresa::getNome( $request->nomeEmpresa );
        $nif = clienteEmpresa::getNIF( $request->nif );

        $validator = Validator::make(
            $request->all(),
            [
                'nomeEmpresa' => 'required',
                'nif' => 'required',
                'endereco' => 'required',
                'telefone' => 'required',
                'nacionadade'=>'required'
            ]
        );

        try {

            if ( $validator->fails() ) {
                return redirect( 'clientes' )
                ->withErrors( $validator )
                ->withInput();
            } else {

                if ( $request->nacionadade == 'AO' ) {
                    if ( preg_match( $validarBI, $request->nif ) ||  preg_match( $validarNIF, $request->nif ) ) {

                        if ( !empty( $nomeCliente ) || !empty( $nif ) ) {

                            return back()->with( 'error', 'Já existe Nome ou NIF na base de Dados' );

                        } else {
                            $cliente = new clienteEmpresa();
                            $Uuid = Str::uuid()->toString();
                            $cliente->id =   $Uuid;
                            $cliente->cleCodigo = 'FM/P/K/' . $contador;
                            $cliente->nomeEmpresa = $request->input( 'nomeEmpresa' );
                            $cliente->nif = $request->input( 'nif' );
                            $cliente->socio = $request->input( 'socio' );
                            $cliente->socio1 = $request->input( 'socio1' );
                            $cliente->sector = $request->input( 'sector' );
                            $cliente->telefone = $request->input( 'telefone' );
                            $cliente->capitalSocial = $capitalSocial;
                            $cliente->objectoSocial = $request->input( 'objectoSocial' );
                            $cliente->nBi = $request->input( 'nBi' );
                            $cliente->nBi2 = $request->input( 'nBi2' );
                            $cliente->dataConstituicao = $request->input( 'dataConstituicao' );
                            $cliente->endereco = $request->input( 'endereco' );
                            $cliente->numerador = $contador;
                            $cliente->save();
                            return back()->with( 'sucesso', 'Dados salvo com sucesso' );

                        }

                    } else {
                        return back()->with( 'error', 'O número de idenficação fiscal encontra-se errado' );
                    }
                } else {

                    if ( !empty( $nomeCliente ) || !empty( $nif ) ) {

                        return back()->with( 'error', 'Já existe Nome ou NIF na base de Dados' );

                    } else {
                        $cliente = new clienteEmpresa();
                        $Uuid = Str::uuid()->toString();
                        $cliente->id =   $Uuid;
                        $cliente->cleCodigo = 'FM/P/K/' . $contador;
                        $cliente->nomeEmpresa = $request->input( 'nomeEmpresa' );
                        $cliente->nif = $request->input( 'nif' );
                        $cliente->socio = $request->input( 'socio' );
                        $cliente->socio1 = $request->input( 'socio1' );
                        $cliente->sector = $request->input( 'sector' );
                        $cliente->telefone = $request->input( 'telefone' );
                        $cliente->capitalSocial = $capitalSocial;
                        $cliente->objectoSocial = $request->input( 'objectoSocial' );
                        $cliente->nBi = $request->input( 'nBi' );
                        $cliente->nBi2 = $request->input( 'nBi2' );
                        $cliente->dataConstituicao = $request->input( 'dataConstituicao' );
                        $cliente->endereco = $request->input( 'endereco' );
                        $cliente->numerador = $contador;
                        $cliente->save();
                        return back()->with( 'sucesso', 'Dados salvo com sucesso' );

                    }
                }

            }
        } catch ( Exception $e ) {
            return back()->with( 'error', 'Erro ao tentar registar cliente.' );
        }
    }

    // Obter ultimo elemento da Tabela Cliente

    public function getContador()
 {

        $contador = clienteEmpresa::getContador();

        return $contador;
    }

    public function obterDados( $id )
 {
        $cliente = clienteEmpresa::getNome( $id );
        return view( 'formulario.edit', compact( 'cliente' ) );
    }

    public function editar( Request $request )
 {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeEmpresa' => 'required',
                'nif' => 'required',
                'endereco' => 'required',
                'telefone' => 'required'
            ]
        );
        if ( $validator->fails() ) {
            return redirect( 'editar' )
            ->withErrors( $validator )
            ->withInput();
        } else {
            $cliente = clienteEmpresa::find( $request->id );
            $cliente->nomeEmpresa = $request->nomeEmpresa;
            $cliente->nif = $request->nif;
            $cliente->endereco = $request->endereco;
            $cliente->telefone = $request->telefone;
            $cliente->objectoSocial = $request->actividade;
            $cliente->dataConstituicao = $request->ano;
            $cliente->capitalSocial = $request->capitalSocial;
            $cliente->socio = $request->socio1;
            $cliente->socio1 = $request->socio2;
            $cliente->nBi = $request->nBi;
            $cliente->nBi2 = $request->nBi2;
            $cliente->save();
        }
        return redirect( 'lista' );
    }
}