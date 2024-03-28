<?php

namespace App\Http\Controllers;

use App\Models\Article;

class YearController extends Controller
{
    public function show(string $year)
    {
        $articles = Article::published()
            ->whereYear('published_at', $year)
            ->orderByDesc('published_at')
            ->paginate(5);

        return view('years.show', [
            'articles' => $articles,
        ]);
    }
}
