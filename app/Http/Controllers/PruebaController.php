<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\ctaespejo;
use App\Models\cuenta;
use App\Models\dispositivo;
use App\Models\vehiculo;
use App\Models\linea;
use App\Models\sensor;

class PruebaController extends Controller
{

    public function buscarCuenta($id)
    { //recibe cliennte id desde show

        $cuentas = Cuenta::where('cliente_id', 'LIKE',  $id)->get()->take(1);
        $clientes = Cliente::find($id);
        $clienteid = $clientes->id;

        return view('prueba.buscarCuenta', compact('cuentas', 'id', 'clienteid'));
    }


    public function buscarVehiculo($id)
    { //recive id cliente desde buscar cta
        //return $id;
        $cliente_id = $id;
        //obtener vehiculos relacionados con cliente id
        $vehiculos = Vehiculo::where('cliente_id', 'LIKE', $cliente_id)->paginate(10); //busca vehiculos ligados a id_cliete

        return view('prueba.vehiculo', compact('vehiculos', 'id', 'cliente_id'));
        //se envia a view vehiculo id de cliente

    }


    public function buscarDispositivo($id)
    { //recibe desde view vehiculos_id de vehiculo


        $vehiculoid = $id;
        $vehiculo = vehiculo::find($vehiculoid);
        $cliente_id = $vehiculo->cliente_id;

        $dispositivos = Dispositivo::where('vehiculo_id', 'LIKE', $id)->get()->take(1);


        return view('prueba.buscarDispositivo', compact('dispositivos', 'id', 'cliente_id', 'vehiculoid'));
    }

    public function buscarLinea($id)
    { //recibe $dispositivo_id

        $dispositivoid = $id;
        $lineas = Linea::where('dispositivo_id', 'LIKE', $dispositivoid)->get()->take(1);

        $dispositivo = Dispositivo::find($dispositivoid);
        $vehiculoid = $dispositivo->vehiculo_id;

        return view('prueba.buscarLinea', compact('lineas', 'dispositivoid', 'vehiculoid'));
    }

    public function buscarSensor($id)
    {

        $dispositivoid = $id;
        $sensors = Sensor::where('dispositivo_id', 'LIKE', $dispositivoid)->get();
        $dispositivo = Dispositivo::find($dispositivoid);
        $vehiculoid = $dispositivo->vehiculo_id;

        return view('prueba.buscarSensor', compact('sensors', 'id', 'vehiculoid'));
    }

    public function buscarCtaespejo($id)
    {

        $ctaespejos = Ctaespejo::where('cuenta_id', 'LIKE', $id)->get();


        return view('prueba.buscarctaespejo', compact('ctaespejos', 'id'));
    }
}
