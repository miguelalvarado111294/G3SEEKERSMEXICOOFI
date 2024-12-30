<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $fillable = [

        'nombre',
        'segnombre',
        'apellidopat',
        'apellidomat',
        'telefono',
        'parentesco',
        'telefono',
        'cliente_id'

    ];
    /*
    protected $guarded = [
        '_token',
        '_method'
    ];*/

    public function cliente()
    {

        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }
}
