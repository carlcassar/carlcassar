<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Article;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'primary_tag_id' => Tag::factory(),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'body' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'icon' => $this->faker->randomElement([
                'bar-chart-fill',
                'twitter',
                'asterisk',
                'at',
                'award',
                'book-fill',
                'bug',
                'calendar-date-fill'
            ]),
            'featured' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
