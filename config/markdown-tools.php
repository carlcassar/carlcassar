<?php

use App\Actions\MarkdownFileHandler;
use App\Actions\MarkdownFileRules;
use Symfony\Component\Yaml\Yaml;

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

        'default' => [
            'path' => resource_path('markdown'),
            'rules' => MarkdownFileRules::class,
            'handler' => MarkdownFileHandler::class,
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
