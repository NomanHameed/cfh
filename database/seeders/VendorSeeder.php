<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = [
            [
                'name'       => 'Vendor 1',
                'email'      => 'vendor1@example.com',
                'phone'      => '1234567890',
                'address'    => '123 Vendor St.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Vendor 2',
                'email'      => 'vendor2@example.com',
                'phone'      => '0987654321',
                'address'    => '456 Vendor Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Vendor 3',
                'email'      => 'vendor3@example.com',
                'phone'      => '0987654321',
                'address'    => '789 Vendor Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        DB::table('vendors')->insert($vendors);
    }
}