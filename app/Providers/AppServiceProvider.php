<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('recents', $this->recents());
        View::share('tags', $this->allTags());
        View::share('years', $this->allYears());
    }

    public function allTags()
    {
        $tags = Article::get('tags')->map(fn ($article) => $article->tags)->join(', ');

        return Str::of($tags)->explode(', ')->unique();
    }

    public function allYears()
    {
        return Article::get('created_at')
            ->map(fn ($article) => $article->created_at)
            ->filter()
            ->map(fn ($date) => $date->format('Y'))
            ->unique();
    }

    public function recents()
    {
        return Article::query()
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();
    }
}
