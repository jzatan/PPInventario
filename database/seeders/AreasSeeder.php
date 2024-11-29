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
                'nombre_area' => 'ADMINISTRACION',
                'ubicacion' => 'DSRSMH - ADMIN'

            ],
            [
                'nombre_area' => 'AREA DE LOGISTICA E INFORMATICA',
                'ubicacion' => 'DSRSMH - LOG E INF'
            ],
            [
                'nombre_area' => 'AREA DE RECURSOS HUMANOS',
                'ubicacion' => 'DSRSMH - RRHH'
            ],
            [
                'nombre_area' => 'AREA DE MANTENIMIENTO',
                'ubicacion' => 'DSRSMH - MANT'
            ],
            [
                'nombre_area' => 'ALMACEN',
                'ubicacion' => 'DSRSMH - ALMACEN'
            ]
        ]);
    }
}
