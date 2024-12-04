<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateHttpMethod
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
        // Verifica si el método HTTP coincide con las rutas esperadas
        $routesWithMethods = [
            'post_carro' => 'POST',
            'procesar.pago' => 'POST',
        ];

        $routeName = $request->route()->getName();

        if (isset($routesWithMethods[$routeName]) && $routesWithMethods[$routeName] !== $request->method()) {
            // Redirigir al menú con un mensaje de error
            return redirect()->route('menu')->with('error', 'Acceso no permitido a esta ruta.');
        }

        return $next($request);
    }
}
