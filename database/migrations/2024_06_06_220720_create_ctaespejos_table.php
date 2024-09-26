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
        Schema::create('ctaespejos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('usuario');
            $table->string('contrasenia');
            $table->string('comentarios')->nullable();
            $table->bigInteger('cuenta_id')->unsigned();

            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctaespejos');
    }
};
