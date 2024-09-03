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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('noserie');
            $table->string('nomotor');
            $table->string('placa');
            $table->string('color');
            $table->string('tipo');
            $table->string('comentarios')->nullable();


            $table->bigInteger('cliente_id')->unsigned();
            //  $table->bigInteger('dispositivo_id')->unsigned()->nullable();;
            //            $table->bigInteger('cuenta_id')     ->unsigned();

            //    $table->foreign('dispositivo_id')	->references('id')->on('dispositivos')	->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            //	        $table->foreign('cuenta_id')        ->references('id')->on('cuentas')       ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
