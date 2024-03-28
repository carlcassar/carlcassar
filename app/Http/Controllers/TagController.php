<?php

namespace App\Http\Controllers;

use App\Models\Article;

class TagController extends Controller
{
    public function index()
    {
        $tags = Article::query()
            ->get('tags')
            ->map(fn (Article $article) => $article->tags)
            ->flatten()
            ->unique()
            ->sortDesc();

        return view('tags.index', compact('tags'));
    }

    public function show(string $tag)
    {
        $articles = Article::published()
            ->where('tags', 'LIKE', '%'.$tag.'%')
            ->orderByDesc('published_at')
            ->paginate(5);

        return view('tags.show', [
            'articles' => $articles,
        ]);
    }
}
