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
        'comentarios'

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
    public function cuenta()
    {
        return $this->hasOne('App\Models\Cuenta', 'cliente_id', 'id');
    }
    public function lineas()
    {
        return $this->hasMany('App\Models\Linea', 'cliente_id', 'id');
    }
}