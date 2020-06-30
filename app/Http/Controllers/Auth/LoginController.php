<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }
    /**
    * Handle an authentication attempt.
    * Post
    */
    public function login(Request $request, $redirectToRoute = null)
    {
      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
          // Authentication passed...
          if (! $request->user() ||
              ($request->user() instanceof MustVerifyEmail &&
              ! $request->user()->hasVerifiedEmail())) {
              return $request->expectsJson()
                      ? abort(403, 'Correo electronico no verificado')
                      : Redirect::route($redirectToRoute ?: 'verification.notice');
          } else {
            if (url()->current()!='/login') {return back();}
            return redirect()->intended('/');
          }
      }
    }
    // Login Form View GET
    public function showLoginForm()
    {

        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }
    // Logout
    public function logout()
    {
        //Session::flush()
        Auth::logout();
        return back();
    }

}
