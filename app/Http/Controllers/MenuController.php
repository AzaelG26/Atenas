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
        // Recupera el carrito desde el request o de la sesión
        $carrito = session('carrito', []);

        if (!is_array($carrito)) {
            return redirect()->back()->withErrors(['error' => 'El formato del carrito no es válido.']);
        }

        // Calcula el total del carrito
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

        // Redirige si no se seleccionó una dirección válida
        if (!$selectedAddress) {
            return redirect()->route('addresses.form')->withErrors(['error' => 'Dirección no válida o no encontrada.']);
        }

        return view('post_carro', compact('carrito', 'total', 'selectedAddress'));
    }

    public function showEditionMenu()
    {
        // Trae las categorías con sus menús y stock
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock');
        }])->get();

        return view('edit_menu', compact('categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Actualización del menú y su stock
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
        // Recupera el carrito desde la sesión
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        // Recupera la dirección seleccionada desde la sesión
        $selectedAddress = session('selectedAddress');

        return view('vista_pago', compact('carrito', 'total', 'selectedAddress'));
    }



    public function procesarPago(Request $request)
{
    $validatedData = $request->validate([
        'card_number' => ['required', 'digits:16'],
        'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
        'cvv' => ['required', 'digits:3'],
        'selectedAddress' => ['required', 'exists:address,id_address'], // Validar que la dirección exista
    ]);

    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect()->route('vista.pago')->withErrors(['error' => 'El carrito está vacío.']);
    }

    $totalPrice = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));
    $selectedAddressId = $request->input('selectedAddress');

    try {
        DB::beginTransaction();

        // Llamar al procedimiento RegisterPaymentAndOrder con la dirección seleccionada
        $paymentAndOrderResult = DB::select('CALL RegisterPaymentAndOrder(?, ?, ?, ?, ?, ?, ?, ?)', [
            1,  // payment_method_id
            $totalPrice,  // payment_amount
            'Completed',  // payment_status
            'Pedido de Comida',  // order_name
            'Orden realizada desde el sitio web.',  // order_notes
            Auth::id(),  // person_id
            $totalPrice,  // total_price
            $selectedAddressId, // Dirección seleccionada
        ]);

        $paymentAndOrderData = collect($paymentAndOrderResult)->first();
        $newOrderId = $paymentAndOrderData->OrderID;

        // Actualizar el estado de la orden a "Paid"
        DB::update('UPDATE online_orders SET status = ? WHERE id_online_order = ?', ['Paid', $newOrderId]);

        // Registrar los detalles de la orden
        foreach ($carrito as $item) {
            DB::select('CALL RegisterOrderDetails(?, ?, ?, ?)', [
                $newOrderId,
                $item['menuId'],
                $item['quantity'] ?? 1,
                $item['specifications'] ?? null,
            ]);
        }

        // Generar folio después de que la orden haya sido pagada
        DB::select('CALL GenerateFolioAfterOrderPaid(?)', [$newOrderId]);

        DB::commit();

        // Vaciar el carrito en la sesión
        session()->forget('carrito');

        return redirect()->route('menu')->with('success', "Pago procesado exitosamente.");
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('vista.pago')->withErrors(['error' => 'Hubo un problema al procesar el pago: ' . $e->getMessage()]);
    }
}

}
