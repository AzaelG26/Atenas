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

    // public function buscarPersona(Request $request)
    // {
    //     $busqueda = $request->query('query');

    //     $resultadosPersonas = People::where('name', 'LIKE', "%{$busqueda}%")
    //         ->orWhere('paternal_lastname', 'LIKE', "%{$busqueda}%")
    //         ->orWhere('maternal_lastname', 'LIKE', "%{$busqueda}%")
    //         ->get();
    //     $resultadosUsuarios = User::where('name', 'LIKE', "%{$busqueda}%")
    //         ->orWhere('email', 'LIKE', "%{$busqueda}%")
    //         ->get();

    //     $resultados = [
    //         'personas' => $resultadosPersonas,
    //         'usuarios' => $resultadosUsuarios,
    //     ];

    //     return response()->json($resultados); // Devolver los resultados en JSON
    // }


    // public function storeOrUpdateEmployeeData(Request $request)
    // {
    //     $user_id = $request->input('user_id');

    //     $people = People::where('user_id', $user_id)->first();

    //     if ($people) {
    //         // Actualizar solo los datos de empleado si la persona ya existe
    //         $people->rfc = $employeeData['rfc'];
    //         $people->save();

    //         return redirect()->route('employee.create')->with('success', 'Registro de empleado con éxito');
    //     } else {
    //         $validatedPersonalData = $request->validate([
    //             'name' => 'required|string|max:90',
    //             'maternal_lastname' => 'required|string|max:50',
    //             'paternal_lastname' => 'required|string|max:50',
    //             'gender' => 'required|in:Male,Female,Other',
    //             'cellphone_number' => 'required|string|max:20|min:10',
    //             'birthdate' => 'required|date|before:today',
    //         ]);

    //         // Crear el nuevo registro con datos personales y de empleado
    //         $people = new People();
    //         $people->fill($validatedPersonalData); // Asignar datos personales
    //         $people->user_id = $user_id;
    //         $people->rfc = $employeeData['rfc']; // Asignar datos de empleado
    //         $people->save();

    //         return redirect()->route('employee.create')->with('success', 'Registro empleado y datos personales con éxito');
    //     }
    // }




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
        $user_id = Auth::user()->id;

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $people = People::where('user_id', $user_id)->first();
        if (!$people) {
            return redirect()->route('formPersonalData')->with('success', 'Primero ingresa tus datos personales');
        }

        return view('infoPersonalData', compact('people'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::User()->id;
        $check = People::where('user_id', $user_id)->first();

        if ($check) {
            return redirect()->route('personas.create')->with('error', 'Ya existe un registro de tus datos personales.');
        }

        if (strlen($request->cellphone_number) < 10) {
            return redirect()->route('personas.create')->with('error', 'Ingresa 10 dígitos en tu número de teléfono.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:90',
            'maternal_lastname' => 'required|string|max:50',
            'paternal_lastname' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'cellphone_number' => 'required|string|max:20|min:10',
            'birthdate' => 'required|date|before:today',
        ]);

        $birthdate = $request->birthdate;
        $edad = \Carbon\Carbon::parse($birthdate)->age;

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
        $people->user_id = $user_id; // Asegúrate de que `$userId` esté definido
        $people->save();

        return redirect()->route('personas.create')->with('success', 'Se agregaron tus datos con éxito');
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
        $user_id = Auth::user()->id;

        if (strlen($request->cellphone_number) < 10) {
            return redirect()->route('personas.create')->with('error', 'Ingresa 10 dígitos en tu número de teléfono.');
        }
        $validated = $request->validate([
            'name' => 'nullable|string|max:90',
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
        $edad = \Carbon\Carbon::parse($birthdate)->age;

        if ($edad < 18) {
            return redirect()->route('formPersonalData')->with('error', 'Debes ser mayor de edad para registrarte.');
        }



        // Actualizar los datos de persona
        $people->name = $request->input('name');
        $people->maternal_lastname = $request->input('maternal_lastname');
        $people->paternal_lastname = $request->input('paternal_lastname');
        $people->gender = $request->input('gender');
        $people->cellphone_number = $request->input('cellphone_number');
        $people->birthdate = $request->input('birthdate');
        $people->save();

        return redirect()->route('personas.create')->with('success', 'Datos actualizados correctamente.');
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
