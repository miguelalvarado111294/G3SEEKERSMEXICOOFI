<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Referencia;
use App\Models\Vehiculo;
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
        })->orderBy('id', 'desc') // Ordena por ID de manera descendente
            ->paginate(10);

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

        $pdf = PDF::loadView('funciones.orden', [
            'vehiculo' => $vehiculo,
            'cliente' => $cliente,
            'dispositivo' => $dispositivo,
            'linea' => $linea,
            'horaactual' => Carbon::now()->toDateString(),
            'fechacita' => $request->fechacita,
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

    public function ordenins(Request $request)
    {
        $cliente = Cliente::find($request->get('cliente'));
        $pdf = PDF::loadView('funciones.ordendinstalacion', [
            'cliente' => $cliente,
            'horaactual' => Carbon::now()->toDateString(),
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
