<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class admin
{

    public function handle($request, Closure $next)
    {
      if (Auth::user()->hasAnyRole('admin')) {
        return $next($request);
      }
      return redirect('/');
    }
}
