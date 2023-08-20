<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Years extends Component
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
        return view('components.years', [
            'years' => Article::query()
                ->published()
                ->get('published_at')
                ->map(fn ($article) => $article->published_at)
                ->filter()
                ->map(fn ($date) => $date->format('Y'))
                ->unique()
                ->sortDesc(),
        ]);
    }
}
