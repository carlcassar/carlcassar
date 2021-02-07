<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        return view('articles.index', [
            'articles' => Article::with('tags')->get()
        ]);
    }

    public function show(Request $request, Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }
}
