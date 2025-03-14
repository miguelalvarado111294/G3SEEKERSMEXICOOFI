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
        $mes = $request->get('mes'); // Obtener el mes seleccionado

        // Construir la consulta
        $query = Dispositivo::where(function ($query) use ($busqueda) {
            $query->where('id', 'LIKE', "%{$busqueda}%")
                ->orWhere('plataforma_id', 'LIKE', "%{$busqueda}%")
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

        $vehiculo_id = 1401;
        $dispositivoseninventario = Dispositivo::where('vehiculo_id', $vehiculo_id)->get();

        return view('dispositivo.createid', compact('id', 'dispositivoseninventario'));
    }
/*
    public function stodis(Request $request, $id)
    {

        $vehiculo_id = $id;
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        $cliente_id = $vehiculo->cliente_id;

        if ($request->tipo_asignacion == 'manual') {

            $dispositivo = new Dispositivo();
            $dispositivo->cliente_id = $cliente_id;
            $dispositivo->vehiculo_id = $vehiculo_id;
            $dispositivo->plataforma_id = $request->plataforma_id;
            $dispositivo->modelo = $request->modelo;
            $dispositivo->noserie = $request->noserie;
            $dispositivo->imei = $request->imei;
            $dispositivo->cuenta = $request->cuenta;
            $dispositivo->sucursal = $request->sucursal;
            $dispositivo->fechadeinstalacion = $request->fechadeinstalacion;
            $dispositivo->fechacompra = $request->fechacompra ?: '2000-01-01';
            $dispositivo->precio = $request->precio ?: '0';
            $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo;
            $dispositivo->noeconomico = $request->noeconomico;
            $dispositivo->comentarios = $request->comentarios;
            $dispositivo->comentarios = $request->precio;

            $dispositivo->save();

            return redirect()->route('buscar.dispositivo', $vehiculo_id)->with('mensaje', 'Dispositivo asignado correctamente');
        }

        if ($request->tipo_asignacion == 'inventario') {

            $dispositivo_id = $request->dispositivo_id;
            $dispositivo = Dispositivo::findOrFail($dispositivo_id);
            //return $dispositivo;
            // Actualizamos los campos con los datos del request
            $dispositivo->cliente_id = $cliente_id;
            $dispositivo->vehiculo_id = $vehiculo_id;
            $dispositivo->plataforma_id = $request->plataforma_id;
            $dispositivo->modelo = $request->modelo;
            $dispositivo->noserie = $request->noserie;
            $dispositivo->imei = $request->imei;
            $dispositivo->cuenta = $request->cuenta;
            $dispositivo->sucursal = $request->sucursal;
            $dispositivo->fechadeinstalacion = $request->fechadeinstalacion;
            $dispositivo->fechacompra = $request->fechacompra ?: '2000-01-01';
            $dispositivo->precio = $request->precio ?: '0';
            $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo;
            $dispositivo->noeconomico = $request->noeconomico;
            $dispositivo->comentarios = $request->comentarios;

            // Guardamos los cambios
            $dispositivo->save();

            return redirect()->route('buscar.dispositivo', $vehiculo_id)->with('mensaje', 'Dispositivo actualizado correctamente');
        }
    }*/


    public function stodis(Request $request, $id)
{
    $vehiculo_id = $id;
    $vehiculo = Vehiculo::findOrFail($vehiculo_id);
    $cliente_id = $vehiculo->cliente_id;

    // Validar el archivo si es necesario
    $request->validate([
        'compPago' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5000',  // Validación para el recibo
    ]);

    // Asignación manual
    if ($request->tipo_asignacion == 'manual') {
        $dispositivo = new Dispositivo();
        $dispositivo->cliente_id = $cliente_id;
        $dispositivo->vehiculo_id = $vehiculo_id;
        $dispositivo->plataforma_id = $request->plataforma_id;
        $dispositivo->modelo = $request->modelo;
        $dispositivo->noserie = $request->noserie;
        $dispositivo->imei = $request->imei;
        $dispositivo->cuenta = $request->cuenta;
        $dispositivo->sucursal = $request->sucursal;
        $dispositivo->fechadeinstalacion = $request->fechadeinstalacion;
        $dispositivo->fechacompra = $request->fechacompra ?: '2000-01-01';
        $dispositivo->precio = $request->precio ?: '0';
        $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo;
        $dispositivo->noeconomico = $request->noeconomico;
        $dispositivo->comentarios = $request->comentarios;

        // Manejar el archivo del recibo de pago
        if ($request->hasFile('compPago')) {
            $archivo = $request->file('compPago');
            $rutaRecibo = $archivo->store('compPago', 'public');  // Guardar en la carpeta public/recibos_pago
            $dispositivo->compPago = $rutaRecibo;  // Almacenar la ruta en el campo recibo_pago
        }

        $dispositivo->save();  // Guardar el dispositivo

        return redirect()->route('buscar.dispositivo', $vehiculo_id)->with('mensaje', 'Dispositivo asignado correctamente');
    }

    // Asignación desde inventario
    if ($request->tipo_asignacion == 'inventario') {
        $dispositivo_id = $request->dispositivo_id;
        $dispositivo = Dispositivo::findOrFail($dispositivo_id);

        // Actualizamos los campos con los datos del request
        $dispositivo->cliente_id = $cliente_id;
        $dispositivo->vehiculo_id = $vehiculo_id;
        $dispositivo->plataforma_id = $request->plataforma_id;
        $dispositivo->modelo = $request->modelo;
        $dispositivo->noserie = $request->noserie;
        $dispositivo->imei = $request->imei;
        $dispositivo->cuenta = $request->cuenta;
        $dispositivo->sucursal = $request->sucursal;
        $dispositivo->fechadeinstalacion = $request->fechadeinstalacion;
        $dispositivo->fechacompra = $request->fechacompra ?: '2000-01-01';
        $dispositivo->precio = $request->precio ?: '0';
        $dispositivo->ubicaciondispositivo = $request->ubicaciondispositivo;
        $dispositivo->noeconomico = $request->noeconomico;
        $dispositivo->comentarios = $request->comentarios;

        // Manejar el archivo del recibo de pago
        if ($request->hasFile('compPago')) {
            // Si el dispositivo ya tiene un archivo de recibo, lo eliminamos
            if ($dispositivo->compPago) {
                Storage::disk('public')->delete($dispositivo->compPago);
            }

            $archivo = $request->file('compPago');
            $rutaRecibo = $archivo->store('compPago', 'public');  // Guardar en la carpeta public/recibos_pago
            $dispositivo->compPago = $rutaRecibo;  // Almacenar la ruta en el campo recibo_pago
        }

        $dispositivo->save();  // Guardar los cambios en el dispositivo

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
/*
    public function update(Request $request, $id)
    {
        $request->validate($this->validationRules($id));

        $datosDispositivo = $request->except(['_token', '_method']);
        Dispositivo::where('id', $id)->update($datosDispositivo);

        return redirect()->route('buscar.dispositivo', Dispositivo::findOrFail($id)->vehiculo_id);
    }
        */

        public function update(Request $request, $id)
        {
            $request->validate($this->validationRules($id));
        
            $datosDispositivo = $request->except(['_token', '_method', 'compPago']); // Excluir el campo del archivo
        
            // Obtener el dispositivo
            $dispositivo = Dispositivo::findOrFail($id);
        
            // Manejar la carga del archivo si existe (como en la función de vehículo)
            $this->handleFileUpload($request, $dispositivo, $datosDispositivo, ['compPago']); // 'compPago' es el campo para el archivo
        
            // Actualizar los datos del dispositivo
            $dispositivo->update($datosDispositivo);
        
            // Redireccionar a la página de búsqueda del dispositivo
            return redirect()->route('buscar.dispositivo', $dispositivo->vehiculo_id)->with('mensaje', 'Dispositivo actualizado exitosamente');
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
                    $ruta = $archivo->store('compPago', 'public'); // Guardar archivo en la carpeta correspondiente
        
                    // Actualizar el campo del modelo con la nueva ruta del archivo
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
            'noserie' => 'nullable|alpha_dash|min:20|unique:dispositivos,noserie' . ($id ? ",$id" : ''),
            'imei' => 'required|string|min:15|max:20|regex:/^[0-9-]+$/|unique:dispositivos,imei' . ($id ? ",$id" : ''),

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
