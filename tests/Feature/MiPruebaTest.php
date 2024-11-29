<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    //use RefreshDatabase;  // Se usa para restablecer la base de datos entre las pruebas

    public function test_user_creation()
    {
        // Crear un usuario de prueba
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
            'area_id' => 1, // Suponiendo que tienes un area_id válido
            'usuario_id' => 1, // Suponiendo que tienes un usuario_id válido
            'estado' => 1, // Usuario activo
        ]);

        // Verificar que el usuario ha sido creado
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'name' => 'Test User',
        ]);
    }
}
