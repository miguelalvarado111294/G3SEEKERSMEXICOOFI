<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ctaespejo;
use App\Models\Cuenta;
use App\Models\Dispositivo;
use App\Models\Vehiculo;
use App\Models\Linea;

use App\Models\Sensor;

use Illuminate\Http\Request;

class PruebaController extends Controller
{

    public function buscadorvehiculo(Request $request, $id)
    {
        $busqueda = trim($request->get('busqueda', '')); // Elimina espacios en blanco
        $cliente_id = $id;
    
        // Solo ejecutar la consulta si hay un término de búsqueda
        $vehiculos = Vehiculo::when($busqueda, function ($query, $busqueda) {
            return $query->where('noserie', 'LIKE', '%' . $busqueda . '%')
                         ->orWhere('nomotor', 'LIKE', '%' . $busqueda . '%')
                         ->orWhere('placa', 'LIKE', '%' . $busqueda . '%');
        })->paginate(10);
    
        return view('prueba.vehiculo', compact('vehiculos', 'cliente_id'));
    }
    

    public function buscarCuenta($id)
    {
        // Busca el cliente solo si es necesario
        $cliente = Cliente::find($id);
    
        // Verifica si el cliente fue encontrado
        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente no encontrado.');
        }
    
        // Encuentra las cuentas del cliente
        $cuenta = Cuenta::where('cliente_id', $id)->get();
    
        // Contar el número de cuentas
        $numerodecuentas = $cuenta->count();
        return view('prueba.buscarCuenta', [
            'cuenta' => $cuenta,
            'cliente_id' => $id,
            'cliente' => $cliente,
            'numerodecuentas' => $numerodecuentas,
        ]);
    }
    


    public function buscarCtaespejo($id)
{
    // Busca la cuenta y verifica si existe
    $cuenta = Cuenta::find($id);
    if (!$cuenta) {
        // Manejo de error, por ejemplo, redirigir o mostrar un mensaje
        return redirect()->back()->with('error', 'Cuenta no encontrada.');
    }

    $cliente_id = $cuenta->cliente_id;

    // Encuentra los espejos asociados a la cuenta
    $ctaespejos = Ctaespejo::where('cuenta_id', $id)->get();

    return view('prueba.buscarCtaespejo', [
        'ctaespejos' => $ctaespejos,
        'id' => $id,
        'cliente_id' => $cliente_id,
    ]);
}


public function buscarVehiculo($id)
{
    // Busca el cliente y verifica si existe
    $cliente = Cliente::find($id);
    if (!$cliente) {
        return redirect()->back()->with('error', 'Cliente no encontrado.');
    }

    // Obtener vehículos relacionados con el cliente
    $vehiculos = Vehiculo::where('cliente_id', $id)->paginate(10);

    // Obtener la cuenta asociada al cliente
    $cuenta = Cuenta::where('cliente_id', $id)->select('usuario')->get();

    return view('prueba.vehiculo', [
        'vehiculos' => $vehiculos,
        'id' => $id,
        'cliente_id' => $id,
        'cliente' => $cliente,
        'cuenta' => $cuenta,
    ]);
}


    public function buscarDispositivo($id)
    { //recibe desde view vehiculos_id de vehiculo
        $vehiculoid = $id;
        $vehiculo = Vehiculo::find($vehiculoid);
        $cliente_id = $vehiculo->cliente_id;
        $cliente = Cliente::find($cliente_id);
        $dispositivo = Dispositivo::where('vehiculo_id', 'LIKE', $vehiculoid)->get();
        $numerodedispositivos = count($dispositivo);

        //return $dispositivo;
        //$dispositivo_id = $dispositivo->id;
        //$dispositivo = Dispositivo::find($dispositivo_id);

        return view('prueba.buscarDispositivo', compact('vehiculo', 'cliente', 'dispositivo', 'cliente_id', 'vehiculoid', 'numerodedispositivos'/*, 'dispositivo_id'*/));
    }

    public function buscarLinea($id)
    {
        //recibe $dispositivo_id
        $dispositivoid = $id;
        $lineas = Linea::where('dispositivo_id', 'LIKE', $dispositivoid)->get()->take(1);
        $dispositivo = Dispositivo::find($dispositivoid);
        $vehiculoid = $dispositivo->vehiculo_id;
        $cliente_id = $dispositivo->cliente_id;
        $cliente = Cliente::find($cliente_id);
        $numerodelineas = count($lineas);

        return view('prueba.buscarLinea', compact('lineas', 'dispositivoid', 'vehiculoid', 'cliente', 'numerodelineas'));
    }

    public function buscarSensor($id)
    {
        $dispositivo_id = $id;
        $sensors = Sensor::where('dispositivo_id', 'LIKE', $id)->get();
        $dispositivo = Dispositivo::find($dispositivo_id);
        $cliente = Cliente::find($dispositivo->cliente_id);
        $vehiculo = Vehiculo::find($dispositivo->vehiculo_id);

        return view('prueba.buscarSensor', compact('sensors', 'id', 'dispositivo', 'cliente', 'vehiculo'));
    }
}