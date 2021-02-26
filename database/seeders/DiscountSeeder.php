<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $faker->locale('es_MX'); 

        DB::table('discount')->insert([
            'type' => 1,
            'sku' => $faker->swiftBicNumber,
            'percentege' => 0,
            'direct_disc' => 0
        ]);

        DB::table('discount')->insert([
            'type' => 1,
            'sku' => '',
            'percentege' => 10,
            'direct_disc' => 0
        ]);
    }
}
