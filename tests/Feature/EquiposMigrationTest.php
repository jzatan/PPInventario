<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EquiposMigrationTest extends TestCase
{
    

    /** @test */
    public function it_checks_if_equipos_table_exists()
    {
        $this->assertTrue(Schema::hasTable('equipos'));
    }

    /** @test */
    public function it_checks_columns_in_equipos_table()
    {
        $columns = [
            'id', 'categoria_id', 'usuario_id', 'nombre_equipo', 'marca', 'modelo',
            'color', 'cod_registro', 'ord_compra', 'nro_serie', 'fecha_adquision', 
            'observacion', 'estado', 'estado_prestamo', 'created_at', 'updated_at', 'area_id'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('equipos', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_keys_in_equipos_table()
    {
        $this->assertTrue(
            Schema::hasColumn('equipos', 'categoria_id'),
            "Foreign key categoria_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('equipos', 'usuario_id'),
            "Foreign key usuario_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('equipos', 'area_id'),
            "Foreign key area_id does not exist."
        );
    }
}
