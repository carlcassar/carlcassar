<?php

use App\Models\Article;
use Cassarco\MarkdownTools\MarkdownFile;
use Illuminate\Support\Carbon;
use Symfony\Component\Yaml\Yaml;

use function Laravel\Prompts\info;

return [

    /*
    |--------------------------------------------------------------------------
    | Schemes
    |--------------------------------------------------------------------------
    |
    | Configure as many "schemes" as you like. Each scheme should contain a
    | path to a single markdown file or a folder containing markdown files.
    |
    */

    'schemes' => [

        // Give each scheme a name for your own organisation.
        'markdown' => [

            // Give the path to a folder of markdown files or a single markdown file.
            'path' => resource_path('markdown'),

            // Specify the validation rules for front-matter properties.
            'rules' => [
                'title' => 'required|string|min:3',
                'description' => 'required|string', //|min:110|max:160',
                'link' => 'required|url',
                'tags' => 'required|array',
                'published_at' => 'required|date',
                'deleted_at' => 'nullable|date',
                'created_at' => 'required|date',
                'updated_at' => 'required|date',
            ],

            // Define a handler for each markdown file. You will have access to file:
            //  - front-matter values
            //  - markdown
            //  - html
            //  - htmlWithToc
            //  - toc
            'handler' => function (MarkdownFile $file) {
                Article::updateOrCreate([
                    'slug' => $file->frontMatter()['slug'] ?? Str::slug($file->frontMatter()['title']),
                ], [
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
            },
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | League/Commonmark Settings
    |--------------------------------------------------------------------------
    |
    | Configure settings for League Commonmark and its extensions.
    |
    */

    'common-mark' => [

        'heading_permalink' => [
            'symbol' => '#',
            'html_class' => 'no-underline mr-2 text-gray-500',
            'aria_hidden' => false,
            'id_prefix' => '',
            'fragment_prefix' => '',
        ],

        'table_of_contents' => [
            'html_class' => 'table-of-contents',
            'position' => 'top',
            'style' => 'bullet',
            'min_heading_level' => 1,
            'max_heading_level' => 6,
            'normalize' => 'relative',
            'placeholder' => null,
        ],

        'wikilinks' => [],

        'front-matter' => [
            'yaml-parse-flags' => Yaml::PARSE_DATETIME,
        ],
    ],
];
