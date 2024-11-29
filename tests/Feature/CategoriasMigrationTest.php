<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoriasMigrationTest extends TestCase
{
  

    /** @test */
    public function it_checks_if_categorias_table_exists()
    {
        $this->assertTrue(Schema::hasTable('categorias'));
    }

    /** @test */
    public function it_checks_columns_in_categorias_table()
    {
        $columns = ['id', 'nombre_categoria', 'estado', 'created_at', 'updated_at'];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('categorias', $column), "Column {$column} does not exist.");
        }
    }
}
