<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{


    
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $mes = $request->get('mes'); // Obtener el mes seleccionado

        // Construir la consulta
        $query = Dispositivo::where(function ($query) use ($busqueda) {
            $query->where('id', 'LIKE', "%{$busqueda}%")
                  ->orWhere('imei', 'LIKE', "%{$busqueda}%")
                  ->orWhere('cuenta', $busqueda)
                  ->orWhere('noeconomico', 'LIKE', "%{$busqueda}%");
        });

        // Si se selecciona un mes, filtramos por el mes en la columna fechacompra
        if ($mes) {
            // Extraemos el mes de la fecha de compra, que está en el formato dd/mm/yyyy
            $query->whereRaw("MONTH(STR_TO_DATE(fechacompra, '%d/%m/%Y')) = ?", [$mes]);
        }

        // Ejecutar la consulta
        $dispositivos = $query->paginate(10);
        $totalDispositivos = $query->count(); // Contar los dispositivos

        return view('dispositivo.index', compact('dispositivos', 'busqueda', 'totalDispositivos'));
    }
    
    /*
    public function index(Request $request)
{
    $busqueda = $request->get('busqueda');
    $query = Dispositivo::where(function ($query) use ($busqueda) {
        $query->where('id', 'LIKE', "%{$busqueda}%")
              ->orWhere('imei', 'LIKE', "%{$busqueda}%")
              ->orWhere('cuenta', $busqueda)
              ->orWhere('noeconomico', 'LIKE', "%{$busqueda}%");
    });

    $dispositivos = $query->paginate(10);
    $totalDispositivos = $query->count(); // Contar los dispositivos

    return view('dispositivo.index', compact('dispositivos', 'busqueda', 'totalDispositivos'));
}*/


    public function creardisp($id)
    {
        return view('dispositivo.createid', compact('id'));
    }

    public function stodis(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        
        $request->validate($this->validationRules($id));

        $datosCliente = array_merge($request->except('_token'), [
            'cliente_id' => $vehiculo->cliente_id,
            'vehiculo_id' => $id
        ]);

        Dispositivo::create(array_map('strtoupper', $datosCliente));

        return redirect()->route('buscar.dispositivo', $id);
    }

    public function edit($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('dispositivo.edit', compact('dispositivo', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules($id));

        $datosDispositivo = $request->except(['_token', '_method']);
        Dispositivo::where('id', $id)->update($datosDispositivo);

        return redirect()->route('buscar.dispositivo', Dispositivo::findOrFail($id)->vehiculo_id);
    }

    public function destroy($id)
    {
        Dispositivo::destroy($id);
        return redirect()->back()->with('mensaje', 'Dispositivo eliminado exitosamente.');
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('dispositivo.create', compact('vehiculos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        Dispositivo::create($request->except('_token'));

        return redirect()->route('dispositivo.index')->with('mensaje', 'Dispositivo agregado exitosamente.');
    }

    private function validationRules($id = null)
{
    return [
        'modelo' => 'required|string|min:2|max:100',
        'noserie' => 'nullable|alpha_dash|min:20|unique:dispositivos,noserie' . ($id ? ",$id" : ''),
        'imei' => 'required|string|min:15|max:20|regex:/^[0-9-]+$/|unique:dispositivos,imei' . ($id ? ",$id" : ''),
        
    ];
}

}
