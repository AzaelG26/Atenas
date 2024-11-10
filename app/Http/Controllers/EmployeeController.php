<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Muestra el formulario para añadir un empleado.
     */
    public function create()
    {
        return view('añadir_empleados');
    }

    /**
     * Almacena los datos del empleado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validaciones
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:50',
            'user_email' => 'required|email|max:50|unique:users,email',
            'user_password' => 'required|string|min:8',
            'personal_name' => 'required|string|max:50',
            'lastname1' => 'required|string|max:50',
            'lastname2' => 'nullable|string|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'cellphone_number' => 'required|string|max:14',
            'birthdate' => 'required|date',
            'admin' => 'required|boolean',
            'curp' => 'required|string|max:18',
            'nss' => 'required|string|max:11',
            'rfc' => 'required|string|max:13',
        ]);

        // Llamada al procedimiento almacenado para añadir el empleado
        DB::statement('CALL add_employee(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $validatedData['user_name'],
            $validatedData['user_email'],
            bcrypt($validatedData['user_password']),
            $validatedData['personal_name'],
            $validatedData['lastname1'],
            $validatedData['lastname2'],
            $validatedData['gender'],
            $validatedData['cellphone_number'],
            $validatedData['birthdate'],
            $validatedData['admin'],
            $validatedData['curp'],
            $validatedData['nss'],
            $validatedData['rfc'],
        ]);

        return redirect()->route('añadir_empleados')->with('success', 'Empleado añadido correctamente.');
    }
}
