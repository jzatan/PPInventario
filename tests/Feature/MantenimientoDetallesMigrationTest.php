<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MantenimientoDetallesMigrationTest extends TestCase
{

    /** @test */
    public function it_checks_if_mantenimiento_detalles_table_exists()
    {
        $this->assertTrue(Schema::hasTable('mantenimiento_detalles'));
    }

    /** @test */
    public function it_checks_columns_in_mantenimiento_detalles_table()
    {
        $columns = [
            'id', 'fecha_envio', 'fecha_retorno', 'problema', 'diagnostico', 'estado_mantenimiento', 'observaciones', 'created_at', 'updated_at'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_column_data_types_in_mantenimiento_detalles_table()
    {
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'fecha_envio'));
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'fecha_retorno'));
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'problema'));
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'diagnostico'));
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'estado_mantenimiento'));
        $this->assertTrue(Schema::hasColumn('mantenimiento_detalles', 'observaciones'));
    }
}
