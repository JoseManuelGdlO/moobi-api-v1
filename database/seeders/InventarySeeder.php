<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class InventarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker->locale('es_MX'); 
        for ($i = 0; $i < 10; $i++) {
            DB::table('inventary')->insert([
                'name' => $faker->name,
                'cost' => $faker->randomFloat(null, 0, 99),
                'quantity' => random_int(0, 99),
                'description' => $faker->text(60),
                'sku' => random_int(0,10000),
                'image_url' => $faker->imageUrl(640, 480),
                'ceation_date' => now(),
                'update' => now(),
                'in_inventary' => random_int(0, 99),
                'eliminated' => 0,
                'fk_business_id' => 1,
            ]);
        }
    }
}
