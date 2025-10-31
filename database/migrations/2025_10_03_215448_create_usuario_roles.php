<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            // Claves foráneas con el mismo tipo exacto que las originales
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_rol');

            // Relaciones
            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('id_rol')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['id_usuario', 'id_rol']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_roles');
    }
};
