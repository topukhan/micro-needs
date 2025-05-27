<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'            => fake()->words(3, true),
            'slug'             => fake()->unique()->slug(),
            'excerpt'          => fake()->sentence(10),
            'content'          => fake()->paragraphs(3, true),
            'featured_image'   => $this->imageUrl(),
            'user_id'          => User::factory(),
            'is_published'     => fake()->boolean(80),
            'published_at'     => fake()->dateTimeBetween('-1 year'),
            'view_count'       => fake()->numberBetween(0, 10000),
            'meta_title'       => fake()->words(3, true),
            'meta_description' => fake()->sentence(15),
        ];
    }

    private function imageUrl($width = 640, $height = 480, $text = null, $font = 'poppins'): string
    {
        $word = ucfirst($text ?? fake()->word());
        return "https://placehold.co/{$width}x{$height}?text={$word}&font={$font}";
    }
}
