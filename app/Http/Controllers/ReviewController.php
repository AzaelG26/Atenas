<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use App\Models\Menu;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Para el menu del welcome
    // public function getAllMenu()
    // {
    //     return view('welcome', compact('menu'));
    // }

    public function index()
    {
        $menu = Menu::where('status', 1)->get(); 

        $reseñas = Review::all();

        return view('welcome', compact(['reseñas', 'menu']));
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

        $folio = Folio::where('identifier', $request->folio)->exists();

        if ($folio == false) {
            return redirect()->route('welcome')->with('error', 'El folio ingresado es inválido');
        }

        $review = Review::create([
            'folio' => $request->folio,
            'contenido' => $request->contenido,
            'rating' => $request->rating,
        ]);


        return redirect()->route('welcome', ['id' => $review->id])
            ->with('success', '¡Gracias por tu review!');
    }
}
