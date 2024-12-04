<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OnlineOrder;

class OrderHistoryController extends Controller
{
    public function index()
    {
        
        

    $pedidos = OnlineOrder::with('people')->get();
      
   
    $pedidos->map(function($pedido) {
      
        if ($pedido->created_at !== null) {
            $pedido->formatted_date = $pedido->created_at->format('d/m/Y H:i');
        } else {
            $pedido->formatted_date = 'Fecha no disponible'; 
        }
        return $pedido;
    });

   

        
        return view('historial', ['pedidos' => $pedidos]);
    }
}
