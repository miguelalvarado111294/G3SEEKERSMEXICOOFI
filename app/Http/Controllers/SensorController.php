<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda', '');
        $sensors = Sensor::query()
            ->where('marca', 'LIKE', "%$busqueda%")
            ->orWhere('modelo', 'LIKE', "%$busqueda%")
            ->orWhere('noserie', 'LIKE', "%$busqueda%")
            ->paginate(10);

        return view('sensor.index', compact('sensors', 'busqueda'));
    }

    public function create()
    {
        $dispositivos = Dispositivo::all();
        return view('sensor.create', compact('dispositivos'));
    }

    public function crearsens($id)
    {
        return view('sensor.createid', ['id' => $id]);
    }

    public function stosens(Request $request, $id)
    {
        $this->validateSensor($request);

        Sensor::create($this->sensorData($request, $id));

        return redirect()->route('buscar.sensor', $id);
    }

    public function store(Request $request)
    {
        $this->validateSensor($request);

        Sensor::create($request->except('_token'));

        return redirect('sensor')->with('mensaje', 'Sensor agregado exitosamente.');
    }

    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $this->validateSensor($request);

        $sensor = Sensor::findOrFail($id);
        $sensor->update($request->except(['_token', '_method']));

        return redirect()->route('buscar.sensor', $sensor->dispositivo_id);
    }

    public function destroy($id)
    {
        Sensor::destroy($id);
        return redirect()->back();
    }

    // Validaciones
    protected function validateSensor(Request $request)
    {
        $request->validate([
            'marca' => 'required|alpha|min:2|max:100',
            'modelo' => 'nullable|alpha_dash',
            'noserie' => 'required|alpha_dash|min:2|max:100',
            'tipo' => 'required|alpha|min:2|max:100',
        ]);
    }

    protected function sensorData(Request $request, $dispositivoId)
    {
        return [
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'noserie' => $request->noserie,
            'tipo' => $request->tipo,
            'comentarios' => $request->comentarios,
            'dispositivo_id' => $dispositivoId,
        ];
    }
}
