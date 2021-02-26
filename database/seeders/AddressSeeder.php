<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->locale('es_MX'); 
        DB::table('address')->insert([
            'state' => 'Durango',
            'country' => 'Mexico',
            'street' =>$faker->streetAddress,
            'number' => random_int(0, 300),
            'suburb' =>$faker->streetSuffix,
            'int_number' => 0,
            'references' => $faker->secondaryAddress,
            'fk_client_id' => 1
        ]);
    }
}
