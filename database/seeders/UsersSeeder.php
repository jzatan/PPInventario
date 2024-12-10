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
    public function run(): void
    {
        $user = User::create([

            'usuario_id' => '1',
            'area_id' => '1',
            'name' => 'Jorge Miguel Zatan Aponte',
            'email' => 'administracion@gmail.com',
            'password' => bcrypt('administrador2024@'),

        ]);

        $rol = Role::create(['name' => 'administrador']);
        $permisosespecificos = [
            'ver-areas',
            'store-areas',
            'update-areas',
            'delete-areas',
            'ver-equipos',
            'ver-equipos-disponibles-prestamos',
            'ver-prestamos',
            'create-prestamos',
            'store-prestamos',
            'edit-prestamos',
            'update-prestamos',
            'delete-prestamos',
            'ver-usuarios',
            'store-usuarios',
            'update-usuarios',
            'delete-usuarios',
            'ver-empleados',
            'store-empleados',
            'edit-empleados',
            'update-empleados',
            'delete-empleados',
            'ver-mantenimientos',
            'ver-roles',
            'create-roles',
            'store-roles',
            'editar-roles',
            'update-roles',
            'delete-roles'
        ];
        foreach ($permisosespecificos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Obtener los permisos específicos y asignarlos al rol
        $permisos = Permission::whereIn('name', $permisosespecificos)->get();
        $rol->syncPermissions($permisos);
        $user->assignRole('administrador');
    }
}
