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

        return view('linea.index', compact('lineas', 'busqueda'));
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
        return view('linea.createid', ['id' => $id]);
    }

    public function storep(Request $request, $dispositivoid)
{
    // Asegúrate de que el dispositivo existe
    $dispositivo = Dispositivo::findOrFail($dispositivoid);

    // Validación de los datos de entrada
    $request->validate([
        'simcard' => 'required|alpha_dash|min:3|max:18',
        'telefono' => 'required|numeric|digits:10',
        'comentarios' => 'nullable|alpha|min:10|max:100'
    ]);

    // Prepara los datos para la creación de la línea
    $datosLinea = [
        'simcard' => strtoupper($request->simcard),
        'telefono' => $request->telefono,
        'tipolinea' => $request->tipolinea, // Asegúrate de incluir esto
        'renovacion' => $request->renovacion,
        'comentarios' => $request->comentarios,
        'cliente_id' => $dispositivo->cliente_id,
        'dispositivo_id' => $dispositivo->id
    ];
    // Crea la línea
    Linea::create($datosLinea);

    // Redirecciona al usuario a la vista de búsqueda de líneas
    return redirect()->route('buscar.linea', $dispositivoid);
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
