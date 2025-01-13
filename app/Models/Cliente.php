<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'segnombre',
        'apellidopat',
        'apellidomat',
        'telefono',
        'direccion',
        'email',
        'rfc',
        'actaconstitutiva',
        'consFiscal',
        'comprDom',
        'tarjetacirculacion',
        'compPago',
    ];


    public function referencias()
    {
        return $this->hasMany('App\Models\Referencia', 'cliente_id', 'id');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\Models\Vehiculo', 'cliente_id', 'id');
    }

    

    public function dispositivos()
    {
        return $this->hasMany('App\Models\Dispositivo', 'cliente_id', 'id');
    }
    public function cuentas()
    {
        return $this->hasOne('App\Models\Cuenta', 'cliente_id', 'id');
    }
    public function lineas()
    {
        return $this->hasMany('App\Models\Linea', 'cliente_id', 'id');
    }

    public function getAlertsAttribute()
    {
        $alerts = [];

        // Verificar si el cliente tiene cuentas, vehículos, dispositivos y líneas asociadas
        if ($this->cuentas_count == 0) {
            $alerts[] = ['type' => 'danger', 'message' => 'El cliente no tiene cuentas asociadas.'];
        }
        if ($this->vehiculos_count == 0) {
            $alerts[] = ['type' => 'warning', 'message' => 'El cliente no tiene vehículos asignados.'];
        }
        if ($this->dispositivos_count == 0) {
            $alerts[] = ['type' => 'info', 'message' => 'El cliente no tiene dispositivos asignados.'];
        }
        if ($this->lineas_count == 0) {
            $alerts[] = ['type' => 'primary', 'message' => 'El cliente no tiene líneas asignadas.'];
        }

        return $alerts;
    }



}