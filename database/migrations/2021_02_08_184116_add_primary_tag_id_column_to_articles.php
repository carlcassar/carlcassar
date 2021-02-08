<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryTagIdColumnToArticles extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('primary_tag_id')
                ->after('id')
                ->nullable()
                ->constrained('tags');
        });
    }
}
