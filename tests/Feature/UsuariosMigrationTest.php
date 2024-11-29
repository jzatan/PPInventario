<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsuariosMigrationTest extends TestCase
{
    

    /** @test */
    public function it_checks_if_usuarios_table_exists()
    {
        $this->assertTrue(Schema::hasTable('usuarios'));
    }

    /** @test */
    public function it_checks_columns_in_usuarios_table()
    {
        $columns = [
            'id', 'nombres', 'apellidos', 'dni', 'telefono', 'correo', 
            'estado', 'area_id', 'created_at', 'updated_at'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('usuarios', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_key_in_usuarios_table()
    {
        $this->assertTrue(
            Schema::hasColumn('usuarios', 'area_id'),
            "Foreign key area_id does not exist in usuarios table."
        );
    }

    /** @test */
    public function it_checks_enum_column_estado_in_usuarios_table()
    {
        $this->assertTrue(
            Schema::hasColumn('usuarios', 'estado'),
            "Column estado does not exist in usuarios table."
        );
    }
}
