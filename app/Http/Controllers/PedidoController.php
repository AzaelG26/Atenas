<?php 



namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PedidoController extends Controller
{
  
    public function mostrarHistorial()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }
        
        
        $pedidos = $user->pedidos;

     
        return view('ordershistory', compact('pedidos'));
    }

 
    public function detalle($id)
    {
        
        $pedido = Pedido::find($id);

    
        if (!$pedido) {
            return redirect()->route('historial')->with('error', 'El pedido no existe.');
        }

       
        return view('detalle', compact('pedido'));
    }
}
