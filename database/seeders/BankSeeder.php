<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
        	['title' => 'Al Baraka Bank (Pakistan) Limited'],
        	['title' => 'Allied Bank Limited (ABL)'],
        	['title' => 'Askari Bank'],
        	['title' => 'Bank Alfalah Limited (BAFL)'],
        	['title' => 'Bank Al-Habib Limited (BAHL)'],
        	['title' => 'BankIslami Pakistan Limited'],
        	['title' => 'Bank of Punjab (BOP)'],
        	['title' => 'Bank of Khyber'],
        	['title' => 'Dubai Islamic Bank Pakistan'],
        	['title' => 'Faysal Bank Limited (FBL)'],
        	['title' => 'Habib Bank Limited (HBL)'],
        	['title' => 'Habib Metropolitan Bank Limited'],
        	['title' => 'JS Bank Limited'],
        	['title' => 'MCB Bank Limited'],
        	['title' => 'MCB Islamic Bank Limited'],
        	['title' => 'Meezan Bank Limited'],
        	['title' => 'National Bank of Pakistan (NBP)'],
        	['title' => 'Summit Bank Pakistan'],
        	['title' => 'Standard Chartered Bank Pakistan'],
        	['title' => 'United Bank Limited'],
        	['title' => 'Zarai Taraqiati Bank Limited']
        ]);
    }
}