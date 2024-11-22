<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $user = User::create([

            'usuario_id' => '1',
            'area_id' => '1',
            'name' => 'Administrador Master',
            'email' => 'administrador_master@gmail.com',
            'password' => bcrypt('adminmaste2024@'),

        ]);

        $rol = Role::create(['name' => 'administrador']);
        $permisos = Permission::pluck('id','id')->all();
        $rol->syncPermissions($permisos);
        $user->assignRole('administrador');
    }
}
