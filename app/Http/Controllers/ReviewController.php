<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
   
    public function index()
{
    $reseñas = Review::all(); 
    
    return view('welcome', compact('reseñas')); 
}

   
    public function show($id)
    {
     
        $review = Review::findOrFail($id); 

      
        return view('showreview', compact('review')); 
    }

   
    public function store(Request $request)
    {
        
        $request->validate([
            'folio' => 'required|string|max:255',
            'contenido' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

       
        $review = Review::create([
            'folio' => $request->folio,
            'contenido' => $request->contenido,
            'rating' => $request->rating,
            'usuario_id' => auth()->id(),
        ]);

       
        return redirect()->route('showreview', ['id' => $review->id])
            ->with('success', '¡Gracias por tu review!');
    }
}
