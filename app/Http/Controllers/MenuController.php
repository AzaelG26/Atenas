<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        //con esta variable, practicamente traemos a todas las categorias y el stock relacionado con el platillo del menu
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock'); 
        }])->get();

        return view('Menu', compact('categorias'));
    }
    
    public function postCarro(Request $request)
    {
        $carrito = json_decode($request->input('cart', '[]'), true);
    
        if (!is_array($carrito)) {
            return redirect()->back()->withErrors(['error' => 'El formato del carrito no es válido.']);
        }
    
        $total = collect($carrito)->sum(fn($item) => $item['price'] ?? 0);
    
        $selectedAddressId = $request->input('selectedAddress'); 
        
        $selectedAddress = null;
    
        if ($selectedAddressId) {
            $selectedAddress = Address::where('id_address', $selectedAddressId)
                ->whereHas('client', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->with(['neighborhood', 'neighborhood.postalCode'])
                ->first();
        }
    
        if (!$selectedAddress) {
            return redirect()->route('addresses.form')->withErrors(['error' => 'Dirección no válida o no encontrada.']);
        }
    
        return view('post_carro', compact('carrito', 'total', 'selectedAddress'));
    }
    
    public function showEditionMenu()
    {
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock'); 
        }])->get();


        return view('edit_menu', compact('categorias'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->name = $request->input('name');
        $menu->save();

        $menu->stock->stock = $request->input('stock');
        $menu->stock->save(); 

        return redirect()->route('menu')->with('success', 'Platillo actualizado correctamente');
    }

    public function vistaPago(Request $request)
    {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => $item['price'] ?? 0);

        $selectedAddress = session('selectedAddress');

        return view('vista_pago', compact('carrito', 'total', 'selectedAddress'));
    }



    public function procesarPago(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => ['required', 'digits:16'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'digits:3'],
        ]);

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('vista.pago')->withErrors(['error' => 'El carrito está vacío.']);
        }

        $totalPrice = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        try {
            DB::beginTransaction();

            $paymentAndOrderResult = DB::select('CALL RegisterPaymentAndOrder(?, ?, ?, ?, ?, ?, ?)', [
                1, 
                $totalPrice,
                'Completed', 
                'Pedido de Comida', 
                'Orden realizada desde el sitio web.', 
                Auth::id(), 
                $totalPrice, 
            ]);

            $paymentAndOrderData = collect($paymentAndOrderResult)->first();
            $newOrderId = $paymentAndOrderData->OrderID;

            foreach ($carrito as $item) {
                DB::select('CALL AddOrderDetail(?, ?, ?, ?)', [
                    $newOrderId,
                    $item['menuId'],
                    $item['quantity'] ?? 1,
                    $item['specifications'] ?? null,
                ]);
            }

            DB::commit();

            session()->forget('carrito');

            return redirect()->route('menu')->with('success', "Pago procesado exitosamente. Folio: {$paymentAndOrderData->FolioIdentifier}");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('vista.pago')->withErrors(['error' => 'Hubo un problema al procesar el pago: ' . $e->getMessage()]);
        }
    }

}
