<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_names')->insert([
            ['name' => 'Shawarma Chicken'],
            ['name' => 'Burger Shami'],
            ['name' => 'Shawarma Mayonees']
        ]);
    }
}
