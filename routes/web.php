<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.login');
});

Route::get('clientes', 'ClienteController@index');
Route::post('registar', 'ClienteController@registarCliente');
Route::get('lista', 'ClienteController@listaCliente');
Route::get('listaProduto', 'ProdutoController@listaProduto');
Route::get('produto', 'ProdutoController@index');
Route::post('registarProduto', 'ProdutoController@registarProduto');
Route::get('fatura', 'FaturaController@index');
Route::get('recibo', 'FaturaController@indexRecibo');
Route::get('listaFactura', 'FaturaController@listaFactura');
Route::get('listaFacturaAPI', 'FaturaController@listaFacturaAPI');
Route::post('salvarFatura', 'FaturaController@salvarFatura');
Route::post('salvarRecibo', 'FaturaController@salvarReciboManual');
Route::get('editar/{id}', 'ClienteController@obterDados');
Route::post('atualizar', 'ClienteController@editar');
Route::get('impressao/{codigoFactura}/{codigo}', 'FaturaController@ImprimirFatura');
Route::get('buscar', 'FaturaController@buscarFactura');
Route::get('emitir/{codigoFactura}', 'FaturaController@emitirServico');
Route::get('impressaoAPI/{codigoFactura}/{codigo}', 'FaturaController@ImprimirFaturaAPI');
Route::post('sendemail', 'EmailController@sendmail');
Route::get('email', 'EmailController@index');
//Route::post('salvarFatura1', 'FaturaController@salvarFaturaNota');


Route::get('sair', function () {
    if (Auth::logout() == null) {
        return redirect()->intended('/');
    }
});


Route::post('entrar', 'Auth\LoginController@entrar');


Route::get('home', function () {
    return view('layouts.inicio');
    // dd('Teste');

});
//Route::get('home', 'HomeController@index');

////// Faturacao ////
Route::get('listarFaturaAPI', 'FaturaControllerAPI@listarFaturaAPI');
Route::get('getDadosFactura/{codigoFactura}', 'FaturaControllerAPI@getDadosFacturaAPI');
Route::get('getDadosEmpresa', 'FaturaControllerAPI@getDadosEmpresaAPI');
Route::get('ClienteEspecifico/{cliente}', 'FaturaControllerAPI@ClienteEspecificoAPI');


Auth::routes();
