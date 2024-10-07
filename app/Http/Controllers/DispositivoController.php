<?php

namespace App\Http\Controllers;

use App\Models\dispositivo;
use App\Models\cuenta;
use App\Models\vehiculo;
use App\Models\cliente;
use App\Models\linea;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');  //recibe del input de index cliente y lo almacena en una variable 
        $dispositivos = Dispositivo::where('id', 'LIKE',  $busqueda)
            ->orWhere('imei', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('noeconomico', 'LIKE', '%' . $busqueda . '%')->paginate(10);
        return view('dispositivo.index', compact('dispositivos', 'busqueda'));
    }

    public function creardisp($id)
    {
        return view('dispositivo.createid', ['id' => $id]);
    }

    public function stodis(Request $request, $id)
    {
        $vehiculoid = $id;
        $vehiculo = Vehiculo::find($vehiculoid);
        $clienteid = $vehiculo->cliente_id;

        $request->validate([
            'modelo' => 'required|alpha_dash|min:2|max:100',
            'noserie' => 'nullable|alpha_dash|min:20|unique:dispositivos,noserie,' . $id,
            'imei' => 'required|numeric|min:2|min:18|unique:dispositivos,imei,' . $id,
        ]);

        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $clienteid;
        $datosCliente['vehiculo_id'] = $vehiculoid;

        $mArray = array_map('strtoupper', $datosCliente);
        Dispositivo::insert($mArray);

        return redirect()->route('buscar.dispositivo', $vehiculoid = $id);
    }

    public function edit($id)
    {
        $vehiculos = vehiculo::all();
        $clientes = cliente::all();
        $dispositivo = dispositivo::findOrfail($id);
        return view('dispositivo.edit', compact('dispositivo', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, $id)
    {
        $campos = [
            'modelo' => 'required|alpha_dash|min:2|max:100',
            'noserie' => 'nullable|alpha_dash|min:20|unique:dispositivos,noserie,' . $id,
            'imei' => 'required|numeric|min:2|min:18|unique:dispositivos,imei,' . $id,
        ];

        $this->validate($request, $campos/*$mensaje*/);
        $datosDispositivo = $request->except(['_token', '_method']);

        Dispositivo::where('id', '=', $id)->update($datosDispositivo);
        $dispositivo = Dispositivo::findOrFail($id);

        return redirect()->route('buscar.dispositivo', $dispositivo->vehiculo_id);
    }

    public function destroy($id)
    {
        Dispositivo::destroy($id);
        return redirect()->back();
    }

    public function create()
    {
        $vehiculos = vehiculo::all();
        $clientes = cliente::all();
        return view('dispositivo.create', compact('vehiculos', 'clientes'));
    }

    public function store(Request $request,$id)
    {
        $campos = [
            'modelo' => 'required|alpha_dash|min:2|max:100',
            'noserie' => 'nullable|alpha_dash|min:20|unique:dispositivos,noserie,' . $id,
            'imei' => 'required|numeric|min:2|min:18|unique:dispositivos,imei,' . $id,
        ];

        $this->validate($request, $campos/*$mensaje*/);
        $datosDispositivo = $request->except('_token');
        Dispositivo::insert($datosDispositivo);

        return redirect('dispositivo')->with('mensaje', 'Dispositivo agregado exitosamente ');
    }
}
