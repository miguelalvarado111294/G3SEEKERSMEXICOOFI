<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
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
        'dispositivo_id'

    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }
    public function dispositivo()
    {
        return $this->belongsTo('App\Models\Dispositivo', 'dispositivo_id', 'id');
    }
}
