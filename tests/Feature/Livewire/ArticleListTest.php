<?php

use App\Livewire\ArticleList;
use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;

it('renders successfully', function () {
    Livewire::test(ArticleList::class)
        ->assertStatus(Response::HTTP_OK);
});

it('displays all published articles', function () {
    Article::factory()->published()->count(2)->create();

    Livewire::test(ArticleList::class)
        ->assertViewHas('articles', function ($articles) {
            return $articles && $articles->total() == 2;
        });
});

it('returns a paginated list of articles', function () {
    Livewire::test(ArticleList::class)
        ->assertViewHas('articles', function ($articles) {
            return $articles instanceof LengthAwarePaginator;
        });
});

it('will filter articles by year if a year is present in the query string', function () {
    $articlePublishedTwoYearsAgo = Article::factory()->create([
        'published_at' => now()->subYears(2),
    ]);

    $articlePublishedOneYearAgo = Article::factory()->create([
        'published_at' => now()->subYears(1),
    ]);

    Livewire::withQueryParams(['year' => now()->subYears(2)->year])
        ->test(ArticleList::class)
        ->assertViewHas('articles', function ($articles) use ($articlePublishedTwoYearsAgo, $articlePublishedOneYearAgo) {
            expect($articles->total())
                ->toBe(1)
                ->and($articles->first()->title)
                ->toBe($articlePublishedTwoYearsAgo->title)
                ->and($articles->first()->title)
                ->not()
                ->toBe($articlePublishedOneYearAgo->title);

            return true;
        });
});

it('will filter articles by tag if a tag is present in the query string', function () {
    $articleWithPHPTag = Article::factory()->create([
        'tags' => collect(['php']),
    ]);

    $articleWithLaravelTag = Article::factory()->create([
        'tags' => collect(['laravel']),
    ]);

    Livewire::withQueryParams(['tag' => 'laravel'])
        ->test(ArticleList::class)
        ->assertViewHas('articles', function ($articles) use ($articleWithLaravelTag, $articleWithPHPTag) {
            expect($articles->first()->tags)
                ->toMatchArray($articleWithLaravelTag->tags)
                ->and($articles->first()->tags)
                ->not()
                ->toMatchArray($articleWithPHPTag->tags);

            return true;
        });
});
