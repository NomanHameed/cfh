<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $items = [
                [
                    'name' => "Bonless Chicken",
                    'measurment_unit_id' => 1,
                    'status' => 'Active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],                [
                    'name' => "Shawarma Bread",
                    'measurment_unit_id' => 2,
                    'status' => 'Active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name' => "Chicken Chest Piece",
                    'measurment_unit_id' => 1,
                    'status' => 'Active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name' => "Red Chili",
                    'measurment_unit_id' => 1,
                    'status' => 'Active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ];

        DB::table('purchase_items')->insert($items);
    }
}
