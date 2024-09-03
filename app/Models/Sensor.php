<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensor extends Model
{
    use HasFactory;

    protected $fillable = [

        'marca',
        'modelo',
        'noserie',
        'tipo',
        'comentarios',
        'dispositivo_id'

    ];



    public function dispositivo()
    {

        return $this->hasOne(Dispositivo::class, 'dispositivo_id', 'id');
    }
}
