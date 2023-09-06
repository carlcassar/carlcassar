<?php

use App\Livewire\NotificationSettings;
use App\Models\NotificationSettings as Notification;
use App\Models\User;
use Filament\Forms\Components\Toggle;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->withDefaultNotificationSettings()->create();
});

it('renders successfully', function () {
    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertStatus(Response::HTTP_OK);
});

it('exists on the notification settings page', function () {
    actingAs($this->user)
        ->get('settings/notifications')
        ->assertSeeLivewire(NotificationSettings::class);
});

it('has a form', function () {
    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertFormExists();
});

it('shows a toggle for each notification setting', function () {
    $livewire = Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertFormFieldExists('all_notifications');

    App\Models\NotificationSettings::defaultNotificationSettings()->each(function ($value, $key) use ($livewire) {
        $livewire
            ->assertFormFieldExists("settings.notifications.$key", function (Toggle $toggle) use ($value) {
                return $toggle->isEnabled() && $toggle->isLive() && $toggle->getState() == $value;
            })
            ->assertSet('data', function ($data) use ($key) {
                return $data['settings']['notifications'][$key] == true;
            });
    });
});

it('allows the user to toggle a notification', function () {
    expect($this->user->settings()->notifications()->areAllOn())->toBeTrue();

    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->fillForm([
            'settings.notifications.'.Notification::ANNOUNCEMENTS => false,
        ])
        ->assertFormFieldExists('all_notifications', function (Toggle $toggle): bool {
            return $toggle->getState() == false;
        })
        ->assertFormFieldExists('settings.notifications.'.Notification::ANNOUNCEMENTS, function (Toggle $toggle): bool {
            return $toggle->getState() == false;
        })
        ->assertFormFieldExists('settings.notifications.'.Notification::NEW_ARTICLE_PUBLISHED,
            function (Toggle $toggle): bool {
                return $toggle->getState() == true;
            })
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == false && $data['settings']['notifications'][Notification::ANNOUNCEMENTS] == false;
        });

    $this->user->refresh();

    expect($this->user->settings()->notifications()->get(Notification::ANNOUNCEMENTS))
        ->toBeFalse()
        ->and($this->user->settings()->notifications()->get(Notification::NEW_ARTICLE_PUBLISHED))
        ->toBeTrue();
});

it('allows the user to toggle all notifications', function () {
    expect($this->user->settings()->notifications()->areAllOn())->toBeTrue();

    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == true && $data['settings']['notifications'] == Notification::defaultNotificationSettings()->toArray();
        })
        ->assertFormFieldExists('all_notifications', function (Toggle $toggle): bool {
            return $toggle->isEnabled() && $toggle->isLive() && $toggle->getState() == true;
        })
        ->fillForm([
            'all_notifications' => false,
        ])
        ->assertFormFieldExists('all_notifications', function (Toggle $toggle): bool {
            return $toggle->getState() == false;
        })
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == false &&
                $data['settings']['notifications'] == Notification::defaultNotificationSettings()
                    ->map(fn () => false)
                    ->toArray();
        });

    expect($this->user->fresh()->settings()->notifications()->areAllOn())->toBeFalse();
});
