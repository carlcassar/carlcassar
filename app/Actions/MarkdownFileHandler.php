<?php

namespace App\Actions;

use App\Models\Article;
use Cassarco\MarkdownTools\Contracts\MarkdownFileHandler as MarkdownFileHandlerContract;
use Cassarco\MarkdownTools\MarkdownFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function Laravel\Prompts\info;

class MarkdownFileHandler implements MarkdownFileHandlerContract
{
    public function __invoke(MarkdownFile $file): void
    {
        Article::updateOrCreate([
            'uuid' => $file->frontMatter()['uuid'],
        ], [
            'uuid' => $file->frontMatter()['uuid'],
            'title' => $file->frontMatter()['title'],
            'slug' => $file->frontMatter()['slug'] ?? Str::slug($file->frontMatter()['title']),
            'description' => $file->frontMatter()['description'],
            'table_of_contents' => $file->toc(),
            'content' => $file->html(),
            'image' => $file->frontMatter()['image'],
            'tags' => collect($file->frontMatter()['tags']),
            'published_at' => Carbon::make($file->frontMatter()['published_at']),
            'deleted_at' => Carbon::make($file->frontMatter()['deleted_at']),
            'created_at' => Carbon::make($file->frontMatter()['created_at']),
            'updated_at' => Carbon::make($file->frontMatter()['updated_at']),
        ]);

        info("Processing {$file->frontMatter()['title']}");
    }
}
