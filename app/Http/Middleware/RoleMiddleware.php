<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        if (!$user->people->employees) {
            return redirect()->route('profile.edit')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        $check = $user->people->employees->admin == true;
        if ($check) {
            return  $next($request);
        } else {
            return redirect()->route('profile.edit')->with('error', 'No tienes permisos para acceder a esta página.');
        }
    }
}
