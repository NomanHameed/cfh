<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class SaleItemSeeder extends Seeder
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
                'name' => "Chicken Shawarma",
                'measurment_unit_id' => 2,
                'price' => 170,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => "Chicken Burger",
                'measurment_unit_id' => 2,
                'price' => 200,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('sale_items')->insert($items);

        $item_details = [
            [
                'name' => "Shawarma Chicken",
                'measurment_unit_id' => 2,
                'price' => 170,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => "Chicken Burger",
                'measurment_unit_id' => 2,
                'price' => 200,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
    }
}
