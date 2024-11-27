<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AccountDeactivated;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

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
            'password' => 'required_if:email,' . $request->user()->email, 
        ], [
            'username.min' => 'El nombre de usuario debe tener al menos 4 caracteres.', 
        ]);

        $user = $request->user();

        
        if ($user->email !== $request->input('email')) {
           
            if (!Hash::check($request->input('password'), $user->password)) {
                return redirect()->route('profile.edit')->withErrors(['password' => 'La contraseña es incorrecta para confirmar el cambio de correo electrónico.']);
        }
            
            $user->email_verified_at = null;
        }

       
        $birthdate = $request->input('birthdate');
        try {
            $formattedBirthdate = Carbon::createFromFormat('d/m/Y', $birthdate)->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->withErrors(['birthdate' => 'Fecha de nacimiento inválida. Debe estar en formato dd/mm/yyyy.']);
        }
// 
        $age = Carbon::parse($formattedBirthdate)->diffInYears(Carbon::now());
        if ($age < 18) {
            return redirect()->route('profile.edit')->withErrors(['birthdate' => 'Debes ser mayor de 18 años.']);
        }

        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'gender' => $request->input('gender'),
            'birthdate' => $formattedBirthdate,
            'cellphone_number' => $request->input('cellphone_number'),
        ]);

       
        $user->save();

       
        session()->flash('status', '¡Los datos se actualizaron correctamente!');

        return redirect()->route('profile.edit');
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
        $user->active = 0; 
        $user->save();

        
        $user->notify(new AccountDeactivated($user));

       
        dd('Correo enviado a: ' . $user->email);

        Auth::logout();

        return redirect('/')->with('status', 'Tu cuenta ha sido desactivada. Podrás activarla nuevamente al iniciar sesión o contactar al administrador.');
    }

    /**
     * Activate a user's account.
     */
    public function activateAccount($userId): RedirectResponse
    {
        $user = User::findOrFail($userId);
        $user->active = 1; //activar la cuenta del tilin
        $user->save();

        return redirect()->back()->with('status', 'La cuenta ha sido activada.');
    }
}
