<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $shops[] = [
                'name'          => "Shop Name $i",
                'owner_name'    => "Owner Name $i",
                'mobile_number' => "0300676544 $i",
                'address'       => "Shop Address $i",
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }
        DB::table('shops')->insert($shops);
    }
}
