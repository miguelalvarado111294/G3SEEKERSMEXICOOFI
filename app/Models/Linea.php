<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class linea extends Model
{
    use HasFactory;

    protected $fillable = [
        'simcard',
        'telefono',
        'tipolinea',
        'renovacion',
        'comentarios',
        'cliente_id',
        'dispositivo_id'
    ];

    public function cliente()
    {

        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
    public function dispositivo()
    {

        return $this->hasOne('App\Models\Dispositivo', 'dispositivo_id', 'id');
    }
}

