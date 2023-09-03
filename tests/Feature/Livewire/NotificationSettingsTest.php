<?php

use App\Livewire\NotificationSettings;
use App\Models\User;
use Filament\Forms\Components\Toggle;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();
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

it('shows a toggle for each notification', function () {
    $this->user->settings()->set('notifications', [
        'first_notification' => true,
        'second_notification' => false,
    ]);

    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertFormFieldExists('all_notifications')
        ->assertFormFieldExists('settings.notifications.first_notification')
        ->assertFormFieldExists('settings.notifications.second_notification');
});

it('allows the user to toggle a notification', function () {
    $this->user->settings()->set('notifications', [
        'first_notification' => true,
        'second_notification' => true,
    ]);

    expect($this->user->settings()->notifications()->areAllOn())->toBe(true);

    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == true && $data['settings']['notifications'] == [
                'first_notification' => true,
                'second_notification' => true,
            ];
        })
        ->assertFormFieldExists('settings.notifications.first_notification', function (Toggle $toggle): bool {
            return $toggle->isEnabled() && $toggle->isLive() && $toggle->getState() == true;
        })
        ->assertFormFieldExists('settings.notifications.second_notification', function (Toggle $toggle): bool {
            return $toggle->isEnabled() && $toggle->isLive() && $toggle->getState() == true;
        })
        ->fillForm([
            'settings.notifications.first_notification' => false,
        ])
        ->assertFormFieldExists('all_notifications', function (Toggle $toggle): bool {
            return $toggle->getState() == false;
        })
        ->assertFormFieldExists('settings.notifications.first_notification', function (Toggle $toggle): bool {
            return $toggle->getState() == false;
        })
        ->assertFormFieldExists('settings.notifications.second_notification', function (Toggle $toggle): bool {
            return $toggle->getState() == true;
        })
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == false && $data['settings']['notifications'] == [
                'first_notification' => false,
                'second_notification' => true,
            ];
        });

    expect($this->user->fresh()->settings()->notifications()->get('first_notification'))->toBe(false);
});

it('allows the user to toggle all notifications', function () {
    $this->user->settings()->set('notifications', [
        'first_notification' => true,
        'second_notification' => true,
    ]);

    expect($this->user->settings()->notifications()->areAllOn())->toBe(true);

    Livewire::actingAs($this->user)
        ->test(NotificationSettings::class)
        ->assertSet('data', function ($data) {
            return $data['all_notifications'] == true && $data['settings']['notifications'] == [
                'first_notification' => true,
                'second_notification' => true,
            ];
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
            return $data['all_notifications'] == false && $data['settings']['notifications'] == [
                'first_notification' => false,
                'second_notification' => false,
            ];
        });

    expect($this->user->fresh()->settings()->notifications()->areAllOn())->toBe(false);
});
