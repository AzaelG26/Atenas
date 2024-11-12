<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Imagen;

class ImagenController extends Controller
{
    public function showAddImagesForm()
    {
        // Obtenemos todas las categorías con sus productos y sus imágenes
        $categorias = Category::with('menu.imagenes')->distinct()->get();

        // Pasamos las categorías a la vista "añadir imagenes"
        return view('añadir_imagenes', compact('categorias'));
    }

    public function store(Request $request)
    {
        dd('Entrando a la función store');
       
        $request->validate([
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_id' => 'required|exists:menu,id_menu',
        ]);
    
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('imagenes', 'public');
            dd($filePath);
    
            Imagen::create([
                'file_path' => 'storage/' . $filePath,
                'menu_id' => $request->menu_id,
            ]);
    
            return back()->with('success', 'Imagen subida correctamente');
        } else {
            return back()->withErrors(['file_path' => 'Error al subir la imagen.']);
        }
    }
        
}