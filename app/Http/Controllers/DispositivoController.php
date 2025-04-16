<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Historial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $mes = $request->get('mes');

        $query = Dispositivo::where(function ($query) use ($busqueda) {
            $query->where('id', 'LIKE', "%{$busqueda}%")
                ->orWhere('plataforma_id', 'LIKE', "%{$busqueda}%")
                ->orWhere('imei', 'LIKE', "%{$busqueda}%")
                ->orWhere('cuenta', $busqueda)
                ->orWhere('noeconomico', 'LIKE', "%{$busqueda}%");
        });

        if ($mes) {
            $query->whereRaw("MONTH(STR_TO_DATE(fechacompra, '%d/%m/%Y')) = ?", [$mes]);
        }

        $dispositivos = $query->paginate(10);
        $totalDispositivos = $query->count();

        return view('dispositivo.index', compact('dispositivos', 'busqueda', 'totalDispositivos'));
    }

    public function creardisp($id)
    {
        $vehiculo_id = 1401;
        $dispositivoseninventario = Dispositivo::where('vehiculo_id', $vehiculo_id)->get();

        return view('dispositivo.createid', compact('id', 'dispositivoseninventario'));
    }

    public function stodis(Request $request, $id)
    {
        $vehiculo_id = $id;
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        $cliente_id = $vehiculo->cliente_id;

        $request->validate([
            'compPago' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5000',
        ]);

        if ($request->tipo_asignacion == 'manual') {
            $dispositivo = new Dispositivo();
            $dispositivo->cliente_id = $cliente_id;
            $dispositivo->vehiculo_id = $vehiculo_id;
            $dispositivo->plataforma_id = $request->plataforma_id ?: 'no se registraron datos para este campo';
            $dispositivo->modelo = $request->modelo ?: 'no se registraron datos para este campo';
            $dispositivo->noserie = trim($request->noserie) ?: 'no se registraron datos para este campo';
            $dispositivo->imei = $request->imei ?: 'no se registraron datos para este campo';
            $dispositivo->cuenta = $request->cuenta ?: 'no se registraron datos para este campo';
            $dispositivo->sucursal = $request->sucursal ?: 'no se registraron datos para este campo';
            $dispositivo->fechadeinstalacion = $request->fechadeinstalacion ?: '0001-01-01';
            $dispositivo->fechacompra = $request->fechacompra ?: '0001-01-01';
            $dispositivo->precio = $request->precio ?: 'no se registraron datos para este campo';
            $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo ?: 'no se registraron datos para este campo';
            $dispositivo->noeconomico = $request->noeconomico ?: 'no se registraron datos para este campo';
            $dispositivo->comentarios = $request->comentarios ?: ' ';


            if ($request->hasFile('compPago')) {
                $archivo = $request->file('compPago');
                $rutaRecibo = $archivo->store('compPago', 'public');
                $dispositivo->compPago = $rutaRecibo;
            }

            $dispositivo->save();

            return redirect()->route('buscar.dispositivo', $vehiculo_id)->with('mensaje', 'Dispositivo asignado correctamente');
        }

        if ($request->tipo_asignacion == 'inventario') {
            $dispositivo_id = $request->dispositivo_id;
            $dispositivo = Dispositivo::findOrFail($dispositivo_id);

            $dispositivo->cliente_id = $cliente_id;
            $dispositivo->vehiculo_id = $vehiculo_id;
            $dispositivo->plataforma_id = $request->plataforma_id;
            $dispositivo->modelo = $request->modelo;
            $dispositivo->noserie = trim($request->noserie) ?: 'sin número de serie';
            $dispositivo->imei = $request->imei;
            $dispositivo->cuenta = $request->cuenta;
            $dispositivo->sucursal = $request->sucursal;
            $dispositivo->fechadeinstalacion = $request->fechadeinstalacion;
            $dispositivo->fechacompra = $request->fechacompra ?: '2000-01-01';
            $dispositivo->precio = $request->precio ?: '0';
            $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo;
            $dispositivo->noeconomico = $request->noeconomico;
            $dispositivo->comentarios = $request->comentarios;

            if ($request->hasFile('compPago')) {
                if ($dispositivo->compPago) {
                    Storage::disk('public')->delete($dispositivo->compPago);
                }

                $archivo = $request->file('compPago');
                $rutaRecibo = $archivo->store('compPago', 'public');
                $dispositivo->compPago = $rutaRecibo;
            }

            $dispositivo->save();

            return redirect()->route('buscar.dispositivo', $vehiculo_id)->with('mensaje', 'Dispositivo actualizado correctamente');
        }
    }

    public function edit($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('dispositivo.edit', compact('dispositivo', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules($id));

        $datosDispositivo = $request->except(['_token', '_method', 'compPago']);
        $dispositivo = Dispositivo::findOrFail($id);

        $this->handleFileUpload($request, $dispositivo, $datosDispositivo, ['compPago']);
        $dispositivo->update($datosDispositivo);

        return redirect()->route('buscar.dispositivo', $dispositivo->vehiculo_id)->with('mensaje', 'Dispositivo actualizado exitosamente');
    }

    protected function handleFileUpload(Request $request, $model, &$datos, $fields)
    {
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                if ($model->{$field}) {
                    Storage::disk('public')->delete($model->{$field});
                }

                $archivo = $request->file($field);
                $ruta = $archivo->store('compPago', 'public');
                $datos[$field] = $ruta;
            }
        }
    }

    public function destroy($id)
    {
        Dispositivo::destroy($id);
        return redirect()->back()->with('mensaje', 'Dispositivo eliminado exitosamente.');
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();

        return view('dispositivo.create', compact('vehiculos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        Dispositivo::create($request->except('_token'));

        return redirect()->route('dispositivo.index')->with('mensaje', 'Dispositivo agregado exitosamente.');
    }
    private function validationRules($id = null)
    {
        return [
            'modelo' => 'required|string|min:2|max:100',
            'noserie' => 'nullable|sometimes|alpha_dash|min:17|max:19|unique:dispositivos,noserie' . ($id ? ",$id" : ''),
            'imei' => 'required|string|min:15|max:25|regex:/^[A-Za-z0-9\-.]+$/|unique:dispositivos,imei' . ($id ? ",$id" : ''),
        ];
    }


    public function historial($vehiculo_id)
    {
        $historial = Historial::where('vehiculo_id', $vehiculo_id)->paginate(10);
        return view('vehiculo.historial', compact('vehiculo_id', 'historial'));
    }

    public function historialregister(Request $request, $vehiculo_id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        Historial::create([
            'vehiculo_id' => $vehiculo_id,
            'descripcion' => $request->descripcion,
            'fecha' => now('America/Mexico_City'),
        ]);

        return redirect()->route('historial', $vehiculo_id)->with('success', 'Descripción registrada correctamente.');
    }
}
