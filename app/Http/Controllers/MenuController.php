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
        
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock');
        }])->get();

        return view('Menu', compact('categorias'));
    }

    public function postCarro(Request $request)
    {
        // con esto recuperamos el carrito desde la sesion
        $carrito = session('carrito', []);

        if (!is_array($carrito)) {
            return redirect()->back()->withErrors(['error' => 'El formato del carrito no es válido.']);
        }

        // con esto calculamos el total del carro
        $total = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        // Recupera la dirección seleccionada
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
        // con esto traemos las categorias con su stock correspondiente 
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

        // aqui se actualiza el menu y el stock
        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->save();

        $menu->stock->stock = $request->input('stock');
        $menu->stock->save();

        return redirect()->route('menu')->with('success', 'Platillo actualizado correctamente');
    }

    public function vistaPago(Request $request)
    {
        //recuperamos el carrito desde la misma sesion
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        //aqui vamos a recuperar la direccion seleccionada por el mono desde la sesion
        $selectedAddress = session('selectedAddress');

        return view('vista_pago', compact('carrito', 'total', 'selectedAddress'));
    }



    public function procesarPago(Request $request)
{
    $validatedData = $request->validate([
        'card_number' => ['required', 'digits:16'],
        'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
        'cvv' => ['required', 'digits:3'],
        'selectedAddress' => ['required', 'exists:address,id_address'], 
    ]);

    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect()->route('vista.pago')->withErrors(['error' => 'El carrito está vacío.']);
    }

    $totalPrice = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));
    $selectedAddressId = $request->input('selectedAddress');

    try {
        DB::beginTransaction();

        $paymentAndOrderResult = DB::select('CALL RegisterPaymentAndOrder(?, ?, ?, ?, ?, ?, ?, ?)', [
            1,  
            $totalPrice,  
            'Completed',  
            'Pedido de Comida',  
            'Orden realizada desde el sitio web.',  
            Auth::id(),  // esto es para recuperar el id de la persona
            $totalPrice,  
            $selectedAddressId, 
        ]);

        $paymentAndOrderData = collect($paymentAndOrderResult)->first();
        $newOrderId = $paymentAndOrderData->OrderID;

        DB::update('UPDATE online_orders SET status = ? WHERE id_online_order = ?', ['Paid', $newOrderId]);

        // registramos los detalles de la orden
        foreach ($carrito as $item) {
            DB::select('CALL RegisterOrderDetails(?, ?, ?, ?)', [
                $newOrderId,
                $item['menuId'],
                $item['quantity'] ?? 1,
                $item['specifications'] ?? null,
            ]);
        }

        // con este procedimiento se hace el folio de la orden 
        DB::select('CALL GenerateFolioAfterOrderPaid(?)', [$newOrderId]);

        DB::commit();

        // con esto se vacia el carro de la sesion
        session()->forget('carrito');

        return redirect()->route('menu')->with('success', "Pago procesado exitosamente.");
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('vista.pago')->withErrors(['error' => 'Hubo un problema al procesar el pago: ' . $e->getMessage()]);
    }
}

}
