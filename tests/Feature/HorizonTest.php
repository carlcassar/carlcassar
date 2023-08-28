<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    pretendWeAreInProduction();
});

test('horizon cannot be viewed by regular users in production', function () {
    actingAs(User::factory()->create());

    $response = get('/horizon');

    $response->assertStatus(Response::HTTP_FORBIDDEN);
});

test('horizon can be viewed by admins in production', function () {
    actingAs(User::factory()->admin()->create());

    $response = get('/horizon');

    $response->assertStatus(Response::HTTP_OK);
});

function pretendWeAreInProduction(): void
{
    app()->detectEnvironment(fn () => 'production');
}
