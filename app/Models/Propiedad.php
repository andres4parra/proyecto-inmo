<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'ciudad',
        'ubicacion',
        'tipo',
        'habitaciones',
        'banos',
        'area',
    ];
}
