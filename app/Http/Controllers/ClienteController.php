<?php
//controller
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

        // Verificar si falta completar perfil
        foreach ($clientes as $cliente) {
            // Verificar si el cliente tiene cuentas asociadas
            $cliente->has_account = $cliente->cuentas()->count() > 0;

            // Marcar como incompleto si el cliente no tiene cuentas asociadas
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
        // La validación se maneja automáticamente por el Request
        // Convertir los datos a mayúsculas
        $datosCliente = array_map('strtoupper', $request->except('_token'));

        // Manejar la carga de archivos
        $this->handleFileUpload($request, null, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'tarjetacirculacion',
            'compPago'
        ]);

        // Crear el cliente
        Cliente::create($datosCliente);

        // Enviar mensaje de sesión
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
            'rfc' => 'nullable|alpha_num|min:2|max:100',
            'actaconstitutiva' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'consFiscal' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'comprDom' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'tarjetacirculacion' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'compPago' => 'mimes:pdf,jpeg,png,jpg|max:5000'
        ]);

        $cliente = Cliente::findOrFail($id);
        $datosCliente = $request->except(['_token', '_method']);

        $this->handleFileUpload($request, $cliente, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'tarjetacirculacion',
            'compPago'
        ]);

        $cliente->update($datosCliente);

        return redirect('cliente')->with('mensaje', 'Cliente editado exitosamente');
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
        // La validación se maneja automáticamente por el Request
        // Convertir los datos a mayúsculas
        $datosCliente = array_map('strtoupper', $request->except('_token'));

        // Manejar la carga de archivos
        $this->handleFileUpload($request, null, $datosCliente, [
            'actaconstitutiva',
            'consFiscal',
            'comprDom',
            'tarjetacirculacion',
            'compPago'
        ]);

        // Crear el cliente y obtener su ID
        $cliente = Cliente::create($datosCliente);

        // Redirigir a la ruta con el cliente ID
        return redirect()->route('crear.nuevo.ref', ['id' => $cliente->id])
            ->with('mensaje', 'Cliente creado exitosamente!');
    }


    public function orden($vehiculo_id, Request $request)
    {
        $vehiculo = Vehiculo::find($vehiculo_id);
        $cliente = Cliente::find($vehiculo->cliente_id);
        $dispositivo = Dispositivo::where('vehiculo_id', $vehiculo->id)->first();
        $linea = Linea::where('dispositivo_id', $dispositivo->id)->first();

        // Guardar la dirección en una variable
        $direccion = $request->direccion;

        // Quitar la letra "T" de la fecha
        $fechacita = str_replace('T', ' ', $request->fechacita);

        $pdf = PDF::loadView('funciones.orden', [
            'vehiculo' => $vehiculo,
            'cliente' => $cliente,
            'dispositivo' => $dispositivo,
            'linea' => $linea,
            'horaactual' => Carbon::now()->toDateString(),
            'fechacita' => $fechacita,
            'direccion' => $direccion, // Pasar la dirección al PDF
        ]);

        return $pdf->download('OrdenDeServicio.pdf');
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
        // Obtener el cliente con sus vehículos relacionados
        $cliente = Cliente::with('vehiculos')->find($clienteId);

        // Verificar si el cliente existe
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Verificar si tiene vehículos asociados
        if ($cliente->vehiculos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron vehículos asociados a este cliente'], 404);
        }

        // Retornar los vehículos como respuesta JSON
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
//comentario para hacer push 
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
