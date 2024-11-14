<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();  // ID único para cada registro
            $table->foreignId('vehiculo_id')  // Establece la relación con la tabla vehiculos
                  ->constrained('vehiculos')  // Hace referencia a la tabla 'vehiculos'
                  ->onDelete('cascade')      // Si el vehículo es eliminado, también se eliminarán los historiales
                  ->onUpdate('cascade');     // Si el ID del vehículo se actualiza, también se actualizará en esta tabla
            $table->text('descripcion'); // Descripción del cambio
            $table->timestamp('fecha')->useCurrent(); // Fecha y hora del historial
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historials');
    }
};
