<?php

use App\Models\Article;
use Illuminate\Support\Carbon;

test('there is an articles page that shows a list of articles', function () {
    $article = Article::factory()->create();

    $response = $this->get(route('articles.index'));

    $response->assertStatus(200);

    $response->assertSee($article->title);
    $response->assertSee($article->content);
    $response->assertSee($article->created_at->diffForHumans());
    $response->assertSee(Str::of($article->tags)->explode(',')->first());
});

test('only published articles are visible on the articles page', function () {

    $publishedArticle = Article::factory(['published_at' => now()->subYear()])->create();
    $unpublishedArticle = Article::factory(['published_at' => null])->create();

    $response = $this->get(route('articles.index'));

    $response->assertSee($publishedArticle->title);
    $response->assertDontSee($unpublishedArticle->title);
});

test('there is an article page that displays the article', function () {
    $article = Article::factory()->create();

    $response = $this->get(route('articles.show', $article));

    $response->assertStatus(200);

    $response->assertSee($article->title);
    $response->assertSee($article->content);
    $response->assertSee($article->created_at->diffForHumans());
    $response->assertSee(Str::of($article->tags)->explode(',')->first());
});
