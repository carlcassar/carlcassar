<?php

use App\Models\Article;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\get;

test('there is a tags page that shows a list of tags', function () {
    Article::factory()->create(['tags' => collect(['laravel, php'])]);
    Article::factory()->create(['tags' => collect(['javascript, vue'])]);

    $response = get(route('tags.index'));

    $response->assertStatus(Response::HTTP_OK);

    $response->assertSee('laravel');
    $response->assertSee('php');
    $response->assertSee('javascript');
    $response->assertSee('vue');
    $response->assertDontSee('aws');
});

test('each tag its own page where articles for that tag are listed', function () {
    $articleOne = Article::factory()->create(['tags' => collect(['laravel, php'])]);
    $articleTwo = Article::factory()->create(['tags' => collect(['javascript, vue'])]);

    $response = get(route('tags.show', 'laravel'));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertSee(Str::of($articleOne->title)->title());
    $response->assertDontSee(Str::of($articleTwo->title)->title());

    $response = get(route('tags.show', 'vue'));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertDontSee(Str::of($articleOne->title)->title());
    $response->assertSee(Str::of($articleTwo->title)->title());
});
