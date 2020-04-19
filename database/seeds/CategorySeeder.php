<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Álgebra'],
            ['name' => 'Geometría'],
            ['name' => 'Aritmética'],
            ['name' => 'Trigonometría'],
            ['name' => 'Razonamiento Matemático'],
            ['name' => 'Física'],
            ['name' => 'Química'],
        ]);
    }
}
