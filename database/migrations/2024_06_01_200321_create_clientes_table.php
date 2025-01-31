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
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('nombre');
            $table->string('segnombre')->nullable(); //->default('null')
            $table->string('apellidopat');
            $table->string('apellidomat');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('email');

            $table->string('ine')->nullable();
            $table->string('rfc')->nullable();
            $table->string('actaconstitutiva')->nullable();
            $table->string('consFiscal')->nullable();
            $table->string('comprDom')->nullable();

            $table->string('comentarios')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
