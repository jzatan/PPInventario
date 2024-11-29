<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ComponentesMigrationTest extends TestCase
{
   

    /** @test */
    public function it_checks_if_componentes_table_exists()
    {
        $this->assertTrue(Schema::hasTable('componentes'));
    }

    /** @test */
    public function it_checks_columns_in_componentes_table()
    {
        $columns = ['id', 'equipo_id', 'nombre_componente', 'descripcion', 'estado', 'created_at', 'updated_at'];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('componentes', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_key_in_componentes_table()
    {
        $this->assertTrue(
            Schema::hasColumn('componentes', 'equipo_id'),
            "Foreign key equipo_id does not exist."
        );
    }
}
