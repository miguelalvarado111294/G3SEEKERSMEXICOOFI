<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\ctaespejo;
use App\Models\cuenta;
use App\Models\dispositivo;
use App\Models\vehiculo;
use App\Models\linea;
use App\Models\sensor;

use Illuminate\Http\Request;

class PruebaController extends Controller
{

    public function buscadorvehiculo(Request $request, $id)
    {
        $cliente_id = $id;
        $busqueda = $request->get('busqueda');  //recibe del input de index cliente y lo almacena en una variable 
        $vehiculos = Vehiculo::where('noserie', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('nomotor', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('placa', 'LIKE', '%' . $busqueda . '%')->paginate(10);

        return view('prueba.vehiculo', compact('vehiculos', 'id', 'cliente_id'));
        //se envia a view vehiculo id de cliente
    }

    public function buscarCuenta($id)
    {
        $cliente_id = $id;
        //recibe cliennte id desde show
        $cliente = Cliente::find($cliente_id);

        $cuenta = Cuenta::where('cliente_id', 'LIKE',  $cliente_id)->get();
        $numerodecuentas = count($cuenta);

        // $cuenta = Cuenta::find($cuenta->id);
        return view('prueba.buscarCuenta', compact('cuenta', 'cliente_id', 'cliente', 'id', 'numerodecuentas'));
    }

    public function buscarCtaespejo($id)
    {
        $ctaespejos = Ctaespejo::where('cuenta_id', 'LIKE', $id)->get();
        return view('prueba.buscarctaespejo', compact('ctaespejos', 'id'));
    }

    public function buscarVehiculo($id)
    {
        //recive id cliente desde buscar cta
        $cliente_id = $id;
        //obtener vehiculos relacionados con cliente id
        $vehiculos =    Vehiculo::where('cliente_id', 'LIKE', $cliente_id)->paginate(10); //busca vehiculos ligados a id_cliete
        $cliente =      Cliente::find($cliente_id); //busca vehiculos ligados a id_cliete

        $cuenta =      Cuenta::select('usuario')->where('cliente_id', 'LIKE', $cliente_id)->get(); //busca vehiculos ligados a id_cliete

        return view('prueba.vehiculo', compact('vehiculos', 'id', 'cliente_id', 'cliente', 'cuenta'));
        //se envia a view vehiculo id de cliente
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

        return view('prueba.buscarLinea', compact('lineas', 'dispositivoid', 'vehiculoid', 'cliente','numerodelineas'));
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
