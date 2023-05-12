<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seed 10 programs with random data, for field name, pick a random value from the MARKET_STATUS constant,
        // and for the published_at field,
        // pick a random date between now and 2 years ago.
        // pick a random city

        $faker = \Faker\Factory::create('fr_FR');
        $programs = \App\Models\Program::factory()->count(10)->make()->each(function ($program) use ($faker) {
            $program->name = $faker->name();
            $program->market_status = $faker->randomElement(\App\Models\Program::MARKET_STATUS);
            $program->published_at = $faker->dateTimeBetween('-2 years');
            $program->city = $faker->city();
            $program->address = $faker->streetAddress();
            $program->zip_code = $faker->postcode();
            $program->delivery_date = $faker->dateTimeBetween('+1 year', '+2 years');
            $program->save();
        });
    }
}
