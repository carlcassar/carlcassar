<?php

namespace App\Actions;

use Cassarco\MarkdownTools\Contracts\MarkdownFileRules as MarkdownFileRulesContract;

class MarkdownFileRules implements MarkdownFileRulesContract
{
    public function __invoke(): array
    {
        return [
            'uuid' => 'required|uuid',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:110|max:160',
            'link' => 'required|url',
            'tags' => 'required|array',
            'published_at' => 'required|date',
            'deleted_at' => 'nullable|date',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ];
    }
}
