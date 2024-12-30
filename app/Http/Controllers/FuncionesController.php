<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\linea;
use App\Models\Cliente;

use App\Models\Dispositivo;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class FuncionesController extends Controller
{



    public function stok()
    {
        $usuarioAlmacen = 253;
        $aux = Cliente::find($usuarioAlmacen);
    
        if (!$aux) {
            return redirect()->back()->with('error', 'Cliente no encontrado.');
        }
    
        $dispositivos = $aux->dispositivos->filter(function ($dispositivo) {
            return $dispositivo->id != 1401;
        });
    
        $lineas = $aux->lineas->filter(function ($linea) {
            return $linea->id != 1401;
        });
    
        return view('inventario.stok', compact('aux', 'dispositivos', 'lineas'));
    }
    


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
        // Validación de tipo de registro
        if ($request->tipoRegistro === 'dispositivo') {
            $validatedData = $request->validate([
                'tipoRegistro' => 'required|string|in:dispositivo',
                'modelo' => 'required|string',
                'noserie' => 'required|string',
                'imei' => 'required|string',
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
            $dispositivo->cliente_id = $validatedData['cliente_id'] ?? '253'; // Default client_id
            $dispositivo->vehiculo_id = $validatedData['vehiculo_id'] ?? '1401'; // Default vehicle_id
            $dispositivo->save();

            return redirect()->route('inventario.stok')->with('success', 'Dispositivo registrado exitosamente!');
        } elseif ($request->tipoRegistro === 'linea') {
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
            $linea->cliente_id = $validatedData['cliente_id'] ?? '253';
            $linea->dispositivo_id = $validatedData['dispositivo_id'] ?? '1401';
            $linea->save();

            return redirect()->route('inventario.stok')->with('success', 'Línea telefónica registrada exitosamente!');
        }

        // Si el tipo de registro no es válido
        return redirect()->back()->with('error', 'Tipo de registro inválido');
    }

    public function renovaciones()
{
    $dispositivos = dispositivo::paginate(10);

    return view('funciones.renovaciones', compact('dispositivos'));
}

public function renovacionessearch(Request $request)
{


    $mes = $request->get('mes'); // Mes seleccionado
    $año = $request->get('año'); // Año seleccionado

    if (!$mes || !$año) {
        return redirect()->back()->with('error', 'Por favor seleccione el mes y el año para buscar.');
    }


    // Construir la consulta base
    $query = Dispositivo::query();

    // Aplicar el filtro por mes y año usando STR_TO_DATE para analizar la fecha
    $query->whereRaw("MONTH(STR_TO_DATE(fechacompra, '%d/%m/%Y')) = ?", [$mes])
          ->whereRaw("YEAR(STR_TO_DATE(fechacompra, '%d/%m/%Y')) = ?", [$año]);

    // Paginación de resultados
    $dispositivos = $query->paginate(10);

    // Pasar resultados a la vista
    return view('funciones.renovaciones', compact('dispositivos', 'mes', 'año'));
}




}
