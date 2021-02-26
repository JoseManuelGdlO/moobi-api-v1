<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->locale('es_MX'); 
        DB::table('business')->insert([
            'state' => $faker->state,
            'address' => $faker->address,
            'phone_number' => $faker->tollFreePhoneNumber,
            'image_logo' => $faker->imageUrl(640, 480),
            'country' => $faker->country,
            'description' => $faker->text,
            'creation_date' => now(),
        ]);
    }
}
