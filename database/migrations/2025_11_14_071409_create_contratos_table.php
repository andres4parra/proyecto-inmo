<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            // Clave foránea a la tabla de propiedades
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            
            $table->string('nombre_cliente', 255);
            $table->string('cedula_cliente', 50)->unique();
            $table->enum('tipo_contrato', ['alquiler', 'venta'])->default('alquiler');
            $table->decimal('monto_acordado', 15, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('detalles')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};