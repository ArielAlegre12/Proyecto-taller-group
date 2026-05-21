<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_productos')->insert([
            ['nombre' => 'Alimentos'],
            ['nombre' => 'Juguetes'],
            ['nombre' => 'Accesorios'],
            ['nombre' => 'Higiene'],
            ['nombre' => 'Salud']
        ]);
    }
}
