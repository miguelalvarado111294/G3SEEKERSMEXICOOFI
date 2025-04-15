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
    // Lista de campos requeridos
    $camposRequeridos = ['marca', 'modelo', 'noserie', 'nomotor', 'placa', 'color'];

    // Verificamos si todos los campos requeridos están vacíos
    $sinDatos = collect($camposRequeridos)->every(function ($campo) use ($request) {
        return !$request->filled($campo);
    });

    if ($sinDatos) {
        Vehiculo::create([
            'marca' => 'NO SE INGRESARON DATOS PARA ESTO',
            'modelo' => 'NO SE INGRESARON DATOS PARA ESTO',
            'noserie' => 'NO SE INGRESARON DATOS PARA ESTO',
            'nomotor' => 'NO SE INGRESARON DATOS PARA ESTO',
            'placa' => 'NO SE INGRESARON DATOS PARA ESTO',
            'color' => 'NO SE INGRESARON DATOS PARA ESTO',
            'comentarios' => 'NO SE INGRESARON DATOS PARA ESTO',
            'cliente_id' => $id
        ]);

        session()->flash('mensaje', 'Vehículo creado sin datos.');
        return redirect()->route('buscar.vehiculo', $id);
    }

    // Validación normal
    $request->validate([
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'noserie' => 'required|string|max:255',
        'nomotor' => 'required|string|max:255',
        'placa' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'comentarios' => 'nullable|string',
        'tarjetacirculacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $datosCliente = $request->except('_token');
    $datosCliente['cliente_id'] = $id;

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
