<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Browsershot\Browsershot;

class GenerateOpenGraphImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        $base64Image = Browsershot::url(route('articles.open-graph-image', $this->article))
            ->devicePixelRatio(2)
            ->windowSize(1200, 630)
            ->base64Screenshot();

        $this->article
            ->addMediaFromBase64($base64Image)
            ->usingFileName("{$this->article->slug}.png")
            ->toMediaCollection('openGraphImage');
    }
}
