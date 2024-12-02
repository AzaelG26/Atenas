<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OnlineOrder;

class OrderHistoryController extends Controller
{
    public function index()
    {
        
        
    // Obtener los pedidos
    $pedidos = OnlineOrder::with('people')->get();

    // Mapear los pedidos para agregar una fecha formateada
    $pedidos->map(function($pedido) {
        // Verificar si 'created_at' no es nulo
        if ($pedido->created_at !== null) {
            $pedido->formatted_date = $pedido->created_at->format('d/m/Y H:i');
        } else {
            $pedido->formatted_date = 'Fecha no disponible'; // En caso de que sea nulo
        }
        return $pedido;
    });

   

        // Enviamos la variable $pedidos a la vista
        return view('historial', ['pedidos' => $pedidos]);
    }
}
