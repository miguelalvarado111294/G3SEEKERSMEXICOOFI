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
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('plataforma_id')->nullable();
            $table->string('modelo');
            $table->string('noserie')->nullable();
            $table->string('imei');
            $table->string('cuenta');
            $table->string('sucursal');
            $table->string('ubicaciondispositivo');
            $table->string('fechacompra');
            $table->string('precio');
            $table->string('fechadeinstalacion');
            $table->string('noeconomico')->nullable();
            $table->string('comentarios')->nullable();

            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('vehiculo_id')->unsigned();


            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
