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
use Dompdf\Dompdf;
use Barryvdh\DomPDF\facade\Pdf;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $request)
    {
        //recibe del input de index cliente y lo almacena en una variable 
        $busqueda = $request->get('busqueda');
        //recuperar todos los clientes
        $clientes = Cliente::where('nombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('segnombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('apellidopat', 'LIKE', '%' . $busqueda . '%')                         //busqueda 
            ->orWhere('apellidomat', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('telefono', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('email', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('rfc', 'LIKE', '%' . $busqueda . '%')->paginate(10);

        return view('cliente.index', compact('clientes', 'busqueda'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function create()
    {
        //peticion desde el boton del index
        return view('cliente.create');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function store(storecliente $request) //form request para validacion
    {
        $datosCliente = $request->except('_token');
        //mayusculas
        $datosCliente['nombre'] = strtoupper($request->nombre);
        $datosCliente['segnombre']  = strtoupper($request->segnombre);
        $datosCliente['apellidopat'] = strtoupper($request->apellidopat);
        $datosCliente['apellidomat'] = strtoupper($request->apellidomat);
        $datosCliente['direccion'] = strtoupper($request->direccion);
        $datosCliente['email'] = strtoupper($request->email);
        $datosCliente['rfc'] = strtoupper($request->rfc);
        //insertar FILES al store
        if ($request->hasFile('actaconstitutiva')) {
            $datosCliente['actaconstitutiva'] = $request->file('actaconstitutiva')->store('public');
        }
        if ($request->hasFile('consFiscal')) {
            $datosCliente['consFiscal'] = $request->file('consFiscal')->store('public');
        }
        if ($request->hasFile('comprDom')) {
            $datosCliente['comprDom'] = $request->file('comprDom')->store('public');
        }
        if ($request->hasFile('tarjetacirculacion')) {
            $datosCliente['tarjetacirculacion'] = $request->file('tarjetacirculacion')->store('public');
        }
        if ($request->hasFile('compPago')) {
            $datosCliente['compPago'] = $request->file('compPago')->store('public');
        }

        Cliente::insert($datosCliente);

        return redirect()->route(route: 'cliente.index');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function show($id) //recive id de cliente
    {
        //traer datos de cliente
        $cliente = cliente::find($id);
        //traer referencias a la vista show
        $referencias = Referencia::where('cliente_id', 'LIKE', $id)->get();
        //unir datos de las consultas en un solo array para enviar a la vista
        $data = [
            'cliente' => $cliente,
            'referencias' => $referencias
        ];

        return view('cliente.show')->with($data);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function buscararchivos($id)
    {
        $cliente_id = $id;

        $cliente = Cliente::find($id);
        //return $cliente;
        return view('cliente.archivos', compact('cliente'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function clienteshow($id)
    {
        $cliente = cliente::findOrFail($id);
        $referencias = referencia::where('cliente_id', 'LIKE', $id)->get();

        $data = [
            'cliente' => $cliente,
            'referencias' => $referencias
        ];

        return view('cliente.show')->with($data);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit($id) //recive el id del cliente para editarlo
    {
        $cliente = Cliente::findOrfail($id);
        return view('cliente.edit', compact('cliente'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update(Request $request, $id) //atrayendo los datos del cliente form
    {
        //validacion de datos
        $campos = [
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:2|max:100',
            'apellidomat' => 'required|alpha|min:2|max:100',
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required',
            'email' => 'required|string|min:2|max:100|email|unique:clientes,email,' . $id,
            'rfc' => 'nullable|alpha_num|min:2|max:100|unique:clientes,rfc,' . $id,
            'actaconstitutiva' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'consFiscal' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'comprDom' => 'mimes:pdf,jpeg,png,jpg|max:5000',
            'tarjetacirculacion' => 'mimes:pdf,jpeg,png,jpg,pdf|max:5000',
            'compPago' => 'mimes:pdf,jpeg,png,jpg|max:5000'
        ];

        $this->validate($request, $campos/*$mensaje*/);
        $datosCliente = $request->except(['_token', '_method']);

        if ($request->hasFile('actaconstitutiva')) {
            $cliente = Cliente::findOrFail($id);
            Storage::delete('public/' . $cliente->actaconstitutiva);
            $datosCliente['actaconstitutiva'] = $request->file('actaconstitutiva')->store('uploads', 'public');
        }

        if ($request->hasFile('consFiscal')) {
            $cliente = Cliente::findOrFail($id);
            $datosCliente['consFiscal'] = $request->file('consFiscal')->store('uploads', 'public');
            Storage::delete('public/' . $cliente->consFiscal);
        }

        if ($request->hasFile('comprDom')) {
            $cliente = Cliente::findOrFail($id);
            Storage::delete('public/' . $cliente->comprDom);
            $datosCliente['comprDom'] = $request->file('comprDom')->store('uploads', 'public');
        }

        if ($request->hasFile('tarjetacirculacion')) {
            $cliente = Cliente::findOrFail($id);
            Storage::delete('public/' . $cliente->tarjetacirculacion);
            $datosCliente['tarjetacirculacion'] = $request->file('tarjetacirculacion')->store('uploads', 'public');
        }

        if ($request->hasFile('compPago')) {
            $cliente = Cliente::findOrFail($id);
            Storage::delete('public/' . $cliente->compPago);
            $datosCliente['compPago'] = $request->file('compPago')->store('uploads', 'public');
        }

        Cliente::where('id', '=', $id)->update($datosCliente);
        $cliente = Cliente::findOrFail($id);

        return redirect('cliente')->with('mensaje', 'Cliente editado exitosamente ');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect('cliente')->with('mensaje', 'Cliente eliminado exitosamente ');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function crearcliente()
    {
        //peticion desde el boton del index
        return view('registroCliente.datoscliente');
    }


    public function createnuevo(storecliente $request) //form request para validacion
    {
        $datosCliente = $request->except('_token');
        //mayusculas
        $datosCliente['nombre'] = strtoupper($request->nombre);
        $datosCliente['segnombre']  = strtoupper($request->segnombre);
        $datosCliente['apellidopat'] = strtoupper($request->apellidopat);
        $datosCliente['apellidomat'] = strtoupper($request->apellidomat);
        $datosCliente['direccion'] = strtoupper($request->direccion);
        $datosCliente['email'] = strtoupper($request->email);

        $datosCliente['rfc'] = strtoupper($request->rfc);
        //insertar FILES al store
        if ($request->hasFile('actaconstitutiva')) {
            $datosCliente['actaconstitutiva'] = $request->file('actaconstitutiva')->store('public');
        }
        if ($request->hasFile('consFiscal')) {
            $datosCliente['consFiscal'] = $request->file('consFiscal')->store('public');
        }
        if ($request->hasFile('comprDom')) {
            $datosCliente['comprDom'] = $request->file('comprDom')->store('public');
        }
        if ($request->hasFile('tarjetacirculacion')) {
            $datosCliente['tarjetacirculacion'] = $request->file('tarjetacirculacion')->store('public');
        }
        if ($request->hasFile('compPago')) {
            $datosCliente['compPago'] = $request->file('compPago')->store('public');
        }

        Cliente::insert($datosCliente);
        $cliente_telefono = $request->telefono;

        $cliente = Cliente::where('telefono', 'like', $cliente_telefono)->get();
        foreach ($cliente as $client) {
            $cliente_id = $client->id;
        }
        $cliente_id;

        return redirect()->route(('crear.nuevo.ref'), $cliente_id);
}
   
    public function orden($vehiculo_id)
    {
        $horaactual = Carbon::now()->toDateString();
        $vehiculo = Vehiculo::find($vehiculo_id);
        
        $cliente_id = $vehiculo->cliente_id;
        $cliente = Cliente::find($cliente_id);

        $dispositivo = Dispositivo::where('vehiculo_id', '=', $vehiculo->id)->first();
        $dispositivo_id = $dispositivo->id;
        $dispositivo = Dispositivo::find($dispositivo_id);

        $linea = Linea::where('dispositivo_id', '=', $dispositivo_id)->first();
        $linea_id = $linea->id;
        $linea = Linea::find($linea_id);

        $pdf = PDF::loadView('funciones.orden', compact('vehiculo', 'cliente', 'dispositivo', 'linea', 'horaactual'));
        return $pdf->stream('OrdenDeServicio.pdf');
    }
}
