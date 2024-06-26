<?php

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\info;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('articles', 'uuid')) {
            info('Articles are using UUIDs for identification.');

            return;
        }

        if (! app()->environment('testing')) {
            Article::truncate();
        }

        Schema::table('articles', function (Blueprint $table) {
            $table->uuid()->after('id')->unique();
        });

        if (! app()->environment('testing')) {
            Artisan::call('markdown-tools:process');
        }
    }
};
