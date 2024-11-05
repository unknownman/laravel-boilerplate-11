<?php

namespace Database\Seeders;

use App\Models\Page;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();

        Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'content' => $faker->paragraphs(rand(3, 6), true),
        ]);

        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => $faker->paragraphs(rand(3, 6), true),
        ]);
    }
}
