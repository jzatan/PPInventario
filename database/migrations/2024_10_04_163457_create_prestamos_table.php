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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('id_prestador_area');
            $table->foreign('id_prestador_area')->references('id')->on('areas');
            $table->unsignedBigInteger('id_prestario');
            $table->foreign('id_prestario')->references('id')->on('usuarios');
            $table->string('cod_prestamo',10);
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
            $table->string('observaciones', 250)->nullable();
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
        Schema::dropIfExists('prestamos');
    }
};
