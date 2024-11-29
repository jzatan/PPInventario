<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MantenimientosMigrationTest extends TestCase
{
    
    /** @test */
    public function it_checks_if_mantenimientos_table_exists()
    {
        $this->assertTrue(Schema::hasTable('mantenimientos'));
    }

    /** @test */
    public function it_checks_columns_in_mantenimientos_table()
    {
        $columns = [
            'id', 'equipo_id', 'mantenimiento_detalle_id', 'id_usuario_mantenimiento', 'estado', 'created_at', 'updated_at'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('mantenimientos', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_keys_in_mantenimientos_table()
    {
        $this->assertTrue(
            Schema::hasColumn('mantenimientos', 'equipo_id'),
            "Foreign key equipo_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('mantenimientos', 'mantenimiento_detalle_id'),
            "Foreign key mantenimiento_detalle_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('mantenimientos', 'id_usuario_mantenimiento'),
            "Foreign key id_usuario_mantenimiento does not exist."
        );
    }
}
