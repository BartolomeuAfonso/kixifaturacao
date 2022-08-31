<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Exception;
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

    public function entrar(Request $request)
    {



        try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "http://kixiagenda.kixicredito.com/public/api/loginAPI";

            $response = $client->request('POST', $url, [
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);

            //  dd(json_decode($response->getBody()));
            $users = json_decode($response->getBody());
            //    dd($users);



            if ($response->getStatusCode() == "200") {
                if (is_object($users)) {

                    //  Auth::guard($user->username);,
                    //     Auth::login($user, true);

                    //    Auth::login($users);

                    return redirect()->intended('home');
                } else {
                    return redirect()->intended('/');
                }
            } else {
                echo 0;
            }
        } catch (RequestException $e) {
            echo GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo GuzzleHttp\Psr7\str($e->getResponse());
            }
        }
    }


    public function _login($request)
    {
        if (\Auth::attempt([
            'username'    => $request->username,
        ])) {
            return [
                'success' => true
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }
}
