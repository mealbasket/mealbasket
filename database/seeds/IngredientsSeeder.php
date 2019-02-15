<?php

use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ing_units')->insert([
            'unit_short' => 'g',
            'unit_full' => 'grams',
        ]);
        DB::table('ing_units')->insert([
            'unit_short' => 'l',
            'unit_full' => 'litres',
        ]);
        DB::table('ingredients')->insert([
            'name' => 'Salt',
            'unit_id' => '1',
            'price' => '60',
            'base_quantity' => '1',
            'img_path' => 'placeholder',
        ]);
        DB::table('ingredients')->insert([
            'name' => 'Oil',
            'unit_id' => '2',
            'price' => '130',
            'base_quantity' => '1',
            'img_path' => 'placeholder',
        ]);
    }
}
