<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME; SE ATTIVATA VIENE REDIREZIONATI DOPO IL LOGIN NEL PATH DEFINITO IN ROUTE SERVICE PROVIDERE

    public function username()
    {
        return 'username';
    }

    //Usiamo la funzione
    /**
     * Override:: definisce la homepage per i diversi utenti.
     *
     * @var string
     */
    protected function redirectTo() {
        $role = auth()->user()->livello_utenza; //è uguale a fare Auth::user()->role (da cambiare role in livello_utenza
        switch ($role) {
            case '4': return '/admin';
            default: return '/';
        }
    }

    /**
     * Override:: Login con 'username' al posto di 'email'.
     *
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
