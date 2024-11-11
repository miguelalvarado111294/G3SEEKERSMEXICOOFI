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
    // Validación de los datos solo para 'dispositivo'
    $validatedData = $request->validate([
        'tipoRegistro' => 'required|string|in:dispositivo', // Solo permite 'dispositivo'
        'comentarios_dispositivo' => 'nullable|string', // Cambié el nombre para que coincida con el campo del formulario
        // Validaciones específicas para 'dispositivo'
        'modelo' => 'required|string',
        'noserie' => 'required|string|unique:dispositivos,noserie',
        'imei' => 'required|string|unique:dispositivos,imei',
        'fechacompra' => 'required|date',
        'precio' => 'required|numeric', // Validación para el precio
    ]);

    // Guardamos el dispositivo
    $dispositivo = new Dispositivo();
    $dispositivo->modelo = $validatedData['modelo'];
    $dispositivo->noserie = $validatedData['noserie'];
    $dispositivo->imei = $validatedData['imei'];
    $dispositivo->fechacompra = $validatedData['fechacompra'];
    $dispositivo->precio = $validatedData['precio']; // Ahora está validado
    $dispositivo->comentarios = $validatedData['comentarios_dispositivo'] ?? '';
    $dispositivo->cliente_id = $validatedData['cliente_id'] ?? '250'; // Aquí también se asigna un valor por defecto
    $dispositivo->vehiculo_id =$validatedData['vehiculo_id'] ?? '1512'; 



    $dispositivo->save();

    return redirect()->back()->with('success', 'Dispositivo registrado exitosamente!');
}

    
}
    
    
    //

