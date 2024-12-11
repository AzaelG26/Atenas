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

        $cart = $user->cart;

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'items' => json_encode([]),
            ]);
        }

        $items = json_decode($cart->items, true) ?? [];

        return view('cart.show', compact('items'));
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'items' => json_encode([]),
            ]);
        }

        $items = json_decode($cart->items, true) ?? [];

        $menuId = $request->input('menuId');
        $quantity = (int) $request->input('quantity');
        $price = $request->input('price');
        $name = $request->input('name');

        for ($i = 0; $i < $quantity; $i++) {
            $items[] = [
                'menuId' => $menuId,
                'name' => $name,
                'price' => $price,
            ];
        }

        $cart->items = json_encode($items);
        $cart->save();

        dd($items);

        return response()->json(['message' => 'Producto(s) añadido(s) al carrito']);
    }


    public function updateCart(Request $request)
    {
        $cart = Auth::user()->cart->firstOrCreate(['items' => json_encode([])]);
        $cart->items = json_encode($request->input('cart'));
        $cart->save();

        // Guardar el carrito actualizado en la sesión
        session(['carrito' => $request->input('cart')]);

        return response()->json(['message' => 'Carrito actualizado']);
    }


    // Vaciar el carrito
    public function clearCart(Request $request)
    {
        $request->session()->forget('carrito');

        return response()->json(['success' => true, 'message' => 'El carrito ha sido vaciado.']);
    }
}
