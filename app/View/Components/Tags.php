<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Str;

class Tags extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tags = Article::get('tags')->map(fn ($article) => $article->tags)->join(', ');

        return view('components.tags', [
            'tags' => Str::of($tags)->explode(', ')->unique(),
        ]);
    }
}
