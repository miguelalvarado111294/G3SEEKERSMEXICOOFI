<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Dispositivo;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');

        $vehiculos = Vehiculo::where('noserie', 'LIKE', "%{$busqueda}%")
            ->orWhere('nomotor', 'LIKE', "%{$busqueda}%")
            ->orWhere('placa', 'LIKE', "%{$busqueda}%")
            ->paginate(10);

        return view('vehiculo.index', compact('vehiculos', 'busqueda'));
    }

    public function create()
    {
        return view('vehiculo.create', [
            'clientes' => Cliente::all(),
            'dispositivos' => Dispositivo::all(),
            'cuentas' => Cuenta::all(),
        ]);
    }

    public function crearvehi($id)
    {
        return view('registroCliente.datosvehiculo', compact('id'));
    }

    public function createvehiculo(Request $request, $id)
    {
        $this->validateVehiculo($request, $id);

        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $id;
        $datosCliente = array_map('strtoupper', $datosCliente);

        Vehiculo::create($datosCliente);

        return redirect()->route('buscar.vehiculo', $id);
    }

    public function store(Request $request, $id)
    {
        $this->validateVehiculo($request, $id);

        $datosVehiculo = $request->except('_token');
        Vehiculo::create($datosVehiculo);

        return redirect('vehiculo')->with('mensaje', 'Vehículo agregado exitosamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculo.edit', [
            'vehiculo' => $vehiculo,
            'clientes' => Cliente::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validateVehiculo($request, $id);

        Vehiculo::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect()->route('buscar.vehiculo', $id);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();

        return redirect()->route('buscar.vehiculo', $vehiculo->cliente_id);
    }

    private function validateVehiculo(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required|alpha_dash|min:3|max:100',
            'modelo' => 'required|alpha_num|alpha_dash',
            'noserie' => 'required|alpha_dash|min:5|unique:vehiculos,noserie,' . $id,
            'nomotor' => 'required|alpha_dash|min:5|unique:vehiculos,nomotor,' . $id,
            'placa' => 'required|alpha_dash|min:4|unique:vehiculos,placa,' . $id,
            'color' => 'string|min:4|max:15|nullable',
        ]);
    }
}
