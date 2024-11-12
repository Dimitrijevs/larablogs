<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Schema::hasTable('posts')) {
            $faker = Faker::create();
            $users = User::all()->pluck('id')->toArray();

            $posts = [];
            for($i = 0; $i < 40; $i++) {
                $posts[] = [
                    'title' => $faker->words(3, true),
                    'content' => $faker->paragraphs(8, true),
                    'user_id' => $users[array_rand($users)],
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ];
            }

            DB::table('posts')->insert($posts);
        }
    }
}
