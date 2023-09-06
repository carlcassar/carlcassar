<?php

use App\Models\NotificationSettings;
use App\Models\User;
use App\Notifications\Welcome;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertSee('notifications');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);

    $this->assertCount(1, User::all());
});

test('a registered event is dispatched when a user registers', function () {
    Event::fake();

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    Event::assertDispatched(Registered::class);
});

test('users can opt out of notifications', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(User::first()->settings()->notifications()->all()->toArray())->toBe([]);
});

test('users can opt in to notifications', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'notifications' => 'on',
    ]);

    expect(User::first()->settings()->notifications()->all()->toArray())->toBe(
        NotificationSettings::defaultNotificationSettings()->toArray()
    );
});

test('a user is sent a welcome notification when they register', function () {
    Notification::fake();

    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    Notification::assertSentTo($user = User::first(), Welcome::class,
        function (Welcome $notification, $channels) use ($user) {
            $mailable = $notification->toMail($user);

            return $channels == ['mail', 'database'] &&
                $mailable->subject = 'Welcome';
        });
});
