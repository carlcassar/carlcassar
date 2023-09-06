<?php

use App\Models\NotificationSettings;
use App\Models\User;

it('can get the value of a notification setting', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
        NotificationSettings::ANNOUNCEMENTS => false,
    ])->create()->settings()->notifications();

    expect($notificationSettings->get(NotificationSettings::NEW_ARTICLE_PUBLISHED))
        ->toBeTrue()
        ->and($notificationSettings->get(NotificationSettings::ANNOUNCEMENTS))
        ->toBeFalse();
});

it('returns false for the value of a notification setting the user has not set', function () {
    $notificationSettings = User::factory()->withNotificationSettings([])->create()->settings()->notifications();

    expect($notificationSettings->get('some-random-notification'))->toBeFalse();
});

it('can set a notification setting', function () {
    $notificationSettings = User::factory()->withNotificationSettings([])->create()->settings()->notifications();

    $notificationSettings->set(NotificationSettings::ANNOUNCEMENTS, true);

    expect($notificationSettings->all()->toArray())->toBe([
        NotificationSettings::ANNOUNCEMENTS => true,
    ]);
});

it('can toggle a notification setting', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
        NotificationSettings::ANNOUNCEMENTS => false,
    ])->create()->settings()->notifications();

    $notificationSettings->toggle(NotificationSettings::NEW_ARTICLE_PUBLISHED);
    $notificationSettings->toggle(NotificationSettings::ANNOUNCEMENTS);

    expect($notificationSettings->all()->toArray())->toBe([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
        NotificationSettings::ANNOUNCEMENTS => true,
    ]);

    $notificationSettings->toggle(NotificationSettings::NEW_ARTICLE_PUBLISHED);
    $notificationSettings->toggle(NotificationSettings::ANNOUNCEMENTS);

    expect($notificationSettings->all()->toArray())->toBe([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
        NotificationSettings::ANNOUNCEMENTS => false,
    ]);
});

it('can turn off a notification setting', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
    ])->create()->settings()->notifications();

    $notificationSettings->turnOff(NotificationSettings::NEW_ARTICLE_PUBLISHED);

    expect($notificationSettings->get(NotificationSettings::NEW_ARTICLE_PUBLISHED))->toBeFalse();
});

it('can turn on a notification setting', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
    ])->create()->settings()->notifications();

    $notificationSettings->turnOn(NotificationSettings::NEW_ARTICLE_PUBLISHED);

    expect($notificationSettings->get(NotificationSettings::NEW_ARTICLE_PUBLISHED))->toBeTrue();
});

it('can tell if a notification setting is on', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
        NotificationSettings::ANNOUNCEMENTS => true,
    ])->create()->settings()->notifications();

    expect($notificationSettings->isOn(NotificationSettings::NEW_ARTICLE_PUBLISHED))->toBeFalse()
        ->and($notificationSettings->isOn(NotificationSettings::ANNOUNCEMENTS))->toBeTrue();
});

it('can get all notification settings', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
    ])->create()->settings()->notifications();

    expect($notificationSettings->all()->toArray())->toBe([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
    ]);
});

it('can tell if the notifications are all on when the user has not chosen a preference', function () {
    $notificationSettings = User::factory()->create()->settings()->notifications();

    expect($notificationSettings->areAllOn())->toBeFalse();
});

it('can tell if the notifications are all on when the user has chosen to turn them all off', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
        NotificationSettings::ANNOUNCEMENTS => false,
    ])->create()->settings()->notifications();

    expect($notificationSettings->areAllOn())->toBeFalse();
});

it('can tell if the notifications are all on when the user has set a preference for all of them and some are off',
    function () {
        $notificationSettings = User::factory()->withNotificationSettings([
            NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
            NotificationSettings::ANNOUNCEMENTS => true,
        ])->create()->settings()->notifications();

        expect($notificationSettings->areAllOn())->toBeFalse();
    });

it('can tell if the notifications are all on when the user has chosen to turn them all on', function () {
    $notificationSettings = User::factory()->withDefaultNotificationSettings()->create()->settings()->notifications();

    expect($notificationSettings->areAllOn())->toBeTrue();
});

it('can tell if the notifications are all on when the user has only chosen to turn one off', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => false,
    ])->create()->settings()->notifications();

    expect($notificationSettings->areAllOn())->toBeFalse();
});

it('can tell if the notifications are all on when the user has only chosen to turn one on', function () {
    $notificationSettings = User::factory()->withNotificationSettings([
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
    ])->create()->settings()->notifications();

    expect($notificationSettings->areAllOn())->toBeFalse();
});

it('can handle the case where the user has no notification settings', function () {
    $notificationSettings = User::factory()->create()->settings()->notifications();

    expect($notificationSettings->all()->count())
        ->toBe(0)
        ->and($notificationSettings->get('some_random_notification'))
        ->toBe(false)
        ->and($notificationSettings->areAllOn())
        ->toBe(false);
});

it('can list default notification settings', function () {
    expect(NotificationSettings::defaultNotificationSettings()->toArray())->toBe([
        NotificationSettings::ACCOUNT_NOTIFICATIONS => true,
        NotificationSettings::NEW_ARTICLE_PUBLISHED => true,
        NotificationSettings::ANNOUNCEMENTS => true,
    ]);
});
