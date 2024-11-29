<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permisos = [
            //areas
            'ver-areas',
            'store-areas',
            'update-areas',
            'delete-areas',

            //componentes
            'create-componentes',
            'store-componentes',
            'update-componentes',
            'delete-componentes',

            //equipos
            'ver-equipos',
            'ver-equipos-disponibles-prestamos',
            'ver-equipos-registrados-administrador',
            'create-equipos',
            'store-equipos',
            'update-equipos',
            'edit-equipos',
            'delete-equipos',

            //prestamos
            'ver-prestamos',
            'create-prestamos',
            'store-prestamos',
            'edit-prestamos',
            'update-prestamos',
            'delete-prestamos',

            //users
            'ver-usuarios',
            'store-usuarios',
            'update-usuarios',
            'delete-usuarios',

            //empleados
            'ver-empleados',
            'store-empleados',
            'edit-empleados',
            'update-empleados',
            'delete-empleados',


            //mantenimientos

            'ver-mantenimientos',
            'ver-mantenimientos-generales',
            'create-mantenimientos',
            'store-mantenimientos',
            'edit-mantenimeintos',
            'update-mantenimientos',

            //role
            'ver-roles',
            'create-roles',
            'store-roles',
            'editar-roles',
            'update-roles',
            'delete-roles'

        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
        
    }
}
