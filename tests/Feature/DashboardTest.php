<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('is displayed when a user is logged in', function () {
    actingAs(User::factory()->create());

    $response = get('/dashboard');

    $response->assertStatus(Response::HTTP_OK);
});

it('cannot be seen by a guest', function () {
    $response = get('/dashboard');

    $response->assertStatus(Response::HTTP_FOUND);
    $response->assertRedirect(route('login'));
});
