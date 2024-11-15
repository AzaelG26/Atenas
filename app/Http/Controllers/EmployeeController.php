<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\People;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Muestra el formulario para añadir un empleado.
     */
    public function create()
    {
        return view('añadir_empleados');
    }

    public function buscarPersona(Request $request)
    {
        $query = $request->input('query');

        $usuarios = User::where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })->whereHas('people')->with('people')->get();

        return response()->json([
            'usuarios' => $usuarios,
        ]);
    }


    /**
     * Almacena los datos del empleado en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'people_id' => 'required',
            'curp' => 'required|string|min:18|max:18',
            'rfc' => 'required|string|max:13|min:13',
            'nss' => 'required|string|max:11|min:11',
            'admin' => 'required|boolean'
        ]);

        $id_people = $request->people_id;
        $check = Employee::where('id_people', $id_people)->first();

        if ($check) {
            return redirect()->route('employee.create')->with('error', 'La persona ya esta dada de alta en el sistema como empleado.');
        }

        $employee = new Employee();
        $employee->id_people = $validated['people_id'];
        $employee->curp = $validated['curp'];
        $employee->rfc = $validated['rfc'];
        $employee->nss = $validated['nss'];
        $employee->admin = $validated['admin'];
        $employee->save();

        return redirect()->route('employee.create')->with('success', 'Empleado añadido correctamente.');
    }
}
