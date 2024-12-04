<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\AccountDeactivated;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->user()->id),
            ],
            'username' => [
                'required',
                'string',
                'min:4',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id),
            ],
            'gender' => 'required|in:Male,Female,Other',
            'birthdate' => 'required|date_format:d/m/Y',
            'cellphone_number' => 'required|string|max:15',
        ]);

        $user = $request->user();

        if ($user->email !== $validated['email']) {
            if (!Hash::check($request->input('password'), $user->password)) {
                return redirect()->route('profile.edit')->withErrors(['password' => 'La contraseña es incorrecta para confirmar el cambio de correo electrónico.']);
            }

            $user->email_verified_at = null;
        }

        $formattedBirthdate = Carbon::createFromFormat('d/m/Y', $validated['birthdate'])->format('Y-m-d');
        $age = Carbon::parse($formattedBirthdate)->diffInYears(Carbon::now());

        if ($age < 18) {
            return redirect()->route('profile.edit')->withErrors(['birthdate' => 'Debes ser mayor de 18 años.']);
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'gender' => $validated['gender'],
            'birthdate' => $formattedBirthdate,
            'cellphone_number' => $validated['cellphone_number'],
        ]);

        return redirect()->route('profile.edit')->with('status', '¡Perfil actualizado con éxito!');
    }

    /**
     * Desactivar la cuenta del usuario.
     */
    public function deactivateAccount(Request $request)
    {
        $user = $request->user();
        $user->update(['active' => false]); // Cambiar el estado a inactivo (false)

        // Notificar al usuario sobre la desactivación
        $user->notify(new AccountDeactivated($user));

        // Cerrar sesión automáticamente
        Auth::logout();

        return redirect('/')->with('status', 'Tu cuenta ha sido desactivada. Podrás activarla nuevamente iniciando sesión o contactando al administrador.');
    }

    /**
     * Activar la cuenta del usuario (para uso del administrador).
     */
    public function activateAccount($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['active' => true]); // Cambiar el estado a activo (true)

        return redirect()->back()->with('status', 'La cuenta ha sido activada.');
    }
}
