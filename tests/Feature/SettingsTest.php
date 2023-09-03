<?php

use App\Models\NotificationSettings;
use App\Models\User;

it('can get all user settings', function () {
    $settings = User::factory()->withDefaultNotificationSettings()->create()->settings()->all();

    expect($settings)->toEqual([
        'notifications' => NotificationSettings::defaultNotificationSettings()->toArray(),
    ]);
});

it('can get a setting using dot notation', function () {
    $settings = User::factory()
        ->withNotificationSettings([
            'some_notification' => true,
        ])
        ->create()
        ->settings()
        ->get('notifications.some_notification');

    expect($settings)->toEqual(true);
});

it('can be passed an array to set all settings', function () {
    $settings = User::factory()->create()->settings();

    $settings->set($expected = [
        'notifications' => [
            'announcements' => true,
        ],
    ]);

    expect($settings->all())->toBe($expected);
});

it('can be passed a key and value to set a particular setting', function () {
    $settings = User::factory()->withDefaultNotificationSettings()->create()->settings();

    $settings->set('notifications.some_notification', true);

    expect($settings->get())->toBe([
        'notifications' => NotificationSettings::defaultNotificationSettings()->merge([
            'some_notification' => true,
        ])->toArray(),
    ]);
});
