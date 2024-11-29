<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AreasMigrationTest extends TestCase
{
    

    /** @test */
    public function it_checks_if_areas_table_exists()
    {
        $this->assertTrue(Schema::hasTable('areas'));
    }

    /** @test */
    public function it_checks_columns_in_areas_table()
    {
        $columns = ['id', 'nombre_area', 'ubicacion', 'estado', 'created_at', 'updated_at'];
        
        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('areas', $column), "Column {$column} does not exist.");
        }
    }
}
