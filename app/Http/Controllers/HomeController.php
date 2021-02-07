<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'articles' => Article::featured()->limit(5)->get()
        ]);
    }
}
