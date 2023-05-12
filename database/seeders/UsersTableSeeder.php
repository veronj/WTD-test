<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed 20 users with random data, pick random data for each field in migration
        //pick a random date between now and 2 years ago for the published_at field

        $faker = \Faker\Factory::create('fr_FR');
        $users = \App\Models\User::factory()->count(20)->make()->each(function ($user) use ($faker) {
            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->email_verified_at = $faker->dateTimeBetween('-2 years');
            $user->password = $faker->password();
            $user->save();
        });
    }
}
