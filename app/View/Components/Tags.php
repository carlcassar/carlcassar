<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tags extends Component
{
    public function render(): View|Closure|string
    {
        $tags = Article::query()
            ->get('tags')
            ->map(fn (Article $article) => $article->tags)
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(5);

        return view('components.tags', [
            'tags' => $tags,
        ]);
    }
}
