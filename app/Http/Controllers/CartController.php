<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    // Mostrar el contenido del carrito
    public function showCart()
    {
        $user = Auth::user();

        // Obtener el carrito del usuario autenticado
        $cart = $user->cart;

        // Si no existe un carrito, crear uno vacío
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'items' => json_encode([]),
            ]);
        }

        // Decodificar los items del carrito
        $items = json_decode($cart->items, true) ?? [];

        // Pasar la variable $items a la vista
        return view('cart.show', compact('items'));
    }




    // Agregar un producto al carrito
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Si no existe un carrito para el usuario, crearlo
        if (!$cart) {
            $cart = $user->cart->firstOrCreate(['items' => json_encode([])]);
        }

        // Decodificar los items actuales del carrito
        $items = json_decode($cart->items, true) ?? [];

        // Obtener los datos del producto desde la solicitud
        $menuId = $request->input('menuId');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $name = $request->input('name');

        // Crear una nueva entrada para cada unidad añadida
        for ($i = 0; $i < $quantity; $i++) {
            $items[] = [
                'menuId' => $menuId,
                'name' => $name,
                'price' => $price,
                'quantity' => 1, // Siempre 1, porque cada entrada es separada
            ];
        }

        // Guardar los items en el carrito del usuario
        $cart->items = json_encode($items);
        $cart->save();

        // Guardar el carrito actualizado en la sesión (opcional)
        session(['carrito' => $items]);

        return response()->json(['message' => 'Producto(s) añadido(s) al carrito']);
    }


    // Actualizar el carrito
    public function updateCart(Request $request)
    {
        $cart = Auth::user()->cart->firstOrCreate(['items' => json_encode([])]);
        $cart->items = json_encode($request->input('cart'));
        $cart->save();

        // Guardar el carrito actualizado en la sesión
        session(['carrito' => $request->input('cart')]);

        return response()->json(['message' => 'Carrito actualizado']);
    }

    // Eliminar un producto del carrito
    public function removeFromCart(Request $request)
    {
        $cart = Auth::user()->cart;
        if (!$cart) {
            return response()->json(['message' => 'El carrito está vacío'], 400);
        }

        $items = json_decode($cart->items, true);
        $menuId = $request->input('menuId');

        $items = array_filter($items, fn($item) => $item['menuId'] !== $menuId);

        $cart->items = json_encode(array_values($items));
        $cart->save();

        return response()->json(['message' => 'Producto eliminado del carrito']);
    }

    // Vaciar el carrito
    public function clearCart(Request $request)
    {
        // Limpia el carrito en la sesión
        $request->session()->forget('carrito');

        // Devuelve una respuesta indicando éxito
        return response()->json(['success' => true, 'message' => 'El carrito ha sido vaciado.']);
    }
}
