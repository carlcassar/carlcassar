<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all user settings', function () {
    $settings = $this->user->settings()->all();

    expect($settings)->toEqual([
        'notifications' => [
            'new_article_published' => true,
        ],
    ]);
});

it('can get a setting using dot notation', function () {
    $settings = $this->user->settings()->get('notifications.new_article_published');

    expect($settings)->toEqual(true);
});

it('can be passed an array to set all settings', function () {
    $this->user->settings()->set($settings = [
        'notifications' => [
            'announcements' => true,
        ],
    ]);

    expect($this->user->settings)->toBe($settings);
});

it('can be passed a key and value to set a particular setting', function () {
    $this->user->settings()->set('notifications.announcements', true);

    expect($this->user->settings()->get())->toBe([
        'notifications' => [
            'new_article_published' => true,
            'announcements' => true,
        ],
    ]);
});
