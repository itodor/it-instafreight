<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CarrierSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ShipmentSeeder::class);
        $this->call(StopSeeder::class);
    }
}
