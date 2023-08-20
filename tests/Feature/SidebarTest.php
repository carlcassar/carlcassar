<?php

use App\Models\Article;
use function Pest\Laravel\get;

test('sidebar tags work as expected', function () {
    $article = Article::factory([
        'tags' => 'laravel',
    ])->create();

    get('/')
        ->assertStatus(200)
        ->assertSee('laravel')
        ->assertDontSee('php');

    get('articles/?tag=laravel')
        ->assertStatus(200)
        ->assertSee($article->title);
});

test('sidebar years work as expected', function () {
    $article = Article::factory([
        'published_at' => $publishedAt = now()->subYears(2),
    ])->create();

    get('/')
        ->assertStatus(200)
        ->assertSee($publishedAt->year)
        ->assertDontSee(now()->years(1));

    get('articles/?year='.$publishedAt->year)
        ->assertStatus(200)
        ->assertSee($article->title);
});
