<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagController extends Controller
{
    public function index(): View
    {
        return view('tags.index', [
            'tags' => Tag::forPublishedArticles()->get(),
        ]);
    }

    public function show(Tag $tag)
    {
        $tags = Tag::forPublishedArticles()->with('articles', function (BelongsToMany $query) {
            $query->published();
        })->get();

        return view('tags.show', [
            'tags' => $tags,
            'tag' => $tag
        ]);
    }
}
