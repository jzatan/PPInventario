<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\User;
use App\Models\Equipo;
use App\Models\usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AreaEquipoUsuarioTest extends TestCase
{
    //use RefreshDatabase;  // Limpiar la base de datos entre pruebas

    public function test_creacion_area_usuario_equipo()
    {
        // Crear un área de prueba
        $area = Area::create([
            'nombre_area' => 'Oficina TI',
            'ubicacion' => 'Piso 2, Edificio A',
            'estado' => 1, // Área activa
        ]);

        // Crear un usuario de prueba y asociarlo con el área
        $usuario = usuario::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Gómez',
            'dni' => '12345678', // DNI único
            'telefono' => '987654321',
            'correo' => 'carlos@example.com', // Correo único
            'estado' => 1, // Usuario activo
            'area_id' => $area->id,  // Relación con el área
        ]);

        // Crear un equipo de prueba y asociarlo con el área y el usuario
        $equipo = Equipo::create([
            'categoria_id' => 1, // Suponiendo que tienes una categoría válida
            'usuario_id' => $usuario->id,  // Relación con el usuario
            'nombre_equipo' => 'Laptop Dell',
            'marca' => 'Dell',
            'modelo' => 'Latitude 5500',
            'color' => 'Plata',
            'cod_registro' => 'DELL12345',
            'nro_serie' => 'SN987654321',
            'fecha_adquision' => '2024-11-01',
            'observacion' => 'Equipo en perfecto estado',
            'estado' => 1, // Equipo activo
            'estado_prestamo' => 0, // Equipo disponible para préstamo
            'area_id' => $area->id,  // Relación con el área
        ]);

        // Verificar que el equipo esté asociado con el usuario
        $this->assertEquals($equipo->usuarios->nombres, 'Carlos');
        $this->assertEquals($equipo->usuarios->apellidos, 'Gómez');
        $this->assertEquals($equipo->usuarios->correo, 'carlos@example.com');

        // Verificar que el equipo esté asociado con el área
        $this->assertEquals($equipo->areas->nombre_area, 'Oficina TI');
        $this->assertEquals($equipo->areas->ubicacion, 'Piso 2, Edificio A');

        // Verificar que la base de datos contenga los registros
        $this->assertDatabaseHas('equipos', [
            'cod_registro' => 'DELL12345',
            'nro_serie' => 'SN987654321',
            'estado' => 1,
        ]);

        $this->assertDatabaseHas('usuarios', [
            'correo' => 'carlos@example.com',
            'area_id' => $area->id,
            'dni' => '12345678',
        ]);

        $this->assertDatabaseHas('areas', [
            'nombre_area' => 'Oficina TI',
            'ubicacion' => 'Piso 2, Edificio A',
        ]);
    }
}
