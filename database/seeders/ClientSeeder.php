<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->locale('es_MX'); 
        DB::table('client')->insert([
            'name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone_number' => $faker->tollFreePhoneNumber,
            'email' => $faker->unique()->email,
            'fk_business_id' => 1
        ]);
    }
}
