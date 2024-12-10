<?php

namespace App\Http\Controllers;

use App\Mail\AccountDeactivatedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\AccountDeactivated;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    /**
     * Mostrar la página de edición de perfil.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualizar la información del perfil del usuario.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|min:4|max:255|unique:users,name, ' . $user->id,
        ]);

        // si funciona el update por si marca error
        $user->update($validated);
        return redirect()->route('profile.edit')->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Desactivar la cuenta del usuario.
     */
    public function deactivateAccount(Request $request)
    {
        $user = $request->user();

        // Desactivar la cuenta
        $user->update(['active' => false]);

        if ($user->email) {
            // Generar la URL firmada sin expiración
            $signedUrl = URL::signedRoute('account.activate', ['userId' => $user->id]);

            // Enviar correo de desactivación con el enlace
            Mail::to($user->email)->send(new AccountDeactivatedMail($user, $signedUrl));
        } else {
            return redirect('/')->with('status', 'Tu cuenta ha sido desactivada, pero no pudimos enviarte un correo.');
        }

        // Cerrar sesión automáticamente
        Auth::logout();

        return redirect()->route('welcome')->with('status', 'Tu cuenta ha sido desactivada. Podrás activarla nuevamente iniciando sesión o contactando al administrador.');
    }

    /**
     * Activar la cuenta del usuario (para uso del administrador).
     */
    public function activateAccount($userId)
    {

        $user = User::findOrFail($userId);
        $user->update(['active' => true]);
        Auth::login($user);

        return redirect()->route('welcome')->with('status', 'La cuenta ha sido activada.');
    }
}
