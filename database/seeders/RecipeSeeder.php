<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
                'recipe_name_id' => 1,
                'quantity' => 10,
                'status' => 'Pending',
                'date' => Carbon::now()->timestamp,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

        Recipe::insert($items);
    }
}
