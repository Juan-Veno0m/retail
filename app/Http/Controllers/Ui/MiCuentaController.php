<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class MiCuentaController extends Controller
{
    // Index
    public function index(Request $request)
    {
      return view('ui.tienda.Cuenta');
    }
}
