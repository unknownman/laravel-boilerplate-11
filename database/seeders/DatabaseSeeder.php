<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.lo',
            'mobile' => "091111111",
            "password" => Hash::make("123456")
        ]);

        $this->call([
            PostsTableSeeder::class,
            PagesTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}
