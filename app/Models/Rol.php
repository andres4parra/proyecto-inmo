<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nombre_rol',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_roles', 'id_rol', 'id_usuario');
    }
}
