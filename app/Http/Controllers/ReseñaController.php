<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseñaController extends Controller
{
    // Mostrar todas las reseñas
    public function index()
    {
        $reseñas = Reseña::all();
        
        return view('reseñas', compact('reseñas'));
    }

    // Mostrar reseñas en una vista diferente
    public function show()
    {
        $reseñas = Reseña::all();
        return view('showreseñas', compact('reseñas'));
    }

    // Guardar una nueva reseña
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'folio' => 'required|string|max:255', // Asegúrate de que el folio sea único o validado según tu lógica
            'contenido' => 'required|string|max:255', // El contenido de la reseña
            'rating' => 'required|integer|min:1|max:5', // Validación para la calificación (de 1 a 5 estrellas)
        ]);

        // Crear una nueva reseña
        Reseña::create([
            'folio' => $request->folio,       // Folio de la reseña
            'contenido' => $request->contenido, // Contenido del comentario
            'rating' => $request->rating,      // Calificación de estrellas (1 a 5)
            'usuario_id' => auth()->id() ?? null, // ID del usuario autenticado
        ]);

        // Redirigir a la vista de reseñas con mensaje de éxito
        return redirect()->route('showreseñas')->with('success', '¡Gracias por tu reseña!');
        return redirect()->route('showreseñas', ['id' => $reseña->id])
        ->with('success', 'Reseña guardada con éxito!');
    }
}
