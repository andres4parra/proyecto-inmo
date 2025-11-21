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
        'id_dueno',
    ];
    public function dueno()
    {
        return $this->belongsTo(User::class, 'id_dueno');
    }
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_propiedad');
    }
}
