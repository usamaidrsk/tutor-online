<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => 'Argentina'],
            ['name' => 'Bolivia'],
            ['name' => 'Chile'],
            ['name' => 'Colombia'],
            ['name' => 'Ecuador'],
            ['name' => 'México'],
            ['name' => 'Perú'],
            ['name' => 'España'],
            ['name' => 'Venezuela'],
        ]);
    }
}
