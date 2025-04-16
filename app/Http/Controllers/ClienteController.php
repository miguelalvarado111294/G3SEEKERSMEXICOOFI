<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Referencia;
use App\Models\Vehiculo;

use App\Models\Cuenta;

use App\Models\Dispositivo;
use App\Models\Linea;
use App\Http\Requests\storecliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        $clientes = Cliente::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('segnombre', 'LIKE', "%{$query}%")
                ->orWhere('apellidopat', 'LIKE', "%{$query}%")
                ->orWhere('apellidomat', 'LIKE', "%{$query}%");
        })->get();

        return response()->json($clientes);
    }

    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $clientes = Cliente::where(function ($queryBuilder) use ($busqueda) {
            $queryBuilder->where('nombre', 'LIKE', "%{$busqueda}%")
                ->orWhere('segnombre', 'LIKE', "%{$busqueda}%")
                ->orWhere('apellidopat', 'LIKE', "%{$busqueda}%")
                ->orWhere('apellidomat', 'LIKE', "%{$busqueda}%")
                ->orWhere('telefono', 'LIKE', "%{$busqueda}%")
                ->orWhere('email', 'LIKE', "%{$busqueda}%")
                ->orWhere('rfc', 'LIKE', "%{$busqueda}%");
        })->orderBy('id', 'desc')->paginate(10);

        foreach ($clientes as $cliente) {
            $cliente->has_account = $cliente->cuentas()->count() > 0;
            $cliente->profile_incomplete = !$cliente->has_account;
        }


        return view('cliente.index', compact('clientes', 'busqueda'));
    }




    public function show($id)
    {
        $cliente = Cliente::find($id);
        $referencias = Referencia::where('cliente_id', $id)->get();

        return view('cliente.show', compact('cliente', 'referencias'));
    }

    public function store(storecliente $request)
    {
        $datosCliente = [];

        foreach ($request->except('_token') as $key => $value) {
            $valor = strtoupper(trim($value));
            $datosCliente[$key] = $valor ?: 'SIN DATOS GUARDADOS';
        }

        $this->handleFileUpload($request, null, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'ine'
        ]);

        Cliente::create($datosCliente);

        return redirect()->route('cliente.index')->with('mensaje', 'Cliente creado exitosamente.');
    }


    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:2|max:100',
            'apellidomat' => 'required|alpha|min:2|max:100',
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required',
            'email' => 'required|string|min:2|max:100|email',
            'rfc' => 'nullable',

            'actaconstitutiva' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'consFiscal' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'comprDom' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'ine'
        ]);

        $cliente = Cliente::findOrFail($id);
        $datosCliente = $request->except(['_token', '_method']);

        $this->handleFileUpload($request, $cliente, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'ine'
        ]);

        $cliente->update($datosCliente);

        return redirect('cliente')->with('mensaje', 'Cliente editado exitosamente');
    }
    public function uploadFilee(Request $request)
    {
        $request->validate([
            'actaconstitutiva' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3072',
            'consFiscal' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3072',
            'comprDom' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3072',
            'tarjetacirculacion' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3072',
            'compPago' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3072',
        ]);

        $fieldName = array_key_first($request->file());
        $file = $request->file($fieldName);

        $path = $file->store('uploads', 'public');

        return response()->json(['message' => 'Archivo subido correctamente', 'path' => $path], 200);
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect('cliente')->with('mensaje', 'Cliente eliminado exitosamente');
    }

    public function crearcliente()
    {
        return view('registroCliente.datoscliente');
    }

    public function buscararchivos($id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.archivos', compact('cliente'));
    }


    public function createnuevo(storecliente $request)
    {
        $datosCliente = array_map('strtoupper', $request->except('_token'));

        $this->handleFileUpload($request, null, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'ine'
        ]);

        $cliente = Cliente::create($datosCliente);

        $vehiculo = Vehiculo::create([
            'cliente_id' => $cliente->id,
            'marca' => 'Desconocida',
            'modelo' => 'Desconocido',
            'placas' => 'NO ASIGNADO',
            'noserie' => 'Desconocido',
            'nomotor' => 'Desconocido',
            'placa' => 'Desconocido',
            'color' => 'Desconocido',
            'tipo' => 'Desconocido'

        ]);

        if ($request->hasFile('tarjetacirculacion')) {
            $archivo = $request->file('tarjetacirculacion');

            $nombreArchivo = uniqid('tc_') . '.' . $archivo->getClientOriginalExtension();

            $ruta = $archivo->storeAs('public/tarjetas_circulacion', $nombreArchivo);

            $vehiculo->update([
                'tarjetacirculacion' => $nombreArchivo
            ]);
        }

        return redirect()->route('crear.nuevo.ref', ['id' => $cliente->id])
            ->with('mensaje', 'Cliente creado exitosamente!');
    }



    public function orden($vehiculo_id, Request $request)
    {
        $vehiculo = Vehiculo::find($vehiculo_id);
        $cliente = Cliente::find($vehiculo->cliente_id);
        $dispositivo = Dispositivo::where('vehiculo_id', $vehiculo->id)->first();
        $linea = Linea::where('dispositivo_id', $dispositivo->id)->first();

        $direccion = $request->direccion;

        $fechacita = str_replace('T', ' ', $request->fechacita);

        $pdf = PDF::loadView('funciones.orden', [
            'vehiculo' => $vehiculo,
            'cliente' => $cliente,
            'dispositivo' => $dispositivo,
            'linea' => $linea,
            'horaactual' => Carbon::now()->toDateString(),
            'fechacita' => $fechacita,
            'direccion' => $direccion,
        ]);

        return $pdf->download('OrdenDeServicio.pdf');
    }

    public function uploadFile(Request $request)
    {
        $field = array_keys($request->all())[1];
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/documentos', $filename);
            return response()->json(['message' => 'Archivo subido correctamente', 'path' => $path]);
        }
        return response()->json(['error' => 'Error al subir el archivo'], 400);
    }


    public function crearcita(Vehiculo $vehiculo)
    {
        return view('funciones.horadecita', ['vehiculo' => $vehiculo]);
    }



    public function ordeninstalacion()
    {
        $clientes = Cliente::all();
        return view('funciones.ordendeinstalacion', compact('clientes'));
    }

    public function obtenerVehiculos($clienteId)
    {
        $cliente = Cliente::with('vehiculos')->find($clienteId);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        if ($cliente->vehiculos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron vehículos asociados a este cliente'], 404);
        }

        return response()->json($cliente->vehiculos);
    }


    public function obtenerDispositivo($vehiculoId)
    {
        return view('funciones.ordendeinstalacion', compact('vehiculoId'));
        $vehiculo = Vehiculo::with('dispositivo')->find($vehiculoId);

        if (!$vehiculo) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }

        if (!$vehiculo->dispositivo) {
            return response()->json(['error' => 'No se encontró un dispositivo asociado a este vehículo'], 404);
        }
        return $vehiculo->dispositivo;
        return response()->json($vehiculo->dispositivo);
    }
    public function ordenins(Request $request)
    {

        $vehiculo_id = $request->get('vehiculo');
        $cliente_id = $request->get('cliente');
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        $cliente = Cliente::find($cliente_id);
        $dispositivo = Dispositivo::where('vehiculo_id', '=', $vehiculo_id)->first();
        $dispositivo_id = $dispositivo->id;
        $linea = Linea::where('dispositivo_id', '=', $dispositivo_id)->first();
        $cuenta = Cuenta::where('cliente_id', '=', $cliente_id)->first();
        $direccion_instalacion = $request->get('direccion_instalacion');
        $fecha_instalacion = str_replace('T', ' ', $request->get('fecha_instalacion'));

        $pdf = PDF::loadView('funciones.ordendinstalacion', [
            'cliente' => $cliente,
            'cuenta' => $cuenta,
            'vehiculo' => $vehiculo,
            'dispositivo' => $dispositivo,
            'direccion_instalacion' => $direccion_instalacion,
            'fecha_instalacion' => $fecha_instalacion,
            'linea' => $linea,
            'request' => $request
        ]);

        return $pdf->download('OrdenDeInstalacion.pdf');
    }

    private function handleFileUpload(Request $request, ?Cliente $cliente, array &$datosCliente, array $archivos)
    {
        foreach ($archivos as $archivo) {
            if ($request->hasFile($archivo)) {
                if ($cliente) {
                    Storage::delete('public/' . $cliente->$archivo);
                }
                $datosCliente[$archivo] = $request->file($archivo)->store('public/clientes');
            }
        }
    }
}
