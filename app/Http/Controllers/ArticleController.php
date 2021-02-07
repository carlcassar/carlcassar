<?php

namespace App\Http\Controllers;

use App\Models\Article;
use \Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('articles.index', [
            'articles' => Article::published()
                ->with('tags')
                ->paginate(5)
        ]);
    }

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
            'similarArticles' => Article::published()->similarTo($article)->limit(2)->get()
        ]);
    }
}
