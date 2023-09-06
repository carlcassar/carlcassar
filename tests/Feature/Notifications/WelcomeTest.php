<?php

use App\Models\NotificationSettings;
use App\Models\User;
use App\Notifications\Welcome;

test('will use the email channel if the user has opted in to account notifications', function () {
    $userWithAccountNotifications = User::factory()->withNotificationSettings([
        NotificationSettings::ACCOUNT_NOTIFICATIONS => true,
    ])->create();

    expect((new Welcome())->via($userWithAccountNotifications))->toBe(['mail', 'database']);

    $userWithoutAccountNotifications = User::factory()->withNotificationSettings([
        NotificationSettings::ACCOUNT_NOTIFICATIONS => false,
    ])->create();

    expect((new Welcome())->via($userWithoutAccountNotifications))->toBe(['database']);
});
