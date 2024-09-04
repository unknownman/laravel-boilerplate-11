<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();

        Post::all()->each(function ($post) use ($faker) {
            Comment::factory()->create([
                'post_id' => $post->id,
                'body' => $faker->paragraph,
            ]);
        });
    }
}
