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
        Schema::create('referencias', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('nombre');
            $table->string('segnombre')->nullable();
            $table->string('apellidopat');
            $table->string('apellidomat');
            $table->string('parentesco');
            $table->string('telefono');
            $table->string('comentarios')->nullable();

            $table->bigInteger('cliente_id')->unsigned();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade'); //onDelete('set ull');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referencias');
    }
};
