<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Curso;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Curso::factory(50)->create();
    }
}
