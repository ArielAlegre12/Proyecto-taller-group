<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaAnimalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_animales')->insert([
            ['nombre' => 'Perro'],
            ['nombre' => 'Gato'],
            ['nombre' => 'Pez'],
            ['nombre' => 'Caballo'],
            ['nombre' => 'Vaca'],
            ['nombre' => 'oveja']
        ]);
    }
}
