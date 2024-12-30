<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ctaespejo extends Model
{
    use HasFactory;


    protected $fillable = [

        'usuario',
        'contrasenia',
        'comentarios',
        'cuenta_id'

    ];

    public function cuenta()
    {


        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id', 'id');
    }
}
