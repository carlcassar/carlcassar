<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tags = Article::query()
            ->get('tags')
            ->map(fn ($article) => $article->tags)
            ->flatten()
            ->unique()
            ->sortDesc();

        return view('tags.index', compact('tags'));
    }
}
