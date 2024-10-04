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
        Schema::create('mantenimiento_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_envio');
            $table->date('fecha_retorno');
            $table->string('problema', 300);
            $table->string('diagnostico', 300);
            $table->tinyInteger('estado_mantenimiento')->default(1);
            $table->string('observaciones', 250);
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
        Schema::dropIfExists('mantenimiento_detalles');
    }
};
