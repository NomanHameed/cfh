<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workers = [
            [
                'name'       => 'Worker 1',
                'email'      => 'worker1@example.com',
                'phone'      => '1234567890',
                'address'    => '123 Worker St.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Worker 2',
                'email'      => 'worker2@example.com',
                'phone'      => '0987654321',
                'address'    => '456 Worker Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name'       => 'Worker 3',
                'email'      => 'worker3@example.com',
                'phone'      => '0987654321',
                'address'    => '789 Worker Ave.',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        DB::table('workers')->insert($workers);
    }
}
