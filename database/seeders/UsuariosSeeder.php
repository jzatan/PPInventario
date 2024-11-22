<?php

namespace Database\Seeders;

use App\Models\usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        usuario::insert([
            [
                'nombres' => 'ADMINISTRACION',
                'apellidos' => 'MASTER',
                'dni' => '0000000',
                'telefono' => '000000000',
                'correo' => 'example@gmail.com',
                'area_id' => '1',
            ],
        ]);
    }
}
