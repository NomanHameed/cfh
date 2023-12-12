<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name'       => 'Customer 1',
                'email'      => 'customer1@example.com',
                'phone'      => '1234567890',
                'address'    => '123 Customer St.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Customer 2',
                'email'      => 'customer2@example.com',
                'phone'      => '0987654321',
                'address'    => '456 Customer Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Customer 3',
                'email'      => 'customer3@example.com',
                'phone'      => '0987654321',
                'address'    => '789 Customer Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        DB::table('customers')->insert($customers);
    }
}
