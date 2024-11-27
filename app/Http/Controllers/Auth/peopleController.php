<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\People;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    public function formularioPersonas()
    {
        return view('formPersonalData');
    }

    public function create()
    {
        $user_id = Auth::user()->id;

        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Buscar si ya existe un registro de datos personales para el usuario
        $people = People::where('user_id', $user_id)->first();
        if (!$people) {
            // Si no existe, redirigir con un mensaje de éxito indicando que ingrese los datos
            return redirect()->route('formPersonalData')->with('success', 'Primero ingresa tus datos personales');
        }

        // Si existe, mostrar la vista con los datos
        return view('infoPersonalData', compact('people'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::User()->id;

      
        $check = People::where('user_id', $user_id)->first();
        if ($check) {
        
            return redirect()->route('personas.create')->with('error', 'Ya existe un registro de tus datos personales.');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:4|max:90',
            'maternal_lastname' => 'required|string|max:50',
            'paternal_lastname' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'cellphone_number' => 'required|string|max:20|min:10',
            'birthdate' => 'required|date|before:today',
        ]);

        $birthdate = $request->birthdate;
        $edad = Carbon::parse($birthdate)->age;

        if ($edad < 18) {
            return redirect()->route('formPersonalData')->with('error', 'Debes ser mayor de edad para registrarte.');
        }

      
        $people = new People();
        $people->name = $request->input('name');
        $people->maternal_lastname = $request->input('maternal_lastname');
        $people->paternal_lastname = $request->input('paternal_lastname');
        $people->gender = $request->input('gender');
        $people->cellphone_number = $request->input('cellphone_number');
        $people->birthdate = $request->input('birthdate');
        $people->user_id = $user_id;
        $people->save();

    
        return redirect()->route('personas.create')->with('success', 'Se agregaron tus datos con éxito');
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $validated = $request->validate([
            'name' => 'nullable|string|min:4|max:90',
            'maternal_lastname' => 'nullable|string|max:50',
            'paternal_lastname' => 'nullable|string|max:50',
            'gender' => 'nullable|in:male,female,other',
            'cellphone_number' => 'nullable|string|max:20|min:10',
            'birthdate' => 'nullable|date|before:today',
        ]);

        $people = People::where('user_id', $user_id)->where('id', $id)->first();
        if (!$people) {
            
            return redirect()->route('personas.create')->with('error', 'No se encontró la persona.');
        }

        $birthdate = $request->birthdate;
        if ($birthdate) {
            $edad = Carbon::parse($birthdate)->age;

            if ($edad < 18) {
                return redirect()->route('formPersonalData')->with('error', 'Debes ser mayor de edad para registrarte.');
            }
        }



        $people->name = $request->input('name');
        $people->maternal_lastname = $request->input('maternal_lastname');
        $people->paternal_lastname = $request->input('paternal_lastname');
        $people->gender = $request->input('gender');
        $people->cellphone_number = $request->input('cellphone_number');
        $people->birthdate = $request->input('birthdate');
        $people->save();

     
        return redirect()->route('personas.create')->with('success', 'Datos actualizados correctamente.');
    }
}
