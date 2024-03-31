<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View|Factory
    {
        $articles = Article::published()
            ->orderByDesc('published_at')
            ->paginate(5);

        return view('home', compact('articles'));
    }
}
