<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'short_description' => $this->faker->text(200),
            'content' => $this->faker->paragraphs(3, true),
            'picture' => $this->faker->optional()->imageUrl(640, 480, 'posts', true, 'Faker'),
            'user_id' => \App\Models\User::factory(), // ili $this->faker->numberBetween(1, 10) ako korisnici već postoje
            'published_at' => $this->faker->optional()->dateTime,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Post $post) {
            $category = Category::inRandomOrder()->first();
            $post->categories()->attach($category);
        });
    }
}
