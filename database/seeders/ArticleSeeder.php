<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory()
            ->count(2)
            ->has(Tag::factory()->count(3))
            ->create([
                'image' => null
            ]);

        Article::factory()
            ->has(Tag::factory()->count(2))
            ->count(10)
            ->create();
    }
}
