<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseñaController extends Controller
{
    
    public function index()
    {
        $reseñas = Reseña::all();
        return view('reseñas', compact('reseñas'));
    }
    
   
    public function show()
    {
        $reseñas = Reseña::all();
        return view('showreseñas', compact('reseñas'));
    }


    public function store(Request $request)
    {
      
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

       
        Reseña::create([
            'contenido' => $request->contenido,
            'usuario_id' => Auth::id(), 
        ]);

        
        session()->flash('success', 'Reseña enviada con éxito');

        
        return redirect()->route('reseñas');
    }
}
