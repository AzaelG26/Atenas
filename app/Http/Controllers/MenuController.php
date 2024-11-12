<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Obtenemos todas las categorías con sus platillos y el stock relacionado
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock'); // Incluimos la relación con el stock
        }])->get();

        // Pasamos las categorías a la vista
        return view('Menu', compact('categorias'));
    }


}
