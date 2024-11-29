<?php 
namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    // Método para mostrar el historial de pedidos
    public function mostrarHistorial()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Obtener los pedidos del usuario autenticado
        $pedidos = $user->pedidos; // Asegúrate de tener la relación 'pedidos' en el modelo User
        
        // Retornar la vista con los pedidos
        return view('historial', compact('pedidos'));
    }

    // Método para mostrar los detalles de un pedido específico
    public function mostrarDetalle($id)
    {
        // Buscar el pedido con el ID proporcionado
        $pedido = Pedido::find($id);

        // Si no se encuentra el pedido, redirigir con un mensaje de error
        if (!$pedido) {
            return redirect()->route('historial')->with('error', 'El pedido no existe.');
        }

        // Retornar la vista con los detalles del pedido
        return view('detalle', compact('pedido'));
    }
}
