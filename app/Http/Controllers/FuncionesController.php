<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\linea;

use App\Models\Dispositivo;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class FuncionesController extends Controller
{
    public function inventarioadd()
    {

        return view('inventario.agregararticulo');
    }

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

        // Ejecutar la consulta para obtener los dispositivos filtrados
        $dispositivos = $query->paginate(10);

        // Obtener el total de dispositivos, ya sea con o sin filtros aplicados
        $totalDispositivos = $query->count(); // Contar los dispositivos con los filtros aplicados

        // También puedes obtener el total sin ningún filtro:
        $totalDispositivosSinFiltro = Dispositivo::count();

        // Pasar el total de dispositivos al view
        return view('dispositivo.index', compact('dispositivos', 'busqueda', 'totalDispositivos', 'totalDispositivosSinFiltro'));
    }
   

    public function store(Request $request)
    {
        //return $request;
        // Valida los campos basados en el tipo de registro
        if ($request->tipoRegistro === 'dispositivo') {
            // Validación específica para 'dispositivo'
            $validatedData = $request->validate([
                'tipoRegistro' => 'required|string|in:dispositivo',
                'modelo' => 'required|string',
                'noserie' => 'required|string|unique:dispositivos,noserie',
                'imei' => 'required|string|unique:dispositivos,imei',
                'fechacompra' => 'required|date',
                'precio' => 'required|numeric',
                'comentarios_dispositivo' => 'nullable|string',
            ]);
    
            // Guardamos el dispositivo
            $dispositivo = new Dispositivo();
            $dispositivo->modelo = $validatedData['modelo'];
            $dispositivo->noserie = $validatedData['noserie'];
            $dispositivo->imei = $validatedData['imei'];
            $dispositivo->fechacompra = $validatedData['fechacompra'];
            $dispositivo->precio = $validatedData['precio'];
            $dispositivo->comentarios = $validatedData['comentarios_dispositivo'] ?? '';
            $dispositivo->cliente_id = $validatedData['cliente_id'] ?? '250'; // Default client_id
            $dispositivo->vehiculo_id = $validatedData['vehiculo_id'] ?? '1512'; // Default vehicle_id
            $dispositivo->save();
    
            return redirect()->back()->with('success', 'Dispositivo registrado exitosamente!');
        } elseif ($request->tipoRegistro === 'linea') {
            // Validación específica para 'linea'
            $validatedData = $request->validate([
                'tipoRegistro' => 'required|string|in:linea',
                'simcard' => 'required|string',
                'telefono' => 'required|string',
                'tipolinea' => 'required|string|in:datos,voz_y_datos',
                'renovacion' => 'required|date',
                'comentarios' => 'nullable|string',
            ]);
    
            // Guardamos la línea telefónica
            $linea = new Linea();
            $linea->simcard = $validatedData['simcard'];
            $linea->telefono = $validatedData['telefono'];
            $linea->tipolinea = $validatedData['tipolinea'];
            $linea->renovacion = $validatedData['renovacion'];
            $linea->comentarios = $validatedData['comentarios'] ?? '';
            $linea->cliente_id = $validatedData['cliente_id'] ?? '250';
            $linea->dispositivo_id = $validatedData['dispositivo_id'] ?? '1512';    
            $linea->save();
    
            return redirect()->back()->with('success', 'Línea telefónica registrada exitosamente!');
        }
    
        // Si el tipo de registro no es válido, redirigir con error
        return redirect()->back()->with('error', 'Tipo de registro inválido');
    }





    public function renovaciones(){

        $dispositivos =dispositivo ::all();



        return view('funciones.renovaciones', compact('dispositivos'));
    }

    public function renovacionessearch(Request $request)
    {
        // Obtener el mes del request
        $mes = $request->input('mes');
        
        // Verificar si el mes fue proporcionado
        if ($mes) {
            // Filtrar dispositivos donde el mes de 'fechacompra' coincida con el mes seleccionado
            $dispositivos = Dispositivo::whereRaw("MONTH(fechacompra) = ?", [$mes])
                ->whereRaw("fechacompra REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}$'") // Asegurarse de que 'fechacompra' esté en formato 'Y-m-d'
                ->get();
        } else {
            // Si no se selecciona mes, obtener todos los dispositivos con fecha válida
            $dispositivos = Dispositivo::whereRaw("fechacompra REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}$'") // Filtramos registros con formato correcto de fecha
                ->get();
        }
        
        // Retornar la vista con los dispositivos obtenidos
        return view('funciones.renovaciones', compact('dispositivos'));
    }
    
    
    
    
}