<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(AdministratorSeeder::class);
        $this->call(DistributorSeeder::class);
        $this->call(ShopkeeperSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);


        // \App\Models\User::factory(10)->create();
    }
}
