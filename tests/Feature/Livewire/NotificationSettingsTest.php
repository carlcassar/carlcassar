<?php

use App\Livewire\NotificationSettings;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    actingAs(
        User::factory()->create()
    );

    Livewire::test(NotificationSettings::class)
        ->assertStatus(200);
});
