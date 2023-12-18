<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(RecipeNameSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(MeasurmentUnitSeeder::class);
        $this->call(PurchaseItemSeeder::class);
        $this->call(SaleItemSeeder::class);
        // $this->call(VendorSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(WorkerSeeder::class);
    }
}
