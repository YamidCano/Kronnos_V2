<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class AuthActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard()->check() && auth()->user()->status == 1) {

            // usuario con sesión iniciada pero inactivo

            // cerramos su sesión
            Auth::guard('web')->logout();

            // invalidamos su sesión
            $request->session()->invalidate();

            // redireccionamos a donde queremos
            abort(401,  __('Your account is deactivated'));
        }
        return $next($request);


    }
}
