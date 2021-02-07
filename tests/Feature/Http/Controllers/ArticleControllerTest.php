<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArticleController
 */
class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $articles = Article::factory()->count(3)->create();

        $response = $this->get(route('article.index'));

        $response->assertOk();
        $response->assertViewIs('article.index');
        $response->assertViewHas('tags');
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $article = Article::factory()->create();

        $response = $this->get(route('article.show', $article));

        $response->assertOk();
        $response->assertViewIs('article.create');
    }
}
