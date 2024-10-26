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

        $vehiculos = Vehiculo::where('noserie', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('nomotor', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('placa', 'LIKE', '%' . $busqueda . '%')
            ->paginate(10);

        return view('vehiculo.index', compact('vehiculos', 'busqueda'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $dispositivo = Dispositivo::all();
        $cuentas = Cuenta::all();
        return view('vehiculo.create', compact('clientes', 'dispositivo', 'cuentas'));
    }

    public function crearvehi($id)
    {
        $cuentas = Cuenta::all();
        return view('vehiculo.createid', compact('id', 'cuentas'));
    }

    public function crearvehiculo($id)
    {
        return view('registroCliente.datosvehiculo', compact('id'));
    }

    public function createvehiculo(Request $request, $id)
    {
        $this->validateRequest($request, $id);
        
        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $id;
        $mArray = array_map('strtoupper', $datosCliente);
        Vehiculo::insert($mArray);

        // Agregar mensaje a la sesión
        session()->flash('mensaje', 'Vehículo creado exitosamente.');
        return redirect()->route('buscar.vehiculo', $id);
    }

    public function store(Request $request, $id)
    {
        $this->validateRequest($request, $id);
        
        $datosVehiculo = $request->except('_token');
        Vehiculo::insert($datosVehiculo);
        
        // Agregar mensaje a la sesión
        return redirect('vehiculo')->with('mensaje', 'Vehículo agregado exitosamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $clientes = Cliente::all();
        return view('vehiculo.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        Vehiculo::where('id', $id)->update($request->except(['_token', '_method']));
        // Agregar mensaje a la sesión
        session()->flash('mensaje', 'Vehículo actualizado exitosamente.');
        return redirect()->route('buscar.vehiculo', Vehiculo::find($id)->cliente_id);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();
        
        // Agregar mensaje a la sesión
        session()->flash('mensaje', 'Vehículo eliminado exitosamente.');
        return redirect()->route('buscar.vehiculo', $vehiculo->cliente_id);
    }

    private function validateRequest(Request $request, $id)
    {
        return $request->validate([
            'marca' => 'required|alpha_dash|min:3|max:100',
            'modelo' => 'required|alpha_num|alpha_dash',
            'noserie' => 'required|alpha_dash|min:5|unique:vehiculos,noserie,' . $id,
            'nomotor' => 'required|alpha_dash|min:5|unique:vehiculos,nomotor,' . $id,
            'placa' => 'required|alpha_dash|min:4|unique:vehiculos,placa,' . $id,
            'color' => 'string|min:4|max:15'
        ]);
    }
}
