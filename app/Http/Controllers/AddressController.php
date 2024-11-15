<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Neighborhood;
use App\Models\PostalCode;
use App\Models\Category;

class AddressController extends Controller
{
    public function showForm()
    {
        $categorias = Category::all(); 
        $postalCodes = PostalCode::with('neighborhoods')->get()->toArray();
        return view('form_direcciones', compact('postalCodes', 'categorias'));
    }

    public function buscarDirecciones(Request $request)
    {
        try {
            $query = $request->input('query');
            
            $resultados = Neighborhood::where('name', 'like', "%$query%")
                            ->orWhereHas('postalCode', function($q) use ($query) {
                                $q->where('postal_code', 'like', "%$query%");
                            })
                            ->with('postalCode')
                            ->get()
                            ->map(function($neighborhood) {
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
        $idClient = $request->input('id_client');
        $idNeighborhood = $request->input('id_neighborhood');
        $street = $request->input('street');
        $reference = $request->input('reference');
        $interiorNumber = $request->input('interior_number');
        $outerNumber = $request->input('outer_number');

        try {
            $idAddress = null;
            DB::statement('CALL register_address(?, ?, ?, ?, ?, ?, @id_address)', [
                $idClient,
                $idNeighborhood,
                $street,
                $reference,
                $interiorNumber,
                $outerNumber
            ]);

            $result = DB::select('SELECT @id_address AS id_address');
            $idAddress = $result[0]->id_address;

            return redirect()->route('addresses.form')->with('success', 'Dirección registrada con éxito.');

        } catch (\Exception $e) {
            return redirect()->route('addresses.form')->with('error', 'Error al registrar la dirección: ' . $e->getMessage());
        }
    }

}
