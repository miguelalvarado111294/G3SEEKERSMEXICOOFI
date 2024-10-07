<?php

namespace App\Http\Controllers;

use App\Models\dispositivo;
use App\Models\sensor;

use Illuminate\Http\Request;

class SensorController extends Controller
{

    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');  //recibe del input de index cliente y lo almacena en una variable 
        $sensors = Sensor::where('marca', 'LIKE', $busqueda)
            ->orWhere('modelo', 'LIKE',  $busqueda)
            ->orWhere('noserie', 'LIKE', $busqueda)->paginate(10);

        return view('sensor.index', compact('sensors', 'busqueda'/*,'dispositivo'*/));
    }

    public function create()
    {
        $dispositivos = dispositivo::all();
        return view('sensor.create', compact('dispositivos'));
    }

    public function crearsens($id)
    {
        return view('sensor.createid', ['id' => $id]);
    }

    public function stosens(Request $request, $id)
    {

        $dispositivoid = $id;
        $request->validate([
            'marca' => 'required|alpha|min:2|max:100',
            'modelo' => 'required|nullable|alpha_dash',
            'noserie' => 'required|alpha_dash|min:2|max:100',
            'tipo' => 'required|alpha|min:2|max:100'
        ]);

        $sensor = new Sensor;
        $sensor->marca = $request->marca;
        $sensor->modelo = $request->modelo;
        $sensor->noserie = $request->noserie;
        $sensor->tipo = $request->tipo;
        $sensor->comentarios = $request->comentarios;
        $sensor->dispositivo_id = $dispositivoid;
        $sensor->save();

        return redirect()->route('buscar.sensor', $id);
    }

    public function store(Request $request)
    {
        $campos = [
            'marca' => 'required|alpha|min:2|max:100',
            'modelo' => 'required|nullable|alpha_dash',
            'noserie' => 'required|alpha_dash|min:2|max:100',
            'tipo' => 'required|alpha|min:2|max:100'

        ];

        $this->validate($request, $campos);
        $datosSensor = $request->except('_token');
        sensor::insert($datosSensor);

        return redirect('sensor')->with('mensaje', 'sensor agregado exitosamente ');
    }

    public function edit($id)
    {
        $sensor = Sensor::find($id);

        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required|alpha|min:2|max:100',
            'modelo' => 'required|nullable|alpha_dash',
            'noserie' => 'required|alpha_dash|min:2|max:100',
            'tipo' => 'required|alpha|min:2|max:100'
        ]);

        $datosSensor = $request->except(['_token', '_method']);

        Sensor::where('id', '=', $id)->update($datosSensor);
        $sensor = Sensor::find($id);
        $dispositivo_id = $sensor->dispositivo_id;

        return redirect()->route('buscar.sensor', $dispositivo_id);

    }

    public function destroy($id)
    {
        sensor::destroy($id);
        return redirect()->back();
    }
}
