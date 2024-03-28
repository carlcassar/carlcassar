<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View|Factory
    {
        return view('home', [
            'articles' => Article::published()->paginate(5),
        ]);
    }
}
