<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orderController extends Controller
{
    public function history()
    {
        
        $user = auth()->user();

      
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

       
        $pedidos = $user->pedidos()->get();

       
        return view('ordershistory', compact('pedidos'));
    }
}
