<?php

use App\Models\Article;

return [
    'feeds' => [
        'main' => [
            'items' => Article::class . '@getFeedItems',
            'url' => '/feed',
            'title' => 'carlcassar.com',
            'description' => 'All articles at carlcassar.com.',
            'language' => 'en-UK',
            'view' => 'feed::atom',
            'type' => 'application/atom+xml',
        ],
        'featured' => [
            'items' => Article::class . '@getFeaturedFeedItems',
            'url' => '/feed/featured',
            'title' => 'carlcassar.com - Featured',
            'description' => 'Featured articles at carlcassar.com.',
            'language' => 'en-UK',
            'view' => 'feed::atom',
            'type' => 'application/atom+xml',
        ],
    ],
];
