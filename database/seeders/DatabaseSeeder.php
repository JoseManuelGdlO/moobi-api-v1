<?php

namespace Database\Seeders;

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
        $this->call(RolesSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(InventarySeeder::class);
        $this->call(EventPriceSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(EventsSeeder::class);
    }
}
