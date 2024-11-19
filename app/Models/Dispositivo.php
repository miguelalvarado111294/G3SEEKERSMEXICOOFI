<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
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
        return $this->hasMany('App\Models\Linea', 'linea_id', 'id');
    }
    
    public function linea()
    {
        return $this->hasOne('App\Models\Linea', 'dispositivo_id', 'id'); // Relación uno a uno
    }
    


    public function vehiculo()
    {
        return $this->belongsTo ('App\Models\Vehiculo', 'vehiculo_id', 'id');
    }

    public function sensors()
    {
        return $this->hasMany('App\Models\Sensor');
    }
}
