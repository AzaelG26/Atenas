<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Producto;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_id' => 'required|exists:menu,id',
        ]);

        $filePath = $request->file('file_path')->store('public/imagenes');
        
        Imagen::create([
            'file_path' => $filePath,
            'menu_id' => $request->menu_id,
        ]);

        return back()->with('success', 'Imagen subida correctamente');
    }
}