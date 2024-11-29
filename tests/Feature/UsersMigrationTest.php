<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsersMigrationTest extends TestCase
{
   

    /** @test */
    public function it_checks_if_users_table_exists()
    {
        $this->assertTrue(Schema::hasTable('users'));
    }

    /** @test */
    public function it_checks_columns_in_users_table()
    {
        $columns = [
            'id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 
            'area_id', 'usuario_id', 'estado', 'created_at', 'updated_at'
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('users', $column), "Column {$column} does not exist.");
        }
    }

    /** @test */
    public function it_checks_foreign_keys_in_users_table()
    {
        $this->assertTrue(
            Schema::hasColumn('users', 'area_id'),
            "Foreign key area_id does not exist."
        );

        $this->assertTrue(
            Schema::hasColumn('users', 'usuario_id'),
            "Foreign key usuario_id does not exist."
        );
    }

    /** @test */
    public function it_checks_enum_column_estado_in_users_table()
    {
        $this->assertTrue(
            Schema::hasColumn('users', 'estado'),
            "Column estado does not exist in users table."
        );
    }
}
