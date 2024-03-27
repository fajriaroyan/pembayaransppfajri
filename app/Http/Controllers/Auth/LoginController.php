<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:siswa')->except('logout');
    }

    public function loginsiswa()
    {
       return view('auth.login-siswa');
    }

    public function siswaLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);

        if (Auth::guard('siswa')->attempt($credentials)){
           $request->session()->regenerate();

           return redirect()->intended('dashboard');
        }

        return back()->witherror([
            'email'=>'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
