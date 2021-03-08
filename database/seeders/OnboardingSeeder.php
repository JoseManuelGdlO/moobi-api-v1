<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class OnboardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $faker->locale('es_MX');

        for ($i = 0; $i < 3; $i++) {
            DB::table('onboarding')->insert([
                'title' => $faker->text(10),
                'description' => $faker->text(50),
                'url_image' => $faker->imageUrl()
            ]);
        }
    }
}
