<?php

namespace App\Http\Controllers;

use App\Mail\RecuperarPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class PasswordsController extends Controller
{

    public function showRequestForm()
    {
        // Vista para enviar el correo al que llegará el mail
        return view('auth.forgot-password');
    }

    public function sendResetMail(Request $request)
    {
        dd($request->input('_token'));

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.mostrar')->with('error', 'No encontramos una cuenta con ese correo electrónico.');
        }

        $resetURL = URL::signedRoute('password.reset', ['id' => $user->id]);

        Mail::to($user->email)->send(new RecuperarPasswordMail($resetURL, $user));
        return redirect()->route('login')->with('success', 'Hemos enviado un enlace para restablecer la contraseña a tu correo electrónico.');
    }

    public function showResetForm($id)
    {
        // Verificar si la URL está firmada
        if (!URL::hasValidSignature(request())) {
            return redirect()->route('login')->with('error', 'La URL de restablecimiento ha expirado o no es válida.');
        }

        $user = User::findOrFail($id);
        return view('mails.form_change_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::findOrFail($request->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
