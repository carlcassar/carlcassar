<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(): View
    {
        return view('tags.index', [
            'tags' => Tag::whereHas('articles')->get(),
        ]);
    }

    public function show(Tag $tag)
    {
        return view('tags.show', [
            'tags' => Tag::whereHas('articles')->get(),
            'tag' => $tag
        ]);
    }
}
