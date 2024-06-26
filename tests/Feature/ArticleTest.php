<?php

use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('there is an articles page that shows a list of articles', function () {
    $articles = Article::factory()->count(3)->create();

    $response = get(route('articles.index'));

    $response->assertStatus(Response::HTTP_OK);

    $articles->each(function ($article) use ($response) {
        $response->assertSee($article->title);
    });
});

test('only published articles are visible on the articles page', function () {

    $publishedArticle = Article::factory(['published_at' => now()->subYear()])->create();
    $unpublishedArticle = Article::factory(['published_at' => null])->create();

    $response = get(route('articles.index'));

    $response->assertSee($publishedArticle->title);
    $response->assertDontSee($unpublishedArticle->title);
});

test('there is an article page that displays the article', function () {
    $article = Article::factory()->create();

    $response = get(route('articles.show', $article));

    $response->assertStatus(200);

    $response->assertSee($article->title);
    $response->assertSee($article->content);
    $response->assertSee($article->published_at->diffForHumans());
});

test('only show and index actions actions are currently possible on articles', function () {
    $article = Article::factory()->create();

    get(route('articles.index'))->assertStatus(Response::HTTP_OK);
    get(route('articles.show', $article))->assertStatus(Response::HTTP_OK);
    post('articles/create')->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    post('articles')->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    get("articles/$article->slug/edit")->assertStatus(Response::HTTP_NOT_FOUND);
    put("articles/$article->slug")->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    delete("articles/$article->slug")->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
});

test('articles are paginates', function () {
    Article::factory()->times(10)->create();

    $response = get(route('articles.index'));

    $this->assertInstanceOf(LengthAwarePaginator::class, $response->viewData('articles'));
});
