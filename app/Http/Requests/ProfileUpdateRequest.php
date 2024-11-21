<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AdultAge;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Autoriza la solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'username' => 'required|string|min:4|max:255|unique:users,username,' . $this->user()->id,
            'birthdate' => ['required', 'date_format:d/m/Y', new AdultAge], // Usamos la regla personalizada aquí
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'cellphone_number' => 'required|string|min:10',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El nombre de usuario debe tener al menos 4 caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.',
            'birthdate.date_format' => 'La fecha de nacimiento debe estar en el formato dd/mm/yyyy.',
            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'El género debe ser uno de los siguientes: Masculino, Femenino, Otro.',
            'cellphone_number.required' => 'El número de teléfono es obligatorio.',
            'cellphone_number.min' => 'El número de teléfono debe tener al menos 10 caracteres.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
