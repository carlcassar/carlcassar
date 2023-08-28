<?php

namespace Database\Factories;

use App\Models\Article;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Article>
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
            'title' => $title = $this->faker->words(4, true),
            'slug' => Str::slug($title),
            'description' => $this->faker->sentences(1, true),
            'content' => $this->faker->paragraphs(3, true),
            'tags' => collect(Arr::join($this->faker->words(3), ', ')),
            'published_at' => now()->subWeek(),
        ];
    }
}
