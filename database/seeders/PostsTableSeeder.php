<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();

        foreach (range(1, 50) as $index) {
            Post::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'slug' => $faker->slug(),
                'content' => $faker->paragraphs(rand(3, 6), true),
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
