<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Neighborhood;
use App\Models\PostalCode;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function showForm(Request $request)
    {
        $user = Auth::user();
        $addresses = Address::whereHas('client', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['neighborhood', 'neighborhood.postalCode'])->get();

        $categorias = Category::all();
        $postalCodes = PostalCode::with('neighborhoods')->get();

        $carrito = session('carrito', json_decode($request->input('cart', '[]'), true));
        $total = session('total', collect($carrito)->sum(fn($item) => $item['price'] ?? 0));

        session(['carrito' => $carrito, 'total' => $total]);

        $showAddForm = $addresses->isEmpty();

        return view('form_direcciones', compact('postalCodes', 'categorias', 'addresses', 'carrito', 'total', 'showAddForm'));
    }





    public function userAddresses()
    {
        try {
            $user = Auth::user();

            $addresses = Address::whereHas('client', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['neighborhood', 'neighborhood.postalCode'])->get();

            return view('user_addresses', compact('addresses'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar las direcciones: ' . $e->getMessage());
        }
    }


    public function buscarDirecciones(Request $request)
    {
        try {
            $query = $request->input('query');

            $resultados = Neighborhood::where('name', 'like', "%$query%")
                ->orWhereHas('postalCode', function ($q) use ($query) {
                    $q->where('postal_code', 'like', "%$query%");
                })
                ->with('postalCode')
                ->get()
                ->map(function ($neighborhood) {
                    return [
                        'id' => $neighborhood->id,
                        'postal_code' => $neighborhood->postalCode->postal_code,
                        'neighborhood' => $neighborhood->name,
                    ];
                });

            return response()->json(['resultados' => $resultados]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function registerAddress(Request $request)
{
    $validatedData = $request->validate([
        'id_neighborhood' => 'required',
        'street' => 'required|string',
        'outer_number' => 'required|string|max:6',
        'reference' => 'required|string',
        'interior_number' => 'nullable|string|max:6',
    ], [
        'id_neighborhood.required' => 'Te falta seleccionar un vecindario.',
        'street.required' => 'Es obligatorio que escribas las calles donde quieres que se entregue tu pedido.',
        'outer_number.required' => 'Es obligatorio escribir el numero exterrior de tu estancia.',
        'outer_number.max' => 'El número exterior no puede tener más de 6 caracteres.',
        'reference.required' => 'Para nosotros es importante que coloques una referencia de donde quieres que se realice tu pedido.',
    ]);

    $user = auth()->user()->people?->id;

    if ($user) {
        $idClient = $user;
    } else {
        return redirect()->route('addresses')->with('error', 'No se logró realizar el registro porque no se tienen datos de persona.');
    }

    try {
        DB::statement('CALL register_address(?, ?, ?, ?, ?, ?, @id_address)', [
            $idClient,
            $validatedData['id_neighborhood'],
            $validatedData['street'],
            $validatedData['reference'],
            $validatedData['interior_number'],
            $validatedData['outer_number']
        ]);

        $result = DB::select('SELECT @id_address AS id_address');

        return redirect()->route('addresses.form')
            ->with('success', 'Dirección registrada exitosamente.');

    } catch (\Exception $e) {
        return redirect()->route('addresses.form')->with('error', 'Error al registrar la dirección: ' . $e->getMessage());
    }
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
            $selectedAddress = Address::where('id', $selectedAddressId)
                ->whereHas('client', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->with(['neighborhood', 'neighborhood.postalCode'])
                ->first();
        }

        if (!$selectedAddress) {
            return redirect()->route('addresses')->withErrors(['error' => 'Dirección no válida o no encontrada.']);
        }

        return view('post_carro', compact('carrito', 'total', 'selectedAddress'));
    }


    public function seleccionarDireccion(Request $request)
    {
        $direccionId = $request->input('selectedAddress');

        $direccion = Address::where('id', $direccionId)
            ->whereHas('client', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['neighborhood', 'neighborhood.postalCode'])
            ->first();

        if (!$direccion) {
            return redirect()->back()->withErrors(['error' => 'Dirección no válida o no encontrada.']);
        }

        session(['selectedAddress' => $direccion]);

        if (!session()->has('carrito')) {
            session(['carrito' => []]); 
        }

        return redirect()->route('post_carro')->with('success', 'Dirección seleccionada correctamente.');
    }
}
