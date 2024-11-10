<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // Método para manejar la eliminación de la cuenta
    public function destroy(Request $request)
    {
        // Obtiene el usuario autenticado
        $user = $request->user();

        // Elimina el usuario
        $user->delete();

        // Cierra la sesión después de la eliminación
        auth()->logout();

        // Redirige a la página de inicio (o donde consideres necesario) con un mensaje de confirmación
        return redirect('/')->with('status', 'Cuenta eliminada con éxito.');
    }
}
