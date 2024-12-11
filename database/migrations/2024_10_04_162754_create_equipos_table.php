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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
            $table->string('nombre_equipo', 255);
            $table->string('marca', 30);
            $table->string('modelo', 30);
            $table->string('color',30);
            $table->string('cod_registro', 20)->unique();
            $table->string('ord_compra',30)->nullable();
            $table->string('nro_serie', 20);
            $table->date('fecha_adquision');
            $table->string('observacion', 250)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->tinyInteger('estado_prestamo')->default(1);
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
        Schema::dropIfExists('equipos');
    }
};
