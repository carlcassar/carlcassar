<?php

it('exists as a laravel command', function () {
    $this->artisan('app:markdown-import')->assertSuccessful();
});

it('says that the markdown has been imported', function () {
    $this->artisan('app:markdown-import')->expectsOutput('Markdown Imported!');
});
