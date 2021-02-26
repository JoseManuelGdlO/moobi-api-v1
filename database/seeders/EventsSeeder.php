<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $faker->locale('es_MX'); 

        DB::table('events')->insert([
            'name_event' => $faker->name,
            'description' => $faker->text(100),
            'event_date' => now(),
            'event_delivery' => now(),
            'event_recolected' => now(),
            'hour_delivery' => $faker->time('H:i:s', 'now'),
            'hour_recolected' => $faker->time('H:i:s', 'now'),
            'hour_date' => $faker->time('H:i:s', 'now'),
            'aux_phone_number' => $faker->tollFreePhoneNumber,
            'references' => $faker->streetName,
            'status' => 'initial',
            'comment'=> $faker->text(50),
            'fk_business_id' => 1,
            'fk_price_id' => 1,
            'fk_discount_id' => 1,
            'fk_client_id' => 1,
            'fk_address_id' => 1,
        ]);
    }

}
