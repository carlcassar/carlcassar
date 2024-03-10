<?php

namespace Database\Factories;

use App\Models\NotificationSettings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'settings' => [],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function me(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Carl Cassar',
            'email' => 'carl@carlcassar.com',
            'is_admin' => true,
            'settings' => [
                'notifications' => NotificationSettings::defaultNotificationSettings(),
            ],
        ]);
    }

    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_admin' => true,
            ];
        });
    }

    public function withNotificationSettings(array $notifications): static
    {
        return $this->state(function (array $attributes) use ($notifications) {
            return [
                'settings' => [
                    'notifications' => $notifications,
                ],
            ];
        });
    }

    public function withDefaultNotificationSettings(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'settings' => [
                    'notifications' => NotificationSettings::defaultNotificationSettings(),
                ],
            ];
        });
    }
}
