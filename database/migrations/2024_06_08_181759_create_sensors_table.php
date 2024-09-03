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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();

            $table->string('marca');
            $table->string('modelo');
            $table->string('noserie');
            $table->string('tipo');
            $table->string('comentarios')->nullable();
            $table->bigInteger('dispositivo_id')->unsigned();

            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
