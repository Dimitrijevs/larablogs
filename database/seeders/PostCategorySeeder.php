<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Schema::hasTable('category_post')) {
            $posts = Post::all()->pluck('id')->toArray();
            $categories = Category::all()->pluck('id')->toArray();

            foreach ($posts as $postId) {
                // Select a random number of categories (e.g., 1 to 3 categories per post)
                $randomCategories = array_rand(array_flip($categories), rand(1, 3));

                // Attach the random categories to the post
                Post::find($postId)->categories()->attach($randomCategories);
            }
        }
    }
}
