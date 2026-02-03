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

test('each tag has its own page where articles for that tag are listed', function () {
    $articleOne = Article::factory()->create(['tags' => collect(['laravel', 'php'])]);
    $articleTwo = Article::factory()->create(['tags' => collect(['javascript', 'vue'])]);

    $response = get(route('tags.show', 'laravel'));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertSeeInOrder(['<h2', $articleOne->title, '</h2>']);

    $response = get(route('tags.show', 'vue'));
    $response->assertStatus(Response::HTTP_OK);
    $response->assertSeeInOrder(['<h2', $articleTwo->title, '</h2>']);
});
