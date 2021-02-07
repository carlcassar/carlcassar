<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('search.index', [
            'articles' => Article::when($request->get('query'), function (Builder $query) use ($request) {
                return $query->search($request->get('query'));
            })->with('tags')->paginate(5)
        ]);
    }
}
