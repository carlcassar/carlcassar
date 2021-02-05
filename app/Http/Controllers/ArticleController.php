<?php

namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function __invoke()
    {
        return view('articles');
    }
}
