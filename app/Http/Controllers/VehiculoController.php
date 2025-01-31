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
    /*
    public function createvehiculo(Request $request, $id)
    {
        return $request->tarjetacirculacion;
        $this->validateRequest($request, $id);
        
        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $id;
        $mArray = array_map('strtoupper', $datosCliente);
        Vehiculo::insert($mArray);

        // Agregar mensaje a la sesión
        session()->flash('mensaje', 'Vehículo creado exitosamente.');
        return redirect()->route('buscar.vehiculo', $id);
    }*/

    public function createvehiculo(Request $request, $id)
{
    // Validación de los datos incluyendo la tarjeta de circulación
    $request->validate([
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'noserie' => 'required|string|max:255',
        'nomotor' => 'required|string|max:255',
        'placa' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'comentarios' => 'nullable|string',
        'tarjetacirculacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048' // Máximo 2MB
    ]);

    $datosCliente = $request->except('_token');
    $datosCliente['cliente_id'] = $id;

    // Manejar la subida del archivo
    if ($request->hasFile('tarjetacirculacion')) {
        $archivo = $request->file('tarjetacirculacion');
        $ruta = $archivo->store('tarjetas_circulacion', 'public'); // Guardar en storage/app/public/tarjetas_circulacion
        $datosCliente['tarjetacirculacion'] = $ruta;
    }

    // Excluimos 'tarjetacirculacion' de la conversión a mayúsculas
    $datosClienteSinTarjeta = $datosCliente;
    if (isset($datosCliente['tarjetacirculacion'])) {
        unset($datosClienteSinTarjeta['tarjetacirculacion']);
    }

    // Convertimos a mayúsculas los campos excepto 'tarjetacirculacion'
    $mArray = array_map('strtoupper', $datosClienteSinTarjeta);

    // Reintroducimos 'tarjetacirculacion' sin cambios
    if (isset($datosCliente['tarjetacirculacion'])) {
        $mArray['tarjetacirculacion'] = $datosCliente['tarjetacirculacion'];
    }

    // Crear el vehículo con los datos procesados
    Vehiculo::create($mArray);

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

    /* public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        Vehiculo::where('id', $id)->update($request->except(['_token', '_method']));
        // Agregar mensaje a la sesión
        session()->flash('mensaje', 'Vehículo actualizado exitosamente.');
        return redirect()->route('buscar.vehiculo', Vehiculo::find($id)->cliente_id);
    }*/

    public function update(Request $request, $id)
    {
        // Validación de los datos (puedes personalizar las reglas de validación según sea necesario)
        $request->validate([
            'marca' => 'required|string|min:2|max:100',
            'modelo' => 'required|string|min:2|max:100',
            'noserie' => 'required|string|min:2|max:100',
            'nomotor' => 'required|string|min:2|max:100',
            'placa' => 'required|string|min:2|max:100',
            'color' => 'nullable|string|max:100',
            'comentarios' => 'nullable|string|max:255',
            'tarjetacirculacion' => 'nullable|mimes:jpeg,png,jpg,pdf|max:5000', // Reglas para el archivo
        ]);

        $vehiculo = Vehiculo::findOrFail($id);
        $datosVehiculo = $request->except(['_token', '_method', 'tarjetacirculacion']); // Excluir campos no necesarios

        // Manejar la carga del archivo si existe
        $this->handleFileUpload($request, $vehiculo, $datosVehiculo, ['tarjetacirculacion']);

        // Actualizar los datos del vehículo
        $vehiculo->update($datosVehiculo);

        // Mensaje de éxito
        return redirect()->route('buscar.vehiculo', $vehiculo->cliente_id)->with('mensaje', 'Vehículo actualizado exitosamente');
    }


    protected function handleFileUpload(Request $request, $model, &$datos, $fields)
    {
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                // Eliminar archivo anterior si existe
                if ($model->{$field}) {
                    Storage::disk('public')->delete($model->{$field});
                }

                // Procesar y guardar el nuevo archivo
                $archivo = $request->file($field);
                $ruta = $archivo->store('tarjetas_circulacion', 'public'); // Guardar archivo en la carpeta correspondiente

                // Actualizar el campo del modelo con la nueva ruta del archivo
                $datos[$field] = $ruta;
            }
        }
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
