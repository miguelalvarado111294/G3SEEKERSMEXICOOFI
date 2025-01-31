<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [

        'marca',
        'modelo',
        'noserie',
        'nomotor',
        'placa',
        'color',
        'tipo',
        'comentarios',
        'cliente_id',
        'cuenta_id',
        'dispositivo_id',
        'tarjetacirculacion'


    ];

    public function Cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }
    public function dispositivo()
    {
        return $this->hasOne('App\Models\Dispositivo', 'dispositivo_id', 'id');
    }
    
    public function historials()
    {
        return $this->hasMany(Historial::class);
    }


    
}
