<?php

namespace Database\Seeders;

use App\Models\categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // aqui colocas la logica de la tabla
        categoria::insert([
            [
                'nombre_categoria' => 'Dispositivos de Entrada'
            ],

            [
                'nombre_categoria' => 'Dispositivos de Procesamiento'
            ],

            [
                'nombre_categoria' => 'Dispositivos de Salida'
            ]

        ]);
    }
}