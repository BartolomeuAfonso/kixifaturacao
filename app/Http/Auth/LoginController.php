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


class LoginController extends Controller
{
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    public function entrar(Request $request)
    {

        $user = DB::connection('sqlsrv')->table('tKxUsUtilizador')->where('UtCodigo', $request->username) //select('SELECT * FROM products');
            ->where('UtSenha', md5($request->password))
            ->first();
        if (is_object($user)) {
            return redirect()->intended('home');
        } else {
            return back()->with('error', 'Erro ao tentar fazer login.');
        }
    }
  */
    
    public function entrar(Request $request)
    {
        try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "http://192.168.5.21/KIXIAPI/public/api/loginAPI";

            $response = $client->request('POST', $url, [
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            $user = json_decode($response->getBody());       
            
            if($response->getStatusCode() == "200"){
                if(is_object($user)){ 
                    Session::put('user',$user);
                    if(Session::has('user')){
                        return redirect()->intended('home');
                    }else{
                        return redirect()->intended('/');
                    }                      
                }else{
                    return redirect()->intended('/');
                } 
            }else{
                return redirect()->intended('/');
            }
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }
}
