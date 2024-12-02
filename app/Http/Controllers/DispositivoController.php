<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Historial;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{

    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $mes = $request->get('mes'); // Obtener el mes seleccionado

        // Construir la consulta
        $query = Dispositivo::where(function ($query) use ($busqueda) {
            $query->where('id', 'LIKE', "%{$busqueda}%")
                ->orWhere('imei', 'LIKE', "%{$busqueda}%")
                ->orWhere('cuenta', $busqueda)
                ->orWhere('noeconomico', 'LIKE', "%{$busqueda}%");
        });

        // Si se selecciona un mes, filtramos por el mes en la columna fechacompra
        if ($mes) {
            // Extraemos el mes de la fecha de compra, que está en el formato dd/mm/yyyy
            $query->whereRaw("MONTH(STR_TO_DATE(fechacompra, '%d/%m/%Y')) = ?", [$mes]);
        }

        // Ejecutar la consulta
        $dispositivos = $query->paginate(10);
        $totalDispositivos = $query->count(); // Contar los dispositivos

        return view('dispositivo.index', compact('dispositivos', 'busqueda', 'totalDispositivos'));
    }

    public function creardisp($id)
    {
        $vehiculoinventarioid = 1512;
        $dispositivosinventario = Dispositivo::where('vehiculo_id', $vehiculoinventarioid)->get();
        $vehiculo = Vehiculo::findOrFail($id);
        return view('dispositivo.createid', compact('id', 'dispositivosinventario'));
    }

    public function obtenerDispositivo($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);

        return response()->json($dispositivo);
    }

    public function stodis(Request $request, $id)
    {
        // Busca el vehículo por ID
        $vehiculo = Vehiculo::findOrFail($id);
    
        // Valida los datos del formulario
        $request->validate($this->validationRules($id));
    
        // Busca un dispositivo existente con el mismo `noserie` o `imei` (según tus reglas de negocio)
        $dispositivoExistente = Dispositivo::where('imei', $request->imei)
            ->orWhere('noserie', $request->noserie)
            ->first();
    
        if ($dispositivoExistente) {
            // Fusiona los datos del dispositivo existente con los datos enviados en el formulario
            $datosActualizados = array_merge(
                $dispositivoExistente->toArray(), // Datos existentes
                $request->except('_token'), // Datos ingresados en el formulario
                [
                    'cliente_id' => $vehiculo->cliente_id, // Asegúrate de asignar cliente y vehículo correctos
                    'vehiculo_id' => $id,
                    'ubicaciondispositivo' => $request->ubicaciondispositivo,
                    'precio' => $dispositivoExistente->precio, // Conserva el precio existente
                ]
            );
    
            // Si el precio es proporcionado en el formulario, actualízalo
            if ($request->filled('precio')) {
                $datosActualizados['precio'] = $request->precio;
            }
    
            // Actualiza el dispositivo con los datos combinados
            $dispositivoExistente->update($datosActualizados);
    
        } else {
            // Si no existe, crea un nuevo dispositivo combinando datos del formulario y valores por defecto
            $datosCliente = array_merge(
                $request->except('_token'), 
                [
                    'cliente_id' => $vehiculo->cliente_id,
                    'vehiculo_id' => $id,
                    'ubicaciondispositivo' => $request->ubicaciondispositivo,
                    'precio' => $request->precio ?? 0, // Usa el precio proporcionado o 0 por defecto
                ]
            );
    
            Dispositivo::create(array_map('strtoupper', $datosCliente));
        }
    
        // Redirige a la vista de búsqueda de dispositivos para el vehículo actual
        return redirect()->route('buscar.dispositivo', $id);
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

        $datosDispositivo = $request->except(['_token', '_method']);
        Dispositivo::where('id', $id)->update($datosDispositivo);

        return redirect()->route('buscar.dispositivo', Dispositivo::findOrFail($id)->vehiculo_id);
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
            'noserie' => 'nullable|alpha_dash|min:20',
            'imei' => 'required|string|min:15|max:20',
        ];
    }

    public function historial($vehiculo_id)
    {
        // Pagina el historial de vehículos, 10 registros por página
        $historial = Historial::where('vehiculo_id', $vehiculo_id)
            ->paginate(10);  // Paginación de 10 resultados por página

        // Retorna la vista con los datos del vehículo y el historial paginado
        return view('vehiculo.historial', compact('vehiculo_id', 'historial'));
    }


    public function historialregister(Request $request, $vehiculo_id)
    {
        // Validación de los datos
        $request->validate([
            'descripcion' => 'required|string|max:255', // Modifica las reglas según sea necesario
        ]);

        // Crear el historial en la base de datos
        Historial::create([
            'vehiculo_id' => $vehiculo_id,   // Relacionamos el historial con el vehículo
            'descripcion' => $request->descripcion,  // Almacenamos la descripción proporcionada
            'fecha' => now('America/Mexico_City'),  // Establecemos la zona horaria de México
        ]);

        // Redirigir a donde sea necesario (por ejemplo, a la lista de vehículos o al historial)
        return redirect()->route('historial', $vehiculo_id)->with('success', 'Descripción registrada correctamente.');
    }
}
