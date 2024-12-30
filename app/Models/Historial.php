<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id', 
        'descripcion', 
        'fecha',
    ];

    protected $dates = ['fecha'];
    
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo'); 
    }

    
}
