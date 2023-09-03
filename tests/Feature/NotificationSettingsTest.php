<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get the value of a notification setting', function () {
    expect($this->user->settings()->notifications()->get('new_article_published'))
        ->toBe(true)
        ->and($this->user->settings()->notifications()->get('announcements'))
        ->toBe(false);
});

it('can be passed a notification setting to set', function () {
    $this->user->settings()->notifications()->set('announcements', true);

    expect($this->user->settings()->get())->toBe([
        'notifications' => [
            'new_article_published' => true,
            'announcements' => true,
        ],
    ]);
});

it('can be passed a notification to toggle', function () {
    $this->user->settings()->notifications()->toggle('new_article_published');
    $this->user->settings()->notifications()->toggle('announcements');

    expect($this->user->settings()->get())->toBe([
        'notifications' => [
            'new_article_published' => false,
            'announcements' => true,
        ],
    ]);

    $this->user->settings()->notifications()->toggle('new_article_published');
    $this->user->settings()->notifications()->toggle('announcements');

    expect($this->user->settings()->notifications()->all()->toArray())->toBe([
        'new_article_published' => true,
        'announcements' => false,
    ]);
});

it('can turn off a notification', function () {
    $this->user->settings()->notifications()->turnOff('new_article_published');

    expect($this->user->settings()->notifications()->get('new_article_published'))->toBe(false);
});

it('can turn on a notification', function () {
    $this->user->settings()->notifications()->turnOn('announcements');

    expect($this->user->settings()->notifications()->get('announcements'))->toBe(true);
});

it('can get all notifications', function () {
    expect($this->user->settings()->notifications()->all()->toArray())->toBe([
        'new_article_published' => true,
    ]);
});

it('can tell if all notifications are on', function () {
    $this->user->settings()->notifications()->toggle('announcements');

    expect($this->user->settings()->notifications()->all()->toArray())
        ->toBe([
            'new_article_published' => true,
            'announcements' => true,
        ])
        ->and($this->user->settings()->notifications()->areAllOn())
        ->toBeTrue();

    $this->user->settings()->notifications()->toggle('announcements');

    expect($this->user->settings()->notifications()->all()->toArray())
        ->toBe([
            'new_article_published' => true,
            'announcements' => false,
        ])
        ->and($this->user->settings()->notifications()->areAllOn())
        ->toBeFalse;
});

it('can loop over all notifications', function () {
    $notifications = [];

    $this->user->settings()->notifications()->each(function ($value, $name) use (&$notifications) {
        $notifications[$name] = $value;
    });

    expect($notifications)->toBe([
        'new_article_published' => true,
    ]);
});
