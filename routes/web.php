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
Route::get('fatura', 'FaturaController@index');
Route::get('listaFactura', 'FaturaController@listaFactura');
Route::post('salvarFatura', 'FaturaController@salvarFatura');
Route::get('editar/{id}', 'ClienteController@obterDados');
Route::post('atualizar', 'ClienteController@editar');
Route::get('impressao/{codigoFactura}/{codigo}', 'FaturaController@ImprimirFatura');


Route::get('sair', function () {
    if (Auth::logout() == null) {
        return redirect()->intended('/');
    }
});

Route::post('entrar', function () {

    return view('layouts.inicio');
});



Auth::routes();
