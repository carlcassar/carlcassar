<?php

namespace Database\Seeders;

use Artisan;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('markdown-tools:process');
    }
}
