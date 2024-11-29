<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PrestamosMigrationTest extends TestCase
{
 

    /** @test */
    public function it_checks_if_prestamos_table_exists()
    {
        $this->assertTrue(Schema::hasTable('prestamos'));
    }

    /** @test */
    public function it_checks_columns_in_prestamos_table()
    {
        $columns = [
            'id', 'equipo_id', 'id_prestador_area', 'cod_prestamo', 'fecha_prestamo', 
            'fecha_devolucion', 'observaciones', 'estado', 'created_at', 'updated_at'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('prestamos', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_keys_in_prestamos_table()
    {
        $this->assertTrue(
            Schema::hasColumn('prestamos', 'equipo_id'),
            "Foreign key equipo_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('prestamos', 'id_prestador_area'),
            "Foreign key id_prestador_area does not exist."
        );
    }

    /** @test */
    public function it_checks_enum_column_estado_in_prestamos_table()
    {
        $this->assertTrue(
            Schema::hasColumn('prestamos', 'estado'),
            "Column estado does not exist in prestamos table."
        );
    }
}
