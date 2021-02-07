<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'cc:generate-sitemap';

    protected $description = 'Generate a sitemap for this site.';

    public function handle()
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
    }
}
