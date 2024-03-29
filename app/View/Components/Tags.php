<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        $tags = Article::query()
            ->get('tags')
            ->map(fn ($article) => $article->tags)
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(10);

        return view('components.tags', [
            'tags' => $tags,
        ]);
    }
}
