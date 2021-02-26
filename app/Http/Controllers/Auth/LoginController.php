<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
            if (Auth::user()->hasAnyRole('admin')) {return redirect('/dashboard');}
            if (url()->current()!='/login') {return redirect('/carrito');}
            return redirect()->intended('/');
          }
      }
      return Redirect::to("login")->withErrors(['email' => ['Correo y/o contraseña inválida.']]);
    }
    // Post Ajax Login
    public function AjaxLogin(Request $req)
    {
      // first get the email
      $user = DB::table('asociados_usuario as s')
                ->join('asociados as a','a.AsociadosID','=','s.AsociadosID')
                ->join('users','users.id','=','s.UsuarioID')
                ->where('a.NoEmpresario',$req->NoEmpresario)->first();
      if (isset($user)) {
        if (Auth::attempt(['email' => $user->email, 'password' => $req->Password])) {
          // The user is active, not suspended, and exists.
          return response()->json(['tipo' => 200,'mensaje'=>'ok.']);
        }return response()->json(['tipo' => 500,'mensaje'=>'La contraseña es inválida.']);
      }else{return response()->json(['tipo' => 500,'mensaje'=>'Usuario no existe.']);}

    }
    // Login Form View GET (UI)
    public function showLoginForm()
    {

        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }
    // Login Form View GET (Admin)
    public function AdminLogin()
    {

        session(['url.intended' => url()->previous()]);
        return view('auth.acceso');
    }
    // Logout
    public function logout()
    {
        //Session::flush()
        Auth::logout();
        return back();
    }

}
