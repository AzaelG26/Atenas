<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        //con esta variable, practicamente traemos a todas las categorias y el stock relacionado con el platillo del menu
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock'); // Incluimos la relación con el stock
        }])->get();

        return view('Menu', compact('categorias'));
    }

    public function showPostCarro()
    {
        //esta funcion la necesito para que se muestre la vista de post_carro, pero se le tiene que pasar la variable y el modelo de las categorias porque
        //sino manda el errorsote por el layout.g_base xd
        $categorias = Category::all(); 
        return view('post_carro', compact('categorias')); 
    }


    public function postCarro(Request $request)
    {
        //aqui hacemos lo mismo para lo de las categorias, para que no nos mande el error, con la diferencia de que 
        //vamos a pasar todos los productos que tenemos en el arreglo del carrito, para la vista de post_carro
        //es para ello que utilizamos toda esta funcion
        $categorias = Category::all();
        $carrito = json_decode($request->input('cart', '[]'), true);

        if (!is_array($carrito)) {
            return redirect()->back()->withErrors(['error' => 'El formato del carrito no es válido.']);
        }

        // calculamos el total de todo el carrito
        $total = collect($carrito)->sum(fn($item) => $item['price'] ?? 0);

        // pasamos como tal el carrito, el total, y de ahuevo las categorias para que no nos mande el error ya antes mencionado
        return view('post_carro', compact('carrito', 'total', 'categorias'));
    }

}