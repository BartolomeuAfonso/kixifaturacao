<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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


    public function loginAPI(Request $request)
    {
        try {
            //  

            $client = new Client(); //GuzzleHttp\Client

            //  $url = "http://192.168.5.83:8080/kixiagenda/public/api/loginAPI";
            $url = "http://kixiagenda.kixicredito.com/public/api/loginAPI";

            $response = $client->request('GET', $url, [
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);

            $user = json_decode($response->getBody());


            if ($response->getStatusCode() == "200") {
                //if(is_object($user)){ 
                //dd($user);
                Auth::login($user, true);

                return redirect()->intended('home');
                //}else{
                return redirect()->intended('/');
                //} 
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
}
