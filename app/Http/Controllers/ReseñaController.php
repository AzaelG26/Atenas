<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use Illuminate\Http\Request;

class ReseñaController extends Controller
{
    public function index()
    {
        $reseñas = Reseña::all();  // O el código necesario para obtener las reseñas
        return view('reseñas', compact('reseñas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

        Reseña::create([
            'contenido' => $request->contenido,
            // Otros campos que necesites
        ]);

        return redirect()->route('reseñas.index');
    }
}
