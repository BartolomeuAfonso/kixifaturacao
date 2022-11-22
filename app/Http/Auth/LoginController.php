<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\UsuarioModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( 'guest' )->except( 'logout' );
    }

    public function entrar( Request $request ) {
        $user =  UsuarioModel::where( 'UtCodigo', $request->username )
        ->where( 'UtSenha', sha1( $request->password ) )
        ->first();
        if ( is_object( $user ) ) {
            Session::put( 'user', $user );
            return redirect()->intended( 'home' );
        } else {
            return back()->with( 'error', 'Erro ao tentar fazer login.' );
        }
    }

}
