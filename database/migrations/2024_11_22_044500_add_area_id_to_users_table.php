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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade'); // Relación con la tabla areas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['area_id']); // Eliminar la clave foránea
            $table->dropColumn('area_id'); // Eliminar el campo
        });
    }
};
