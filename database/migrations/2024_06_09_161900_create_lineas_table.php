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
        Schema::create('lineas', function (Blueprint $table) {

            $table->engine = "InnoDB";
            $table->id();
            $table->string("simcard");
            $table->string("telefono");
            $table->string("tipolinea");
            $table->string("renovacion");
            $table->string('comentarios')->nullable()->default('null');

            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('dispositivo_id')->unsigned();


            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas');
    }
};
