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
        Schema::create('universidades', function (Blueprint $table) {
            $table->increments('nit');
            $table->string('nombre')->unique();
            $table->string('direccion');
            $table->string('email');
            $table->string('fecha');
            $table->string('telefono');
            $table->integer('capacidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universidades');
    }
};
