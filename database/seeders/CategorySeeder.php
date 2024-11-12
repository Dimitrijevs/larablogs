<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Schema::hasTable('categories')) {
            $faker = Faker::create();
            
            $categories = [
                [
                    'name' => 'PHP',
                ],
                [
                    'name' => 'JavaScript',
                ],
                [
                    'name' => 'Go',
                ],
                [
                    'name' => 'React',
                ],
                [
                    'name' => 'Laravel',
                ],
                [
                    'name' => 'Rust',
                ]
            ];

            foreach ($categories as $key => $category) {
                $categories[$key]['created_at'] = $faker->dateTimeBetween('-1 year', 'now');
                $categories[$key]['updated_at'] = $faker->dateTimeBetween('-1 year', 'now');
            }

            DB::table('categories')->insert($categories);
        }
    }
}
