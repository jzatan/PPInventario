<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->foreignId('mantenimiento_detalle_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario_mantenimiento');
            $table->foreign('id_usuario_mantenimiento')->references('id')->on('usuarios');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
};
