<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Quitamos 'use HasFactory' porque no lo necesitas para leer datos.
// Pero la clase debe extender de Model para que funcione Eloquent.

class Message extends Model
{
    /**
     * Define el nombre de la tabla en español 'mensajes'.
     * ESTO SOLUCIONA el error de "table messages doesn't exist".
     *
     * @var string
     */
    protected $table = 'mensajes';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_resolved',
    ];
    
    /**
     * Castea el campo is_resolved a tipo booleano de PHP.
     */
    protected $casts = [
        'is_resolved' => 'boolean',
    ];
}