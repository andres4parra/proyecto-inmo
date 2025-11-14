<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención por defecto (opcional si es 'contratos')
    // protected $table = 'contratos'; 

    /**
     * The attributes that are mass assignable.
     * Estos campos son los que Laravel permitirá llenar usando Contrato::create() o $contract->update().
     * Deben coincidir con los campos de tu formulario y las columnas de la tabla 'contratos'.
     */
    protected $fillable = [
        'propiedad_id',
        'user_id',
        'tipo_contrato',
        'nombre_cliente',
        'cedula_cliente',
        'monto_acordado',
        'fecha_inicio',
        'fecha_fin',
        'detalles', // Si tienes una columna 'detalles' en tu DB, debe ir aquí.
        'pdf_path', // Aunque se maneja aparte, es bueno incluirlo si puede ser actualizado.
        // Agrega cualquier otra columna que necesite ser asignada masivamente.
    ];

    /**
     * Define la relación: Un contrato pertenece a una propiedad.
     */
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    /**
     * Define la relación: Un contrato pertenece a un usuario (cliente o agente).
     * Nota: Si tu tabla de usuarios se llama 'usuarios', Laravel lo infiere,
     * pero a veces es necesario especificarlo si el foreign key no es 'user_id'.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Asegúrate que 'user_id' es la clave foránea correcta
    }
}