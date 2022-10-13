<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\tbeConceito;
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
        return view('formulario.cliente');
    }


    public function listaProduto()
    {
        $listaProduto = tbeConceito::paginate(10);
        return view('formulario.listaProduto', compact('listaProduto'));
    }
}
