<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Schema::hasTable('comments')) {
            $faker = Faker::create();
            $users = User::all()->pluck('id')->toArray();
            $posts = Post::all()->pluck('id')->toArray();

            $comments = [];
            foreach($posts as $post) {
                for($i = 0; $i < 3; $i++) {
                    $comments[] = [
                        'content' => $faker->text(rand(5, 200)),
                        'user_id' => $faker->randomElement($users),
                        'post_id' => $post,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            DB::table('comments')->insert($comments);
        }
    }
}
