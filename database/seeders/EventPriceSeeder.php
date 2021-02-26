<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class EventPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->locale('es_MX'); 
        DB::table('event_price')->insert([
            'total' => $faker->randomFloat(null, 1000, 9999),
            'tax' => $faker->randomFloat(null, 0, 10),
            'type' => random_int(0, 3),
            'description' => $faker->text(20),
            'pay_numbers' => random_int(0, 12),
            'initial_pay' => $faker->randomFloat(null, 0, 1000),
            'total_cost' => $faker->randomFloat(null, 1000, 9999)
        ]);
    }

}
