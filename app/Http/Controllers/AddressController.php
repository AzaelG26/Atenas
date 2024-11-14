<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Category;

class AddressController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->input('term');

        $addresses = Address::with(['neighborhood.postalCode', 'neighborhood.settlementType'])
            ->whereHas('neighborhood', function($query) use ($term) {
                $query->where('name', 'like', "%{$term}%")
                    ->orWhereHas('postalCode', function($query) use ($term) {
                        $query->where('postal_code', 'like', "%{$term}%");
                    })
                    ->orWhereHas('settlementType', function($query) use ($term) {
                        $query->where('settlement_type_name', 'like', "%{$term}%");
                    });
            })
            ->get();

        return response()->json($addresses);
    }

    public function showForm()
    {
        $categorias = Category::all(); 
        return view('form_direcciones', compact('categorias'));
    }
}
