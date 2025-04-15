<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Dispositivo;
use Illuminate\Support\Facades\Storage;

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
    $datosCliente = $request->except('_token');
    $datosCliente['cliente_id'] = $id;

    // Asignar valores por defecto si no se enviaron
    $datosCliente['marca'] = trim($request->marca) ?: 'SIN MARCA';
    $datosCliente['modelo'] = trim($request->modelo) ?: 'SIN MODELO';
    $datosCliente['noserie'] = trim($request->noserie) ?: 'SIN NÚMERO DE SERIE';
    $datosCliente['nomotor'] = trim($request->nomotor) ?: 'SIN NÚMERO DE MOTOR';
    $datosCliente['placa'] = trim($request->placa) ?: 'SIN PLACA';
    $datosCliente['color'] = trim($request->color) ?: 'SIN COLOR';
    $datosCliente['comentarios'] = trim($request->comentarios) ?: 'SIN COMENTARIOS';

    if ($request->hasFile('tarjetacirculacion')) {
        $archivo = $request->file('tarjetacirculacion');
        $ruta = $archivo->store('tarjetas_circulacion', 'public');
        $datosCliente['tarjetacirculacion'] = $ruta;
    }

    $datosClienteSinTarjeta = $datosCliente;
    if (isset($datosCliente['tarjetacirculacion'])) {
        unset($datosClienteSinTarjeta['tarjetacirculacion']);
    }

    $mArray = array_map('strtoupper', $datosClienteSinTarjeta);

    if (isset($datosCliente['tarjetacirculacion'])) {
        $mArray['tarjetacirculacion'] = $datosCliente['tarjetacirculacion'];
    }

    Vehiculo::create($mArray);

    session()->flash('mensaje', 'Vehículo creado exitosamente.');
    return redirect()->route('buscar.vehiculo', $id);
}



    public function store(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        $datosVehiculo = $request->except('_token');
        Vehiculo::insert($datosVehiculo);

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
        $request->validate([
            'marca' => 'required|string|min:2|max:100',
            'modelo' => 'required|string|min:2|max:100',
            'noserie' => 'required|string|min:2|max:100',
            'nomotor' => 'required|string|min:2|max:100',
            'placa' => 'required|string|min:2|max:100',
            'color' => 'nullable|string|max:100',
            'comentarios' => 'nullable|string|max:255',
            'tarjetacirculacion' => 'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
        ]);

        $vehiculo = Vehiculo::findOrFail($id);
        $datosVehiculo = $request->except(['_token', '_method', 'tarjetacirculacion']);

        $this->handleFileUpload($request, $vehiculo, $datosVehiculo, ['tarjetacirculacion']);

        $vehiculo->update($datosVehiculo);

        return redirect()->route('buscar.vehiculo', $vehiculo->cliente_id)->with('mensaje', 'Vehículo actualizado exitosamente');
    }

    protected function handleFileUpload(Request $request, $model, &$datos, $fields)
    {
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                if ($model->{$field}) {
                    Storage::disk('public')->delete($model->{$field});
                }

                $archivo = $request->file($field);
                $ruta = $archivo->store('tarjetas_circulacion', 'public');
                $datos[$field] = $ruta;
            }
        }
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();

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
