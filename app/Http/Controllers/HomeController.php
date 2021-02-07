<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home.index', [
            'featured' => Article::featured()->first(),
            'articles' => Article::notFeatured()->limit(4)->get()
        ]);
    }
}
