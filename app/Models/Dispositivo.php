<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispositivo extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'modelo',
        'noserie',
        'imei',
        'cuenta',
        'sucursal',
        'fechacompra',
        'noeconomieco',
        'comentarios',
        'sensor_id',
        'linea_id',
        'cliente_id'

    ];
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function lineas()
    {
        return $this->belongsTo('App\Models\Linea', 'linea_id', 'id');
    }


    public function vehiculo()
    {
        return $this->hasOne ('App\Models\Vehiculo', 'vehiculo_id', 'id');
    }

    public function sensors()
    {
        return $this->hasMany('App\Models\Sensor');
    }
}
