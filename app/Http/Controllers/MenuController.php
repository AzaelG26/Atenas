<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Obtenemos todas las categorías con sus platillos relacionados usando 'with'
        $categorias = Category::with('menu')->get();

        // Pasamos las categorías a la vista
        return view('Menu', compact('categorias'));
    }

}
