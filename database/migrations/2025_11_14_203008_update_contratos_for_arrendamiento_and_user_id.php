<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Necesario para la sintaxis de ENUM

return new class extends Migration
{
    /**
     * Aplica los cambios a la tabla 'contratos'.
     */
    public function up(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            
            // 1. Agregar la columna user_id (Clave Foránea para el Cliente)
            // Asumo que la tabla de usuarios se llama 'usuarios' como se vio en tu DB.
            $table->foreignId('user_id')
                  ->nullable() // Permite NULL temporalmente si ya tienes datos
                  ->after('propiedad_id') 
                  ->constrained('usuarios') // Ajusta el nombre de la tabla si es 'users'
                  ->onDelete('set null');

            // NOTA IMPORTANTE: Para modificar una columna ENUM existente en Laravel
            // y SQLite, a menudo es mejor usar la sintaxis nativa de la DB.
            // Aquí usamos DB::statement, que funciona mejor con MySQL.

            // 2. Actualizar los tipos de contrato ENUM
            // Cambia el ENUM para incluir 'arrendamiento_normal' y 'arrendamiento_comercial'
            // Manteniendo 'venta' y 'alquiler' si ya existen datos que los usan.
            // Si quieres eliminar 'alquiler' y solo dejar los nuevos, cambia la lista.
            DB::statement("ALTER TABLE contratos CHANGE tipo_contrato tipo_contrato ENUM('alquiler', 'venta', 'arrendamiento_normal', 'arrendamiento_comercial') DEFAULT 'alquiler' NOT NULL;");
        });
    }

    /**
     * Revierte los cambios de la tabla 'contratos'.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            
            // 1. Revertir la columna user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // 2. Revertir los tipos de contrato ENUM a los valores originales
            DB::statement("ALTER TABLE contratos CHANGE tipo_contrato tipo_contrato ENUM('alquiler', 'venta') DEFAULT 'alquiler' NOT NULL;");
        });
    }
};