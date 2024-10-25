<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ProductoController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $results = Cliente::where('nombre', 'LIKE', "%{$query}%")->take(10)->get();

        return response()->json($results);
    }
}
