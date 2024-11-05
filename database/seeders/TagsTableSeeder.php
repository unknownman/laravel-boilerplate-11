<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = Factory::create();

        Tag::create([
            'name' => 'Technology',
        ]);

        Tag::create([
            'name' => 'Laravel',
        ]);

        Tag::create([
            'name' => 'PHP',
        ]);

        // Generate 10 more tags
        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->word,
            ]);
        }
    }
}
