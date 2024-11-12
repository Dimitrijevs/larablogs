<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Schema::hasTable('users')) {
            $faker = Faker::create();
            $users = [];

            $users[] = [
                    'name' => 'John Doe',
                    'email' => 'johndoe@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ];

            for ($i = 0; $i < 10; $i++) {
                $users[] = [
                    'name' => 'User ' . $i,
                    'email' => 'user' . $i . '@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ];
            }

            DB::table('users')->insert($users);
        }
    }
}
