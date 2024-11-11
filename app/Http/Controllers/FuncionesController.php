<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\linea;
use App\Models\dispositivo;

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
        return $request;
        // Validación de los datos según el tipo de registro
        $validatedData = $request->validate([
            'tipoRegistro' => 'required|string',
            // Validaciones comunes
            'comentarios' => 'nullable|string',
            // Validaciones específicas para 'dispositivo'
            'modelo' => 'required_if:tipoRegistro,dispositivo|string',
            'noserie' => 'required_if:tipoRegistro,dispositivo|string|unique:dispositivos,noserie',
            'imei' => 'required_if:tipoRegistro,dispositivo|string|unique:dispositivos,imei',
            'fechacompra' => 'required_if:tipoRegistro,dispositivo|date',
            // Validaciones específicas para 'linea'
            'telefono' => 'required_if:tipoRegistro,linea|string|unique:lineas,telefono',
            'tipolinea' => 'required_if:tipoRegistro,linea|string',
            'renovacion' => 'required_if:tipoRegistro,linea|date',
        ]);

        // Comprobamos el tipo de registro y almacenamos los datos en la tabla correspondiente
        if ($request->tipoRegistro === 'dispositivo') {
            // Guardamos el dispositivo
            $dispositivo = new Dispositivo();
            $dispositivo->modelo = $validatedData['modelo'];
            $dispositivo->noserie = $validatedData['noserie'];
            $dispositivo->imei = $validatedData['imei'];
            $dispositivo->fechacompra = $validatedData['fechacompra'];
            $dispositivo->comentarios = $validatedData['comentarios'] ?? '';
            $dispositivo->save();

            return redirect()->back()->with('success', 'Dispositivo registrado exitosamente!');
        } elseif ($request->tipoRegistro === 'linea') {
            // Guardamos la línea telefónica
            $linea = new Linea();
            $linea->telefono = $validatedData['telefono'];
            $linea->tipolinea = $validatedData['tipolinea'];
            $linea->renovacion = $validatedData['renovacion'];
            $linea->comentarios = $validatedData['comentarios'] ?? '';
            $linea->save();

            return redirect()->back()->with('success', 'Línea telefónica registrada exitosamente!');
        }

        // Si no se seleccionó un tipo de registro, devolvemos un error
        return redirect()->back()->with('error', 'Debe seleccionar un tipo de registro.');
    }
}
    
    
    //

