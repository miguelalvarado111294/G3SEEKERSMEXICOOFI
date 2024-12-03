<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linea;
use App\Models\Dispositivo;
use App\Models\Cliente;

class LineaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $lineas = Linea::where('simcard', 'LIKE', "%{$busqueda}%")
            ->orWhere('telefono', 'LIKE', "%{$busqueda}%")
            ->paginate(10);

        // Contar el número total de líneas
        $totalLineas = Linea::count();

        return view('linea.index', compact('lineas', 'busqueda', 'totalLineas'));
    }


    public function create()
    {
        $clientes = Cliente::all();
        $dispositivos = Dispositivo::all();

        return view('linea.create', compact('clientes', 'dispositivos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'simcard' => 'required|min:18|max:20',
            'telefono' => 'required|numeric|digits:10',
            'tipolinea' => 'required|alpha|min:2|max:5',
            'renovacion' => 'required|alpha'
        ]);


        Linea::create($request->except('_token'));
        return redirect('linea')->with('mensaje', 'Línea agregada exitosamente.');
    }

    public function crearlinea($id)
    {
        //id es id de dispositivo
        $dispositivoinventario = 1512;
        $lineasinventario = Linea::where('dispositivo_id', $dispositivoinventario)->get();
        return view('linea.createid', compact('id', 'lineasinventario'));
    }




    public function storep(Request $request, $lineaId)
{
    $dispostivo_id = $lineaId;
    $dispositivo = Dispositivo::find($dispostivo_id);
    $cliente_id = $dispositivo->cliente_id;

    if ($request->origen == 'manual') {

        $request->validate([
            'simcard' => 'required|numeric|min:3|max:18',
            'telefono' => 'required|numeric|digits:10',
            'tipolinea' => 'required',
            'renovacion' => 'required|date',
            'comentarios' => 'nullable'
        ]);

        $linea = new Linea();
        $linea->simcard = $request->simcard;
        $linea->telefono = $request->telefono;
        $linea->tipolinea = $request->tipolinea;
        $linea->renovacion = $request->renovacion;
        $linea->comentarios = $request->comentarios;
        $linea->dispositivo_id = $dispostivo_id;
        $linea->cliente_id = $cliente_id;
        $linea->save();

        return redirect()->route('buscar.linea', $linea->dispositivo_id)
            ->with('mensaje', 'Línea creada exitosamente.');
    } else if ($request->origen == 'inventario' && $request->inventario) {
        $linea = Linea::findOrFail($request->inventario);
        $linea->cliente_id = $cliente_id;
        $linea->dispositivo_id = $dispostivo_id;
        $linea->save();

        return redirect()->route('buscar.linea', $linea->dispositivo_id)
            ->with('mensaje', 'Línea actualizada exitosamente.');
    } else {
        return redirect()->back()->with('error', 'Origen no válido o línea no encontrada.');
    }
}



    public function edit($id)
    {
        $linea = Linea::findOrFail($id);
        $clientes = Cliente::all();
        $dispositivos = Dispositivo::all();

        return view('linea.edit', compact('linea', 'clientes', 'dispositivos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'simcard' => 'required|min:18|max:20',
            'telefono' => 'required|numeric|digits:10',
            'tipolinea' => 'required|string', // Acepta espacios
            'renovacion' => 'required|date' // Cambiado a tipo fecha
        ]);

        $datosLinea = $request->except(['_token', '_method']);
        Linea::where('id', $id)->update($datosLinea);

        return redirect()->route('buscar.linea', Linea::findOrFail($id)->dispositivo_id);
    }


    public function destroy($id)
    {
        Linea::destroy($id);
        return redirect()->back()->with('mensaje', 'Línea eliminada exitosamente.');
    }
}
