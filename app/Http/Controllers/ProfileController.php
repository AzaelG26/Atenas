<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AccountDeactivated;  // Importar la notificación
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Se aplicó modificación');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Tu cuenta ha sido eliminada exitosamente');
    }

    /**
     * Deactivate the user's account.
     */
    public function deactivateAccount(Request $request): RedirectResponse
    {
        $user = $request->user();
        $user->active = 0; // Desactivar la cuenta (0 significa inactivo)
        $user->save();

        // Notificar al usuario sobre la desactivación
        $user->notify(new AccountDeactivated($user));

        // Depuración con dd()
        dd('Correo enviado a: ' . $user->email); // Muestra un mensaje indicando que el correo se envió

        Auth::logout();

        return redirect('/')->with('status', 'Tu cuenta ha sido desactivada. Podrás activarla nuevamente al iniciar sesión o contactar al administrador.');
    }

    /**
     * Activate a user's account.
     * (This method assumes an admin role or a special endpoint where an authorized user can activate an account.)
     */
    public function activateAccount($userId): RedirectResponse
    {
        $user = User::findOrFail($userId);
        $user->active = 1; // Activar la cuenta (1 significa activo)
        $user->save();

        return redirect()->back()->with('status', 'La cuenta ha sido activada.');
    }
}
