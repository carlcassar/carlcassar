<?php

use App\Models\Article;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\get;

test('each year has its own page where articles for that year are listed', function () {
    $articleOne = Article::factory()->create(['published_at' => now()]);
    $articleTwo = Article::factory()->create(['published_at' => now()->subYear()]);

    $response = get(route('years.show', now()->year));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertSee(Str::of($articleOne->title)->title());
    $response->assertDontSee(Str::of($articleTwo->title)->title());

    $response = get(route('years.show', now()->subYear()->year));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertDontSee(Str::of($articleOne->title)->title());
    $response->assertSee(Str::of($articleTwo->title)->title());
});
