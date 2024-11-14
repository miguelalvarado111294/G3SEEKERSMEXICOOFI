<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispositivo extends Model
{
    use HasFactory;
    protected $dates = ['fechacompra'];


    protected $fillable = [
        'modelo',
        'noserie',
        'imei',
        'cliente_id',
        'vehiculo_id',
        'cuenta',
        'precio',
        'sucursal',
        'fechacompra',
        'noeconomico',
        'comentarios'
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
