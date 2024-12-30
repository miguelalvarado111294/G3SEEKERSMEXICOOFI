<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $fillable = [

        'usuario',
        'contrasenia',
        'contraseniaParo',
        'comentarios',
        'cliente_id',


    ];
    public function cliente()
    {


        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function ctaespejos()
    {
        return $this->hasMany('App\Models\Ctaespejo', 'ctaespejo_id', 'id');
    }
}
