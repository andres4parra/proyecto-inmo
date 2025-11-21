<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 🚫 Evitar ejecutar esto en Railway (SQLite)
        if (config('database.default') === 'sqlite') {
            return;
        }

        Schema::table('contratos', function (Blueprint $table) {

            // 1. Agregar user_id (solo MySQL)
            $table->foreignId('user_id')
                ->nullable()
                ->after('propiedad_id')
                ->constrained('usuarios')
                ->onDelete('set null');
        });

        // 2. Modificar ENUM (solo MySQL)
        DB::statement("
            ALTER TABLE contratos 
            CHANGE tipo_contrato tipo_contrato 
            ENUM('alquiler','venta','arrendamiento_normal','arrendamiento_comercial') 
            DEFAULT 'alquiler' NOT NULL;
        ");
    }

    public function down(): void
    {
        // 🚫 Evitar ejecutar en SQLite
        if (config('database.default') === 'sqlite') {
            return;
        }

        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        DB::statement("
            ALTER TABLE contratos 
            CHANGE tipo_contrato tipo_contrato 
            ENUM('alquiler', 'venta') 
            DEFAULT 'alquiler' NOT NULL;
        ");
    }
};
