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
     * 
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * 
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|min:4|max:255|unique:users,name, ' . $user->id,
        ]);


        $user->update($validated);
        return redirect()->route('profile.edit')->with('success', 'Datos actualizados correctamente');
    }

    /**
     * 
     */
    public function deactivateAccount(Request $request)
    {
        $user = $request->user();

        $user->update(['active' => false]);

        if ($user->email) {
            $signedUrl = URL::signedRoute('account.activate', ['userId' => $user->id]);

            Mail::to($user->email)->send(new AccountDeactivatedMail($user, $signedUrl));
        } else {
            return redirect('/')->with('status', 'Tu cuenta ha sido desactivada, pero no pudimos enviarte un correo.');
        }

        Auth::logout();

        return redirect()->route('welcome')->with('status', 'Tu cuenta ha sido desactivada. Podrás activarla nuevamente iniciando sesión o contactando al administrador.');
    }

    /**
     * 
     */
    public function activateAccount($userId)
    {

        $user = User::findOrFail($userId);
        $user->update(['active' => true]);
        Auth::login($user);

        return redirect()->route('welcome')->with('status', 'La cuenta ha sido activada.');
    }
}
