<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $articles = Article::published()
            ->search($request->get('query'))
            ->with('tags')
            ->paginate(5);

        return view('search.index', [
            'articles' => $articles
        ]);
    }
}
