<?php

use Illuminate\Support\Carbon;

it('says that the markdown has been imported', function () {
    $this->assertDatabaseCount('articles', 0);

    $this->artisan('markdown-tools:process')->expectsOutput('Your schemes have all been processed successfully.');

    $this->assertDatabaseHas('articles', [
        'title' => 'Tidying Tips',
        'slug' => 'tidying-tips',
        'tags' => ['php'],
        'published_at' => Carbon::make('2018-08-10 19:19:00'),
        'created_at' => Carbon::make('2018-08-10 19:19:00'),
        'updated_at' => Carbon::make('2018-08-10 19:19:00'),
        'deleted_at' => null,
    ]);
});
