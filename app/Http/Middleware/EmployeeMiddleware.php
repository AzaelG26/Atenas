<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'inicia sesión.');
        }
        if (!(optional($user->people)->employees)) {
            return back()->with('error', 'No tienes permisos para acceder a esta página.');
        }
        $user->people->employees;

        if (!$user) {
            return back()->with('error', 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
