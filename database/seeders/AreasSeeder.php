<?php

namespace Database\Seeders;

use App\Models\area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        area::insert([
            [
                'nombre_area' => 'LOGISTICA',
                'ubicacion' => 'DSRMH - 1ER PISO - JR CUZCO 208'
            ],

            [
                'nombre_area' => 'MANTENIMIENTO',
                'ubicacion' => 'DSRMH - 2DO PISO - JR CUZCO 208'
            ],

            [
                'nombre_area' => 'INFORMATICA',
                'ubicacion' => 'DSRMH - 3ER PISO - JR CUZCO 208'
            ],

            [
                'nombre_area' => 'INFORMATICA',
                'ubicacion' => 'DSRMH - 4TO PISO - JR CUZCO 208'
            ]

        ]);
    }
}
