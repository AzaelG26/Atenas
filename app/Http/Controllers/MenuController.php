<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Address;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
{
    $categorias = Category::with(['menu' => function ($query) {
        $query->where('status', 1)->with('stock'); // Filtrar menús activos
    }])->get();

    return view('Menu', compact('categorias'));
}

    public function postCarro(Request $request)
    {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        $selectedAddressId = $request->input('selectedAddress');
        $selectedAddress = null;

        if ($selectedAddressId) {
            $selectedAddress = Address::where('id_address', $selectedAddressId)
                ->whereHas('client', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->with(['neighborhood', 'neighborhood.postalCode'])
                ->first();

            if ($selectedAddress) {
                session(['selectedAddress' => $selectedAddressId]);
            } else {
                return redirect()->route('addresses.form')->withErrors(['error' => 'Dirección no válida o no encontrada.']);
            }
        }

        return view('post_carro', compact('carrito', 'total', 'selectedAddress'));
    }


    public function showEditionMenu()
    {
        $categorias = Category::with(['menu' => function ($query) {
            $query->with('stock');
        }, 'menu.stock'])->get();

        $showCategories = Category::get();
        return view('edit_menu', compact(['categorias', 'showCategories']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'nullable|boolean',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->status = $request->has('status') ? true : false;
        $menu->save();

        $menu->stock->stock = $request->input('stock');
        $menu->stock->save();

        return redirect()->route('menu')->with('success', 'Platillo actualizado correctamente');
    }

    public function vistaPago(Request $request)
    {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));

        $selectedAddressId = session('selectedAddress');
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
            return redirect()->route('addresses.form')->withErrors(['error' => 'Por favor seleccione una dirección válida.']);
        }

        return view('vista_pago', compact('carrito', 'total', 'selectedAddress'));
    }

    public function procesarPago(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => ['required', 'digits:16'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'digits:3'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('vista.pago')->withErrors(['error' => 'El carrito está vacío.']);
        }

        $user = auth()->user()->people?->id;

        if ($user) {
            $idClient = $user;
        } else {
            return redirect()->route('addresses')->with('error', 'No se encontró el registro de "people" para el usuario autenticado.');
        }

        $totalPrice = collect($carrito)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 1));
        $selectedAddressId = $request->input('selectedAddress');

        $selectedAddress = Address::where('id_address', $selectedAddressId)
            ->whereHas('client', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['neighborhood', 'neighborhood.postalCode'])
            ->firstOrFail();

        if (!$selectedAddress) {
            return redirect()->route('vista.pago')->withErrors(['error' => 'Dirección no válida o no encontrada.']);
        }

        $receiverName = $request->input('receiver_name');
        $notes = $request->input('notes');
        $specifications = $request->input('specifications');

        try {
            DB::beginTransaction();

            $paymentAndOrderResult = DB::select('CALL RegisterPaymentAndOrder(?, ?, ?, ?, ?, ?, ?, ?)', [
                1,
                $totalPrice,
                'Completed',
                $receiverName,
                $notes,
                $idClient,
                $totalPrice,
                $selectedAddressId,
            ]);

            $paymentAndOrderData = collect($paymentAndOrderResult)->first();
            $newOrderId = $paymentAndOrderData->OrderID;

            DB::update('UPDATE online_orders SET status = ? WHERE id_online_order = ?', ['Paid', $newOrderId]);

            $specifications = $request->input('specifications', []);

            foreach ($carrito as $index => &$item) {
                $item['specifications'] = [];

                if (isset($specifications[$index])) {
                    foreach ($specifications[$index] as $specDetail) {
                        $item['specifications'][] = $specDetail ?? null;
                    }
                }
            }
            unset($item);


            foreach ($carrito as $item) {
                foreach ($item['specifications'] as $specDetail) {
                    DB::select('CALL RegisterOrderDetails(?, ?, ?, ?)', [
                        $newOrderId,
                        $item['menuId'],
                        1,
                        $specDetail,
                    ]);
                }
            }

            DB::select('CALL GenerateFolioAfterOrderPaid(?)', [$newOrderId]);

            $folioId = DB::table('folios')->orderByDesc('created_at')->value('id_folio');

            DB::select('CALL UpdateOrderWithFolio(?)', [$folioId]);

            DB::commit();

            session()->forget('carrito');

            return redirect()->route('menu')->with('success', "Pago procesado exitosamente.");
        } catch (\Exception $e) {
            DB::rollBack();

            if ($e->getCode() === '45000') {
                return redirect()->route('menu')->withErrors(['error' => 'Stock insuficiente para uno de los productos seleccionados.']);
            }

            return redirect()->route('vista.pago')->withErrors(['error' => 'Hubo un problema al procesar el pago: ' . $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'id_category' => 'required',
            'name' => 'required|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|numeric|gt:0', 
            'stock' => 'required|numeric|gte:0' 
        ]);

        $menu = new Menu();
        $menu->name = $validated['name'];
        $menu->description = $validated['description'];
        $menu->price = $validated['price'];
        $menu->status = true;
        $menu->id_category = $validated['id_category'];
        $menu->save();

        $stock = new Stock();
        $stock->stock = $validated['stock'];
        $stock->id_menu = $menu->id_menu;
        $stock->save();

        return redirect()->route('edit.menu')->with('success', 'Se añadió el nuevo platillo');
    }
}
