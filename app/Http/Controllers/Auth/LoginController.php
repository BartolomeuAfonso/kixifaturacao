<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\UsuarioModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

    public function getUserImage() {
        $user = Auth::user();
        $image = '' . $user->email . '-' . $user->id . '.jpg';
        $file = Storage::disk( 'local' )->get( $image );
        return Response::make( $file, 200, [ 'Content-Type' => 'image/jpeg' ] );
    }

    public function _login( $request ) {

        Session::flush();
        return redirect()->intended( '/' );
    }
}
