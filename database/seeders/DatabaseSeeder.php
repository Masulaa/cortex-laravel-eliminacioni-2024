<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kreiraj kategorije
        $categories = ['food', 'cars', 'gaming', 'fashion'];
        foreach ($categories as $categoryName) {
            Category::factory()->create(['name' => $categoryName]);
        }

        // Kreiraj postove
        Post::factory(10)->create();

        User::factory(5)->create();
    }
}
