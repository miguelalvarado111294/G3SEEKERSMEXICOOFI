<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lineas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('simcard');
            $table->string('telefono');
            $table->string('tipolinea');
            $table->date('renovacion'); // Cambiado a tipo fecha
            $table->string('comentarios')->nullable();

            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('dispositivo_id')->constrained('dispositivos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lineas');
    }
};
