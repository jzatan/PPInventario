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
            $table->unsignedBigInteger('id_usuario_admin');
            $table->foreign('id_usuario_admin')->references('id')->on('usuarios');
            $table->unsignedBigInteger('id_prestamista');
            $table->foreign('id_prestamista')->references('id')->on('usuarios');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
            $table->string('observaciones', 250);
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
