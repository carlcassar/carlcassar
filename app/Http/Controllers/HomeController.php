<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredArticle = Article::featured()->orderByDesc('published_at')->first();

        $recentArticles = Article::when($featuredArticle, function (Builder $query) use ($featuredArticle) {
            $query->whereKeyNot($featuredArticle->id);
        })
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('home.index', [
            'featured' => $featuredArticle,
            'articles' => $recentArticles,
        ]);
    }
}
