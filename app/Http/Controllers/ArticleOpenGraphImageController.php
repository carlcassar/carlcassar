<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleOpenGraphImageController extends Controller
{
    public function __invoke(Article $article)
    {
        return view('components.articles.open-graph-image', [
            'article' => $article,
        ]);
    }
}
