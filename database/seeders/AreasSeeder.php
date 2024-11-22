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
                'ubicacion' => '-'
            ],
        ]);
    }
}
